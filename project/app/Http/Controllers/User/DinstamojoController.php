<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Classes\Instamojo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Auth;

class DinstamojoController extends Controller
{

 public function store(Request $request){

        $user = Auth::user();

        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
            
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $item_amount = $request->amount;
        if($curr->name != "INR")
        {
            return redirect()->back()->with('unsuccess','Please Select INR Currency For Instamojo.');
        }

        $settings = Generalsetting::findOrFail(1);
        $return_url = action('User\DpaypalController@payreturn');
        $cancel_url = action('User\DpaypalController@paycancle');
        $notify_url = action('User\DinstamojoController@notify');
        $item_name = "Deposit via Instamojo";
        $item_number = $user->id;


        if($settings->instamojo_sandbox == 1){
            $api = new Instamojo($settings->instamojo_key, $settings->instamojo_token, 'https://test.instamojo.com/api/1.1/');
            }
            else {
            $api = new Instamojo($settings->instamojo_key, $settings->instamojo_token);
            }


                    try {
                        $response = $api->paymentRequestCreate(array(
                            "purpose" => $item_name,
                            "amount" => $item_amount,
                            "send_email" => false,
                            "email" => $user->email,
                            "redirect_url" => $notify_url
                            ));
                        
                        $redirect_url = $response['longurl'];
                         $dep['user_id'] = $user->id;
                         $dep['currency'] = $curr->sign;
                         $dep['currency_code'] = $curr->name;
                         $dep['amount'] = $request->amount / $curr->value;
                         $dep['currency_value'] = $curr->value;
                         $dep['method'] = 'Instamojo';
                         $dep['pay_id'] = $response['id'];

                         Session::put('deposit',$dep);
                    
                    
                            $data['total'] =  $item_amount;
                            $data['return_url'] = $notify_url;
                            $data['cancel_url'] = $cancel_url;
                            Session::put('paypal_items',$data);
                            return redirect($redirect_url);
                                    
                    }
                    catch (Exception $e) {
                        return redirect()->back()->with('unsuccess',$e->getMessage());
                    }



 }

    
    public function notify(Request $request){

        $data = $request->all();

        $dep = Session::get('deposit');

        $success_url = action('User\DpaypalController@payreturn');
        $cancel_url = action('User\DpaypalController@paycancle');


        if($dep['pay_id'] == $data['payment_request_id']){


                    $deposit = new Deposit;
                    $deposit->user_id = $dep['user_id'];
                    $deposit->currency = $dep['currency'];
                    $deposit->currency_code = $dep['currency_code'];
                    $deposit->amount = $dep['amount'];
                    $deposit->currency_value = $dep['currency_value'];
                    $deposit->method = $dep['method'];
                    $deposit->txnid = $dep['pay_id'];
                    $deposit->status = 1;
                    $deposit->save();

                    $user = User::findOrFail($deposit->user_id);
                    $settings = Generalsetting::findOrFail(1);
                    $user->balance = $user->balance + ($deposit->amount / $deposit->currency_value);
                    $user->save();

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


        Session::forget('deposit');

            return redirect($success_url);
        }
        else {
            return redirect($cancel_url);
        }

        return redirect()->route('payment.return');
    }
}
