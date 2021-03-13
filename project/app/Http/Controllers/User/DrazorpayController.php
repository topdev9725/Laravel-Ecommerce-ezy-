<?php

namespace App\Http\Controllers\User;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Auth;

class DrazorpayController extends Controller
{
    public function __construct()
    {
        
        $rdata = Generalsetting::findOrFail(1);
        $this->keyId = $rdata->razorpay_key;
        $this->keySecret = $rdata->razorpay_secret;
        $this->api = new Api($this->keyId, $this->keySecret);
    }

 public function store(Request $request){

        $this->displayCurrency = ''.$request->currency_code.'';

        $user = Auth::user();

        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
            $item_amount = $request->amount;
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
            $item_amount = $request->amount;
        }
        if($curr->name != "INR")
        {
            return redirect()->back()->with('unsuccess','Please Select INR Currency For Razorpay.');
        }


        $settings = Generalsetting::findOrFail(1);
        $return_url = action('User\DpaypalController@payreturn');
        $cancel_url = action('User\DpaypalController@paycancle');
        $notify_url = action('User\DrazorpayController@notify');
        $item_name = "Deposit via Razorpay";
        $item_number = $user->id;

        $orderData = [
            'receipt'         => $item_number,
            'amount'          => $item_amount * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];
        
        $razorpayOrder = $this->api->order->create($orderData);
        
        $razorpayOrderId = $razorpayOrder['id'];
        
        session(['razorpay_order_id'=> $razorpayOrderId]);


    // Redirect to paypal IPN

                    $deposit = new Deposit;
                    $deposit->user_id = $user->id;
                    $deposit->currency = $curr->sign;
                    $deposit->currency_code = $curr->name;
                    $deposit->amount = $request->amount / $curr->value;
                    $deposit->currency_value = $curr->value;
                    $deposit->method = 'Razorpay';
                    $deposit->save();

                    $displayAmount = $amount = $orderData['amount'];
                    
                    if ($this->displayCurrency !== 'INR')
                    {
                        $url = "https://api.fixer.io/latest?symbols=$this->displayCurrency&base=INR";
                        $exchange = json_decode(file_get_contents($url), true);
                    
                        $displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
                    }
                    
                    $checkout = 'automatic';
                    
                    if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
                    {
                        $checkout = $_GET['checkout'];
                    }
                    
                    $data = [
                        "key"               => $this->keyId,
                        "amount"            => $amount,
                        "name"              => $item_name,
                        "description"       => $item_name,
                        "prefill"           => [
                            "name"              => Auth::user()->name,
                            "email"             => Auth::user()->email,
                            "contact"           => Auth::user()->phone,
                        ],
                        "notes"             => [
                            "address"           => Auth::user()->address,
                            "merchant_order_id" => $item_number,
                        ],
                        "theme"             => [
                            "color"             => "{{$settings->colors}}"
                        ],
                        "order_id"          => $razorpayOrderId,
                    ];
                    
                    if ($this->displayCurrency !== 'INR')
                    {
                        $data['display_currency']  = $this->displayCurrency;
                        $data['display_amount']    = $displayAmount;
                    }
                    
                    $json = json_encode($data);
                    $displayCurrency = $this->displayCurrency;
                    Session::put('item_number',$item_number); 
                    
        return view( 'front.razorpay-checkout', compact( 'data','displayCurrency','json','notify_url' ) );

 }

    
    public function notify(Request $request){

            $success = true;

            $error = "Payment Failed";
            
            if (empty($_POST['razorpay_payment_id']) === false)
            {
                try
                {

                    $attributes = array(
                        'razorpay_order_id' => session('razorpay_order_id'),
                        'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                        'razorpay_signature' => $_POST['razorpay_signature']
                    );
            
                    $this->api->utility->verifyPaymentSignature($attributes);
                }
                catch(SignatureVerificationError $e)
                {
                    $success = false;
                    $error = 'Razorpay Error : ' . $e->getMessage();
                }
            }
            
            if ($success === true)
            {
                
                $razorpayOrder = $this->api->order->fetch(session('razorpay_order_id'));
            
                $order_id = $razorpayOrder['receipt'];
                $transaction_id = $_POST['razorpay_payment_id'];

                $deposit = Deposit::where('user_id','=',Session::get('item_number'))->orderBy('created_at','desc')->first();
                $user = User::findOrFail($deposit->user_id);
                $settings = Generalsetting::findOrFail(1);
                $user->balance = $user->balance + ($deposit->amount / $deposit->currency_value);
                $user->save();
                $deposit->txnid = $transaction_id;
                $deposit->status = 1;
                $deposit->save();


            // store in transaction table
            if ($deposit->status == 1) {
                $transaction = new Transaction;
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
            return redirect()->route('user-dashboard')->with('success','Balance has been added to your account.');
            }else{
                $deposit = Deposit::where('user_id','=',Session::get('item_number'))->orderBy('created_at','desc')->first();
                $deposit->delete();
            }
            return redirect()->back()->with('unsuccess','Payment Cancelled.');
    }
}