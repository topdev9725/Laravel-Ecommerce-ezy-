<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Auth;
use Carbon\Carbon;
use Twocheckout;
use Twocheckout_Charge;
use Twocheckout_Error;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwoCheckoutController extends Controller
{
    public function store(Request $request){

        $this->validate($request, [
            'shop_name'   => 'unique:users',
           ],[ 
               'shop_name.unique' => 'This shop name has already been taken.'
            ]);
        $user = Auth::user();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($request->subs_id);
        $settings = Generalsetting::findOrFail(1);
        $item_number = str_random(4).time();
        $item_amount = $subs->price;
        $item_currency = $subs->currency_code;
    
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
                    "currency"   => $item_currency,
                    "total"      => $item_amount,
                    "billingAddr" => array(
                        "name" => $user->name,
                        "addrLine1" => $user->address,
                        "city" => $user->city,
                        "state" => $user->state,
                        "zipCode" => $user->zip,
                        "country" => $user->country,
                        "email" => $user->email,
                        "phoneNumber" => $user->phone
                    )
                ));
            
                if ($charge['response']['responseCode'] == 'APPROVED') {
        
                    $today = Carbon::now()->format('Y-m-d');
                    $date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
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
                    $sub->method = '2Checkout';
                    $sub->txnid = $charge['response']['transactionId'];
                    $sub->status = 1;
                    $sub->save();
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

                    return redirect()->route('user-dashboard')->with('success','Vendor Account Activated Successfully');
            
                }
        
            } catch (Twocheckout_Error $e) {
                return redirect()->back()->with('unsuccess',$e->getMessage());
        
            }
    
    }
}
