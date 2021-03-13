<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Currency;
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
use Auth;
use Redirect;

class DpaypalController extends Controller
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
        $user = Auth::user();
        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
            $item_amount = $request->amount / $curr->value;
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
            $item_amount = $request->amount;
        }

        $item_name = "Deposit via Paypal Payment";
        $cancel_url = action('User\DpaypalController@paycancle');
        $notify_url = action('User\DpaypalController@notify');

        $dep['user_id'] = $user->id;
        $dep['currency'] = $curr->sign;
        $dep['currency_code'] = $curr->name;
        $dep['amount'] = $request->amount / $curr->value;
        $dep['currency_value'] = $curr->value;
        $dep['method'] = 'Paypal';

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Deposit Amount') /** item name **/
            ->setCurrency($curr->name)
            ->setQuantity(1)
            ->setPrice($item_amount); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($curr->name)
            ->setTotal($item_amount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($item_name);
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
        Session::put('deposit',$dep);
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
          return redirect()->route('user-dashboard')->with('success','Balance has been added to your account.');
      }

      public function notify(Request $request){

        $dep = Session::get('deposit');
        $success_url = action('User\DpaypalController@payreturn');
        $cancel_url = action('User\DpaypalController@paycancle');
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

                    $deposit = new Deposit;
                    $deposit->user_id = $dep['user_id'];
                    $deposit->currency = $dep['currency'];
                    $deposit->currency_code = $dep['currency_code'];
                    $deposit->amount = $dep['amount'];
                    $deposit->currency_value = $dep['currency_value'];
                    $deposit->method = $dep['method'];
                    $deposit->txnid = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
                    $deposit->status = 1;
                    $deposit->save();

                    $user = User::findOrFail($deposit->user_id);
                    $user->balance = $user->balance + ($deposit->amount / $deposit->currency_value);
                    $user->save();

                    $settings = Generalsetting::findOrFail(1);

                    // store in transaction table
                    if ($deposit->status == 1) {
                        $transaction = new \App\Models\Transaction;
                        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
                        $transaction->user_id = $deposit->user_id;
                        $transaction->amount = $deposit->amount;
                        $transaction->user_id = $deposit->user_id;
                        $transaction->currency_sign = $deposit->currency;
                        $transaction->currency_code = $deposit->currency_code;
                        $transaction->currency_value= $deposit->currency_value;
                        $transaction->method = $deposit->method;
                        $transaction->txnid = $deposit->txnid;
                        $transaction->details = 'Payment Deposit';
                        $transaction->type = 'plus';
                        $transaction->save();
                    }
            
                    if($settings->is_smtp == 1)
                    {
                        $maildata = [
                            'to' => $user->email,
                            'type' => "wallet_deposit",
                            'cname' => $user->name,
                            'damount' => $deposit->amount,
                            'wbalance' => $user->balance,
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
                        mail($user->email,'Balance has been added to your account. Your current balance is: $' . $user->balance, $headers);
                    }

        Session::forget('deposit');

            return redirect($success_url);
        }
        else {
            return redirect($cancel_url);
        }

    }
}
