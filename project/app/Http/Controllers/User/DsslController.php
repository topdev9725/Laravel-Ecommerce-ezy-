<?php

namespace App\Http\Controllers\User;

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

class DsslController extends Controller
{
    public function store(Request $request){
        $user = Auth::user();
        $txnid = "SSLCZ_TXN_".uniqid();
        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
            $item_amount = $request->amount;
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
            $item_amount = $request->amount;
        }

        if($curr->name != "BDT")
        {
            return redirect()->back()->with('unsuccess','Please Select BDT Currency For SSLCommerz.');
        }

        $cancel_url = action('User\DpaypalController@paycancle');
        $notify_url = action('User\DsslController@notify');
        $settings = Generalsetting::findOrFail(1);

      
        $deposit = new Deposit;
        $deposit->user_id = $user->id;
        $deposit->currency = $curr->sign;
        $deposit->currency_code = $curr->name;
        $deposit->amount = $request->amount / $curr->value;
        $deposit->currency_value = $curr->value;
        $deposit->method = 'SSLCommerz';
        $deposit->txnid = $txnid;
        $deposit->save();


        $data['total'] =  $item_amount;
        $data['return_url'] = $notify_url;
        $data['cancel_url'] = $cancel_url;
        Session::put('paypal_items',$data);

        $post_data = array();
        $post_data['store_id'] = $settings->ssl_store_id;
        $post_data['store_passwd'] = $settings->ssl_store_password;
        $post_data['total_amount'] = $item_amount;
        $post_data['currency'] = $curr->name;
        $post_data['tran_id'] = $txnid;
        $post_data['success_url'] = action('User\DsslController@notify');
        $post_data['fail_url'] =  action('User\DpaypalController@paycancle');
        $post_data['cancel_url'] =  action('User\DpaypalController@paycancle');
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


        $cancel_url = action('User\DpaypalController@paycancle');
        $input = $request->all();


        if($input['status'] == 'VALID'){


            $deposit = Deposit::where('txnid','=',$input['tran_id'])->orderBy('created_at','desc')->first();
            $user = User::findOrFail($deposit->user_id);
            $settings = Generalsetting::findOrFail(1);
            $user->balance = $user->balance + ($deposit->amount / $deposit->currency_value);
            $user->save();

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
        }
        else {
            return redirect($cancel_url);
        }


    }
}
