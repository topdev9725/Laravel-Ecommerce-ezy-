<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Classes\Instamojo;
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
use Illuminate\Support\Facades\Session;

class InstamojoController extends Controller
{

 public function store(Request $request){

        $this->validate($request, [
            'shop_name'   => 'unique:users',
           ],[ 
               'shop_name.unique' => 'This shop name has already been taken.'
            ]);


            if($request->currency_code != "INR")
            {
                return redirect()->back()->with('unsuccess','Please Select INR Currency For Instamojo.');
            }

            $input = $request->all();
    $user = Auth::user();
     $subs = Subscription::findOrFail($request->subs_id);
     $settings = Generalsetting::findOrFail(1);
     $paypal_email = $settings->paypal_business;
     $return_url = action('User\PaypalController@payreturn');
     $cancel_url = action('User\PaypalController@paycancle');
     $notify_url = action('User\InstamojoController@notify');
     $item_name = $subs->title." Plan";
     $item_number = str_random(4).time();
     $item_amount = $subs->price;
     Session::put('user_data',$input);

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
        "email" => $request->email,
        "redirect_url" => $notify_url
        ));
    
    $redirect_url = $response['longurl'];
     $sub['user_id'] = $user->id;
     $sub['subscription_id'] = $subs->id;
     $sub['title'] = $subs->title;
     $sub['currency'] = $subs->currency;
     $sub['currency_code'] = $subs->currency_code;
     $sub['price'] = $subs->price;
     $sub['days'] = $subs->days;
     $sub['allowed_products'] = $subs->allowed_products;
     $sub['details'] = $subs->details;
     $sub['method'] = 'Instamojo';  
     $sub['pay_id'] = $response['id'];

     Session::put('subscription',$sub);


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

        $sub = Session::get('subscription');

        $input = Session::get('user_data');

        $paypal_data = Session::get('paypal_data');
        $paypal_items = Session::get('paypal_items');
        $success_url = action('User\PaypalController@payreturn');
        $cancel_url = action('User\PaypalController@paycancle');


        if($sub['pay_id'] == $data['payment_request_id']){


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
                    $order->txnid = $data['payment_id'];
                    $order->status = 1;





        $user = User::findOrFail($order->user_id);
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($order->subscription_id);
        $settings = Generalsetting::findOrFail(1);


        $today = Carbon::now()->format('Y-m-d');
        $date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));

        $input['is_vendor'] = 2;

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
            $input['date']= date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));

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


        Session::forget('subscription');

            return redirect($success_url);
        }
        else {
            return redirect($cancel_url);
        }

        return redirect()->route('payment.return');
}





}
