<?php

namespace App\Http\Controllers\User;

use Mollie\Laravel\Facades\Mollie;
use App\Classes\GeniusMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Auth;

class DmollyController extends Controller
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
        $available_currency = array(
            'AED',
            'AUD',
            'BGN',
            'BRL',
            'CAD',
            'CHF',
            'CZK',
            'DKK',
            'EUR',
            'GBP',
            'HKD',
            'HRK',
            'HUF',
            'ILS',
            'ISK',
            'JPY',
            'MXN',
            'MYR',
            'NOK',
            'NZD',
            'PHP',
            'PLN',
            'RON',
            'RUB',
            'SEK',
            'SGD',
            'THB',
            'TWD',
            'USD',
            'ZAR'
            );
            if(!in_array($curr->name,$available_currency))
            {
            return redirect()->back()->with('unsuccess','Invalid Currency For Molly Payment.');
            }



        $item_name = "Deposit via Molly Payment";
        $cancel_url = action('User\DpaypalController@paycancle');
        $notify_url = action('User\DmollyController@notify');

        $dep['user_id'] = $user->id;
        $dep['currency'] = $curr->sign;
        $dep['currency_code'] = $curr->name;
        $dep['amount'] = $request->amount / $curr->value;
        $dep['currency_value'] = $curr->value;
        $dep['method'] = 'Molly Payment';
        Session::put('deposit',$dep);
      
        $data['total'] =  $item_amount;
        $data['return_url'] = $notify_url;
        $data['cancel_url'] = $cancel_url;
        Session::put('paypal_items',$data);

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $curr->name,
                'value' => ''.sprintf('%0.2f', $item_amount).'', // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => $item_name ,
            'redirectUrl' => route('deposit.molly.notify'),
            ]);

        Session::put('payment_id',$payment->id);
        Session::put('molly_data',$dep);

        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);

 }

    
    public function notify(Request $request){

        $dep = Session::get('deposit');
        $success_url = action('User\DpaypalController@payreturn');
        $cancel_url = action('User\DpaypalController@paycancle');
        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));


        if($payment->status == 'paid'){


                    $deposit = new Deposit;
                    $deposit->user_id = $dep['user_id'];
                    $deposit->currency = $dep['currency'];
                    $deposit->currency_code = $dep['currency_code'];
                    $deposit->amount = $dep['amount'];
                    $deposit->currency_value = $dep['currency_value'];
                    $deposit->method = $dep['method'];
                    $deposit->txnid = $payment->id;
                    $deposit->status = 1;
                    $deposit->save();

                    $user = User::findOrFail($deposit->user_id);
                    $user->balance = $user->balance + ($deposit->amount / $deposit->currency_value);
                    $user->save();

                    $settings = Generalsetting::findOrFail(1);

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
