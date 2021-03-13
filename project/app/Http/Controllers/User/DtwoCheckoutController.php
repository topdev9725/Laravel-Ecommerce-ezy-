<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twocheckout;
use Twocheckout_Charge;
use Twocheckout_Error;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use App\Models\Deposit;
use App\Models\Currency;
use App\Models\Transaction;
use Auth;
use Session;

class DtwoCheckoutController extends Controller
{
    public function store(Request $request){

        $user = Auth::user();
        $settings = Generalsetting::findOrFail(1);
        $item_number = str_random(4).time();
        $item_amount = $request->amount;
        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }


        Twocheckout::privateKey($settings->twocheckout_private_key);
        Twocheckout::sellerId($settings->twocheckout_seller_id);
        if($settings->twocheckout_sandbox_check == 1) {
            Twocheckout::sandbox(true);
        }
        else {
            Twocheckout::sandbox(false);
        }
    
            try {
    
                $charge = Twocheckout_Charge::auth(array(
                    "merchantOrderId" => $item_number,
                    "token"      => $request->token,
                    "currency"   => $curr->name,
                    "total"      => $item_amount,
                    "billingAddr" => array(
                        "name" => $user->name,
                        "addrLine1" => $user->address,
                        "city" => $user->city,
                        "state" => 'UN',
                        "zipCode" => $user->zip,
                        "country" => $user->country,
                        "email" => $user->email,
                        "phoneNumber" => $user->phone
                    )
                ));
            
                if ($charge['response']['responseCode'] == 'APPROVED') {
        
                    $user->balance = $user->balance + ($request->amount / $curr->value);
                    $user->mail_sent = 1;
                    $user->save();
  
                    $deposit = new Deposit;
                    $deposit->user_id = $user->id;
                    $deposit->currency = $curr->sign;
                    $deposit->currency_code = $curr->name;
                    $deposit->currency_value = $curr->value;
                    $deposit->amount = $request->amount / $curr->value;
                    $deposit->method = '2Checkout';
                    $deposit->txnid = $charge['response']['transactionId'];
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
                      $data = [
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
                      $mailer->sendAutoMail($data);
                    }
                    else
                    {
                      $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
                      @mail($user->email,'Balance has been added to your account. Your current balance is: $' . $user->balance, $headers);
                    }
  
                    return redirect()->route('user-dashboard')->with('success','Balance has been added to your account.');
            
                }
        
            } catch (Twocheckout_Error $e) {
                return redirect()->back()->with('unsuccess',$e->getMessage());
        
            }
    
    }
}
