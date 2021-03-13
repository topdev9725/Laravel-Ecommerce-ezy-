<?php

namespace App\Http\Controllers\User;

use Mollie\Laravel\Facades\Mollie;
use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Auth;
use Carbon\Carbon;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MollyController extends Controller
{


  public function __construct()
    {
        //Set Spripe Keys
        $gs = Generalsetting::findOrFail(1);

            if (Session::has('currency')) 
            {
              $this->curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $this->curr = Currency::where('is_default','=',1)->first();
            }
    }

 public function store(Request $request){

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
        if(!in_array($this->curr->name,$available_currency))
        {
        return redirect()->back()->with('unsuccess','Invalid Currency For Molly Payment.');
        }



        $this->validate($request, [
            'shop_name'   => 'unique:users',
           ],[ 
               'shop_name.unique' => 'This shop name has already been taken.'
            ]);
     $input = $request->all();
     $user = Auth::user();
     $subs = Subscription::findOrFail($request->subs_id);
     $settings = Generalsetting::findOrFail(1);
     $paypal_email = $settings->paypal_business;
     $return_url = action('User\PaypalController@payreturn');
     $cancel_url = action('User\PaypalController@paycancle');
     $notify_url = action('User\MollyController@notify');
     $order['item_name'] = $subs->title." Plan";
     $order['item_number'] = str_random(4).time();
     $order['item_amount'] = $subs->price;

     $sub['user_id'] = $user->id;
     $sub['subscription_id'] = $subs->id;
     $sub['title'] = $subs->title;
     $sub['currency'] = $subs->currency;
     $sub['currency_code'] = $subs->currency_code;
     $sub['price'] = $subs->price;
     $sub['days'] = $subs->days;
     $sub['allowed_products'] = $subs->allowed_products;
     $sub['details'] = $subs->details;
     $sub['method'] = 'Molly';     


    $settings = Generalsetting::findOrFail(1);

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $this->curr->name,
                'value' => ''.sprintf('%0.2f', $order['item_amount']).'', // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => $order['item_name'] ,
            'redirectUrl' => route('user.molly.notify'),
            ]);

        Session::put('payment_id',$payment->id);
        Session::put('molly_data',$sub);
        Session::put('user_data',$input);
        Session::put('order_data',$order);


        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);

 }



public function notify(Request $request){

        $sub = Session::get('molly_data');
        $input = Session::get('user_data');
        $order = Session::get('order_data');

        $success_url = action('User\PaypalController@payreturn');
        $cancel_url = action('User\PaypalController@paycancle');

        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));

        if($payment->status == 'paid'){

                    $order = new UserSubscription;
                    $order->user_id = $sub['user_id'];
                    $order->subscription_id = $sub['subscription_id'];
                    $order->title = $sub['title'];
                    $order->currency = $sub['currency'];
                    $order->currency_code = $sub['currency_code'];
                    $order->price = $sub['price'];
                    $order->days = $sub['days'];
                    $order->allowed_products = $sub['allowed_products'];
                    $order->details = $sub['details'];
                    $order->method = $sub['method'];
                    $order->txnid = $payment->id;
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
                $input['date'] = date('Y-m-d', strtotime($today.' + '.$total.' days'));
            }
            else
            {
                $input['date'] = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
            }
        }
        else
        {
            
            $input['date'] = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));

        }

        $input['mail_sent'] = 1;
        $user->update($input);
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