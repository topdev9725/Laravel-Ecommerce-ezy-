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


class DmercadopagoController extends Controller
{

    private $access_token;

    public function __construct()
    {
        //Set Spripe Keys
        $gs = Generalsetting::findOrFail(1);
        $this->access_token = $gs->mercado_token;
    }

    public function store(Request $request) {

        $user = Auth::user();
        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));

        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $available_currency = array(
            'ARS',
            'BRL',
            'CLP',
            'MXN',
            'PEN',
            'UYU',
            'VEF'
            );
            if(!in_array($curr->name,$available_currency))
            {
            return redirect()->back()->with('unsuccess','Invalid Currency For Mercadopago.');
            }


            $settings = Generalsetting::findOrFail(1);
            $return_url = action('User\DmercadopagoController@payreturn');
            $cancel_url = action('User\DmercadopagoController@paycancle');
            $notify_url = action('User\DmercadopagoController@notify');
            $item_name = "Deposit via Mercadopago";
            $item_number = str_random(4).time();
            $amount = (double)$request->amount;
        
            $curl = curl_init();

            $preferenceData = [
                'items' => [
                    [
                        'id' => $item_number,
                        'title' => $item_name,
                        'description' =>$item_name,
                        'quantity' => 1,
                        'currency_id' => $curr->name,
                        'unit_price' =>  $amount
                    ]
                ],
                'payer' => [
                    'email' => $user->email,
                ],
                'back_urls' => [
                    'success' => $return_url,
                    'pending' => '',
                    'failure' => $cancel_url,
                ],
                'notification_url' =>  $notify_url,
                'auto_return' =>  'approved',
    
            ];
    
            $httpHeader = [
                "Content-Type: application/json",
            ];
            $url = "https://api.mercadopago.com/checkout/preferences?access_token=".$this->access_token;
            $opts = [
                CURLOPT_URL             => $url,
                CURLOPT_CUSTOMREQUEST   => "POST",
                CURLOPT_POSTFIELDS      => json_encode($preferenceData,true),
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_TIMEOUT         => 30,
                CURLOPT_HTTPHEADER      => $httpHeader
            ];
    
            curl_setopt_array($curl, $opts);
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
    
            curl_close($curl);
            $payment = json_decode($response,true);
            $deposit = new Deposit;
            $deposit->user_id = $user->id;
            $deposit->currency = $curr->sign;
            $deposit->currency_code = $curr->name;
            $deposit->amount = $request->amount / $curr->value;
            $deposit->currency_value = $curr->value;
            $deposit->method = 'Mercadopago';
            $deposit->flutter_id = $item_number;
            $deposit->save();

            if($settings->mercadopago_sandbox_check == 1)
            {
                return redirect($payment['sandbox_init_point']);
            }
            else {
                return redirect($payment['init_point']);
            }
    }

    public function curlCalls($url){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $paymentData = curl_exec($ch);
        curl_close($ch);

        return $paymentData;
    }

    public function paycancle(){
        $this->code_image();
         return redirect()->back()->with('unsuccess','Payment Cancelled.');
     }

     public function payreturn(){
        $this->code_image();
        return redirect()->route('user-dashboard')->with('success','Balance has been added to your account.');
     }

    public function notify(Request $request)
    {


        $paymentUrl = "https://api.mercadopago.com/v1/payments/".$request['data']['id']."?access_token=".$this->access_token;

        $paymentData = $this->curlCalls($paymentUrl);

        $payment = json_decode($paymentData,true);

        $merchantUrl = "https://api.mercadopago.com/merchant_orders/".$payment['order']['id']."?access_token=".$this->access_token;

        $merchantData = $this->curlCalls($merchantUrl);

        $merchant = json_decode($merchantData,true);

        $order_number = $merchant['items'][0]['id'];

            if ($payment['status'] == 'approved'){

                $deposit = Deposit::where('flutter_id','=',$order_number)->orderBy('created_at','desc')->first();
                $user = User::findOrFail($deposit->user_id);
                $settings = Generalsetting::findOrFail(1);
                $user->balance = $user->balance + ($deposit->amount / $deposit->currency_value);
                $user->save();
                $deposit->txnid = $request['data']['id'];
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


            }
            else{
                $payment = Deposit::where('user_id','=',$order_number)
                    ->orderBy('created_at','desc')->first();
                $payment->delete();
            }
    }


    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."assets/images/capcha_code.png");
    }


}
