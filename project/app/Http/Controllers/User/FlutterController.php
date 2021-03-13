<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Auth;
use Carbon\Carbon;

class FlutterController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'shop_name'   => 'unique:users',
           ],[ 
               'shop_name.unique' => 'This shop name has already been taken.'
            ]);
            $input = $request->all();
            $user = Auth::user();
            $subs = Subscription::findOrFail($request->subs_id);
            $settings = Generalsetting::findOrFail(1);
            $item_name = $subs->title." Plan";
            $item_number = str_random(4).time();
            $item_amount = $subs->price;
            $item_currency = $subs->currency_code;

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
                if(!in_array($item_currency,$available_currency))
                {
                return redirect()->back()->with('unsuccess','Invalid Currency For Flutter Wave.');
                }

  
                $sub = new UserSubscription;
                $sub->user_id = $user->id;
                $sub->subscription_id = $subs->id;
                $sub->title = $subs->title;
                $sub->currency = $subs->currency;
                $sub->currency_code = $subs->currency_code;
                $sub->price = $subs->price;
                $sub->days = $subs->days;
                $sub->allowed_products = $subs->allowed_products;
                $sub->details = $subs->details;
                $sub->method = 'Flutterwave';
                $sub->flutter_id = $item_number;
                $sub->status = 0;
                $sub->save();

        // SET CURL

        $curl = curl_init();

        $customer_email = $user->email;
        $amount = $item_amount;  
        $currency = $item_currency;
        $txref = $item_number; // ensure you generate unique references per transaction.
        $PBFPubKey = $settings->flutter_public_key; // get your public key from the dashboard.
        $redirect_url = action('User\FlutterController@notify');
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
                
                $settings = Generalsetting::findOrFail(1);
                $subs = UserSubscription::where('flutter_id','=',$input['txref'])->orderBy('id','desc')->first();
                $subs->status = 1;
                $subs->txnid = $resdata['tx']['id'];
                $subs->update();

                $user = User::findOrFail($subs->user_id);
                $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();


                $today = Carbon::now()->format('Y-m-d');
                $input = $request->all();  
                $user->is_vendor = 2;
                            if(!empty($package))
                            {
                                if($package->subscription_id == $request->subs_id)
                                {
                                    $newday = strtotime($today);
                                    $lastday = strtotime($user->date);
                                    $secs = $lastday-$newday;
                                    $days = $secs / 86400;
                                    $total = $days+$subs->days;
                                    $user->date = date('Y-m-d', strtotime($today.' + '.$total.' days'));
                                }
                                else
                                {
                                    $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                                }
                            }
                            else
                            {
                                $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                            }
                            $user->mail_sent = 1;     
                            $user->update($input);

                            if($settings->is_smtp == 1)
                            {
                            $data = [
                                'to' => $user->email,
                                'type' => "vendor_accept",
                                'cname' => $user->name,
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
                            mail($user->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.',$headers);
                            }

                return redirect(action('User\PaypalController@payreturn'));
            } else {
                $sub = UserSubscription::where('flutter_id','=',$input['txref'])->orderBy('id','desc')->first();
                $sub->delete();
                return redirect(action('User\PaypalController@paycancle'));
            }
        
     }
}
