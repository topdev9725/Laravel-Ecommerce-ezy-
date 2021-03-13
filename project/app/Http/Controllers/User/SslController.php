<?php

namespace App\Http\Controllers\User;

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
use Illuminate\Support\Facades\Session;

class SslController extends Controller
{


    public function store(Request $request){

        $this->validate($request, [
            'shop_name'   => 'unique:users',
           ],[ 
               'shop_name.unique' => 'This shop name has already been taken.'
            ]);
     $input = $request->all();
     $user = Auth::user();
     $subs = Subscription::findOrFail($request->subs_id);
     $settings = Generalsetting::findOrFail(1);
     $txnid = "SSLCZ_TXN_".uniqid();
     if($subs->currency_code != "BDT")
     {
         return redirect()->back()->with('unsuccess','Please Select BDT Currency For SSLCommerz.');
     }

     


     $order['item_name'] = $subs->title." Plan";
     $order['item_number'] = str_random(4).time();
     $order['item_amount'] = $subs->price;



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
     $sub->method = 'SSLCommerz';
     $sub->txnid = $txnid;
     $sub->status = 0;
     $sub->save();



        $post_data = array();
        $post_data['store_id'] = $settings->ssl_store_id;
        $post_data['store_passwd'] = $settings->ssl_store_password;
        $post_data['total_amount'] = $order['item_amount'];
        $post_data['currency'] = $subs->currency_code;
        $post_data['tran_id'] = $txnid;
        $post_data['success_url'] = action('User\SslController@notify');
        $post_data['fail_url'] =  action('User\PaypalController@paycancle');
        $post_data['cancel_url'] =  action('User\PaypalController@paycancle');
        # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE
        
        
        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->name;
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = $user->address;
        $post_data['cus_city'] = $user->city;
        $post_data['cus_state'] = $user->state;
        $post_data['cus_postcode'] = $user->zip;
        $post_data['cus_country'] = $user->country;
        $post_data['cus_phone'] = $user->phone;
        $post_data['cus_fax'] = $user->phone;
        
        
        # REQUEST SEND TO SSLCOMMERZ
        if($settings->ssl_sandbox_check == 1){
            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
        }
        else{
        $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v3/api.php";
        }


        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url );
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1 );
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC
        
        
        $content = curl_exec($handle );
        
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        
        
        
        
        if($code == 200 && !( curl_errno($handle))) {
            curl_close( $handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close( $handle);
            return redirect()->back()->with('unsuccess',"FAILED TO CONNECT WITH SSLCOMMERZ API");
            exit;
        }
        
        # PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true );
        
        if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
        
             # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
            # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
            echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
            # header("Location: ". $sslcz['GatewayPageURL']);
            exit;
        } else {
            return redirect()->back()->with('unsuccess',"JSON Data parsing error!");
        }

 }



public function notify(Request $request){



        $success_url = action('User\PaypalController@payreturn');
        $cancel_url = action('User\PaypalController@paycancle');

        $input = $request->all();


        if($input['status'] == 'VALID'){

            $settings = Generalsetting::findOrFail(1);
            $subs = UserSubscription::where('txnid','=',$input['tran_id'])->orderBy('id','desc')->first();
            $subs->status = 1;
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

            return redirect($success_url);
        }
        else {
            return redirect($cancel_url);
        }

}
}
