<?php

namespace App\Http\Controllers\User;


use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Auth;
use Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\Http\Controllers\Controller;

class PaypalController extends Controller
{
    private $_api_context;
    public function __construct()
    {
        $gs = Generalsetting::find(1);
        $paypal_conf = \Config::get('paypal');
        $paypal_conf['client_id'] = $gs->paypal_client_id;
        $paypal_conf['secret'] = $gs->paypal_client_secret;
        $paypal_conf['settings']['mode'] = $gs->paypal_sandbox_check == 1 ? 'sandbox' : 'live';
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function store(Request $request){

        $this->validate($request, [
                'shop_name'   => 'unique:users',
            ],[ 
                'shop_name.unique' => 'This shop name has already been taken.'
            ]);

         $user = Auth::user();
         $subs = Subscription::findOrFail($request->subs_id);

         $sub['user_id'] = $user->id;
         $sub['subscription_id'] = $subs->id;
         $sub['title'] = $subs->title;
         $sub['currency'] = $subs->currency;
         $sub['currency_code'] = $subs->currency_code;
         $sub['price'] = $subs->price;
         $sub['days'] = $subs->days;
         $sub['allowed_products'] = $subs->allowed_products;
         $sub['details'] = $subs->details;
         $sub['method'] = 'Paypal';     
    
        $order['item_name'] = $subs->title." Plan";
        $order['item_number'] = str_random(4).time();
        $order['item_amount'] = $subs->price;
        $cancel_url = action('User\PaypalController@paycancle');
        $notify_url = action('User\PaypalController@notify');
    
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($order['item_name']) /** item name **/
            ->setCurrency($subs->currency_code)
            ->setQuantity(1)
            ->setPrice($order['item_amount']); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($subs->currency_code)
            ->setTotal($order['item_amount']);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($order['item_name'].' Via Paypal');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($notify_url) /** Specify return URL **/
            ->setCancelUrl($cancel_url);
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            return redirect()->back()->with('unsuccess',$ex->getMessage());
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                    break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_data',$sub);
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        return redirect()->back()->with('unsuccess','Unknown error occurred');
     }


     public function paycancle(){
         return redirect()->back()->with('unsuccess','Payment Cancelled.');
     }

     public function payreturn(){
         return redirect()->route('user-dashboard')->with('success','Vendor Account Activated Successfully');
     }


     public function notify(Request $request){

        $paypal_data = Session::get('paypal_data');
        $success_url = action('User\PaypalController@payreturn');
        $cancel_url = action('User\PaypalController@paycancle');
        $input = $request->all();

        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        if (empty( $input['PayerID']) || empty( $input['token'])) {
            return redirect($cancel_url);
        } 
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($input['PayerID']);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            $resp = json_decode($payment, true);

                    $order = new UserSubscription;
                    $order->user_id = $paypal_data['user_id'];
                    $order->subscription_id = $paypal_data['subscription_id'];
                    $order->title = $paypal_data['title'];
                    $order->currency = $paypal_data['currency'];
                    $order->currency_code = $paypal_data['currency_code'];
                    $order->price = $paypal_data['price'];
                    $order->days = $paypal_data['days'];
                    $order->allowed_products = $paypal_data['allowed_products'];
                    $order->details = $paypal_data['details'];
                    $order->method = $paypal_data['method'];
                    $order->txnid = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
                    $order->status = 1;

                    $user = User::findOrFail($order->user_id);
                    $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
                    $subs = Subscription::findOrFail($order->subscription_id);
                    $settings = Generalsetting::findOrFail(1);


                    $today = Carbon::now()->format('Y-m-d');
                    $user->is_vendor = 2;
                    if(!empty($package))
                    {
                        if($package->subscription_id == $order->subscription_id)
                        {
                            $newday = strtotime($today);
                            $lastday = strtotime($user->date);
                            $secs = $lastday-$newday;
                            $days = $secs / 86400;
                            $total = $days+$subs->days;
                            $inputs['date'] = date('Y-m-d', strtotime($today.' + '.$total.' days'));
                        }
                        else
                        {
                            $inputs['date'] = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                        }
                    }
                    else
                    {
                        
                        $inputs['date'] = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));

                    }

        $inputs['mail_sent'] = 1;
        $user->update($inputs);
                   $order->save();

        if($settings->is_smtp == 1)
        {
            $maildata = [
                'to' => $user->email,
                'type' => "vendor_accept",
                'cname' => $user->name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'onumber' => "",
            ];
            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($maildata);
        }
        else
        {
            $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
            mail($user->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.',$headers);
        }


        Session::forget('payment_id');
        Session::forget('molly_data');
        Session::forget('user_data');
        Session::forget('order_data');



            return redirect($success_url);
        }
        else {
            return redirect($cancel_url);
        }

}

}
