<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Config;
use Auth;

class DvoguepayController extends Controller
{
    public function store(Request $request) {

        $user = Auth::user();
        $settings = Generalsetting::findOrFail(1);
        $success_url = action('User\UserController@index');
        $item_name = "Deposit via Voguepay";
        $item_number = str_random(4).time();
  
        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
  
        $item_amount = $request->amount;
  
                    $user->mail_sent = 1;
                    $user->save();
                    $deposit = new Deposit;
                    $deposit->user_id = $user->id;
                    $deposit->currency = $curr->sign;
                    $deposit->currency_code = $curr->name;
                    $deposit->currency_value = $curr->value;
                    $deposit->amount = $request->amount / $curr->value;
                    $deposit->method = 'Voguepay';
                    $deposit->txnid = $request->ref_id;
                    $deposit->status = 1;
                    $deposit->save();
  
                    $user->balance = $user->balance + ($request->amount / $curr->value);
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
                    mail($user->email,'Balance has been added to your account. Your current balance is: $' . $user->balance,$headers);
                    }
  
                    return redirect()->route('user-dashboard')->with('success','Balance has been added to your account successfully');
  
  
         }
}
