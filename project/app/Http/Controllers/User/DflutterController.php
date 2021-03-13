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
use Illuminate\Support\Facades\Session;
use Auth;

class DflutterController extends Controller
{
    public function store(Request $request) {

        $user = Auth::user();
        $settings = Generalsetting::findOrFail(1);
        $item_name = "Deposit via Flutterwave";
        $item_number = str_random(4).time();

         if (Session::has('currency'))
         {
             $curr = Currency::find(Session::get('currency'));
         }
         else
         {
             $curr = Currency::where('is_default','=',1)->first();

         }

         $available_currency = array(
            'BIF',
            'CAD',
            'CDF',
            'CVE',
            'EUR',
            'GBP',
            'GHS',
            'GMD',
            'GNF',
            'KES',
            'LRD',
            'MWK',
            'NGN',
            'RWF',
            'SLL',
            'STD',
            'TZS',
            'UGX',
            'USD',
            'XAF',
            'XOF',
            'ZMK',
            'ZMW',
            'ZWD'
            );
            if(!in_array($curr->name,$available_currency))
            {
            return redirect()->back()->with('unsuccess','Invalid Currency For Flutter Wave.');
            }


        $deposit = new Deposit;
        $deposit->user_id = $user->id;
        $deposit->currency = $curr->sign;
        $deposit->currency_code = $curr->name;
        $deposit->amount = $request->amount / $curr->value;
        $deposit->currency_value = $curr->value;
        $deposit->method = 'Flutterwave';
        $deposit->flutter_id = $item_number;
        $deposit->save();

        // SET CURL

        $curl = curl_init();

        $customer_email = $user->email;
        $amount = $request->amount;  
        $currency = $curr->name;
        $txref = $item_number; // ensure you generate unique references per transaction.
        $PBFPubKey = $settings->flutter_public_key; // get your public key from the dashboard.
        $redirect_url = action('User\DflutterController@notify');
        $payment_plan = ""; // this is only required for recurring payments.

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
              'amount' => $amount,
              'customer_email' => $customer_email,
              'currency' => $currency,
              'txref' => $txref,
              'PBFPubKey' => $PBFPubKey,
              'redirect_url' => $redirect_url,
              'payment_plan' => $payment_plan
            ]),
            CURLOPT_HTTPHEADER => [
              "content-type: application/json",
              "cache-control: no-cache"
            ],
          ));
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          if($err){
            // there was an error contacting the rave API
            die('Curl returned error: ' . $err);
          }
          
          $transaction = json_decode($response);
          
          if(!$transaction->data && !$transaction->data->link){
            // there was an error from the API
            print_r('API returned error: ' . $transaction->message);
          }
          
          return redirect($transaction->data->link);

     }


     public function notify(Request $request) {

        $input = $request->all();
        $resdata = json_decode($input['resp'],true);

            if ($resdata['tx']['status'] = "success") {

            $deposit = Deposit::where('flutter_id','=',$input['txref'])->orderBy('created_at','desc')->first();
            $user = User::findOrFail($deposit->user_id);
            $settings = Generalsetting::findOrFail(1);
            $user->balance = $user->balance + ($deposit->amount / $deposit->currency_value);
            $user->save();
            $deposit->txnid =  $resdata['tx']['id'];
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
            return redirect(action('User\DpaypalController@payreturn'));
            } else {
              $deposit = Deposit::where('flutter_id','=',$input['txref'])
              ->orderBy('created_at','desc')->first();
                $deposit->delete();
                return redirect(action('User\DpaypalController@paycancle'));
            }

     }
}
