<?php

namespace App\Http\Controllers\Front;

use App\Classes\Affiliate;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\VendorOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MercadopagoController extends Controller
{

    private $access_token;

    public function __construct()
    {
        //Set Spripe Keys
        $gs = Generalsetting::findOrFail(1);
        $this->access_token = $gs->mercado_token;

    }

    public function store(Request $request) {

        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
         }
    
            if($request->pass_check) {
                $users = User::where('email','=',$request->personal_email)->get();
                if(count($users) == 0) {
                    if ($request->personal_pass == $request->personal_confirm){
                        $user = new User;
                        $user->name = $request->personal_name; 
                        $user->email = $request->personal_email;   
                        $user->password = bcrypt($request->personal_pass);
                        $token = md5(time().$request->personal_name.$request->personal_email);
                        $user->verification_link = $token;
                        $user->affilate_code = md5($request->name.$request->email);
                        $user->email_verified = 'Yes';
                        $user->save();
                        Auth::guard('web')->login($user);                     
                    }else{
                        return redirect()->back()->with('unsuccess',"Confirm Password Doesn't Match.");     
                    }
                }
                else {
                    return redirect()->back()->with('unsuccess',"This Email Already Exist.");  
                }
            }
    
    
         $oldCart = Session::get('cart');
         $cart = new Cart($oldCart);
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

            foreach($cart->items as $key => $prod)
            {
            if(!empty($prod['item']['license']) && !empty($prod['item']['license_qty']))
            {
                    foreach($prod['item']['license_qty']as $ttl => $dtl)
                    {
                        if($dtl != 0)
                        {
                            $dtl--;
                            $produc = Product::findOrFail($prod['item']['id']);
                            $temp = $produc->license_qty;
                            $temp[$ttl] = $dtl;
                            $final = implode(',', $temp);
                            $produc->license_qty = $final;
                            $produc->update();
                            $temp =  $produc->license;
                            $license = $temp[$ttl];
                             $oldCart = Session::has('cart') ? Session::get('cart') : null;
                             $cart = new Cart($oldCart);
                             $cart->updateLicense($prod['item']['id'],$license);  
                             Session::put('cart',$cart);
                            break;
                        }                    
                    }
            }
            }
         $settings = Generalsetting::findOrFail(1);
         $order = new Order;
         $order['customer_state'] = $request->state;
         $order['shipping_state'] = $request->shipping_state;

         $return_url = action('Front\MercadopagoController@payreturn');
         $cancel_url = action('Front\PaymentController@paycancle');
         $notify_url = action('Front\MercadopagoController@notify');
    
            $item_name = $settings->title." Order";
            $item_number = str_random(4).time();
            $item_amount = (double)$request->total;
        
            $curl = curl_init();

            $preferenceData = [
                'items' => [
                    [
                        'id' => $item_number,
                        'title' => $item_name,
                        'description' =>$item_name,
                        'quantity' => 1,
                        'currency_id' => $curr->name,
                        'unit_price' => $item_amount
                    ]
                ],
                'payer' => [
                    'email' => $request->email,
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
                        $order['user_id'] = $request->user_id;
                        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
                        $order['totalQty'] = $request->totalQty;
                        $order['pay_amount'] = round($item_amount / $curr->value, 2);
                        $order['method'] = $request->method;
                        $order['customer_email'] = $request->email;
                        $order['customer_name'] = $request->name;
                        $order['customer_phone'] = $request->phone;
                        $order['order_number'] = $item_number;
                        $order['shipping'] = $request->shipping;
                        $order['pickup_location'] = $request->pickup_location;
                        $order['customer_address'] = $request->address;
                        $order['customer_country'] = $request->customer_country;
                        $order['customer_city'] = $request->city;
                        $order['customer_zip'] = $request->zip;
                        $order['shipping_email'] = $request->shipping_email;
                        $order['shipping_name'] = $request->shipping_name;
                        $order['shipping_phone'] = $request->shipping_phone;
                        $order['shipping_address'] = $request->shipping_address;
                        $order['shipping_country'] = $request->shipping_country;
                        $order['shipping_city'] = $request->shipping_city;
                        $order['shipping_zip'] = $request->shipping_zip;
                        $order['order_note'] = $request->order_notes;
                        $order['coupon_code'] = $request->coupon_code;
                        $order['coupon_discount'] = $request->coupon_discount;
                        $order['payment_status'] = "Pending";
                        $order['currency_sign'] = $curr->sign;
                        $order['currency_value'] = $curr->value;
                        $order['shipping_cost'] = $request->shipping_cost;
                        $order['packing_cost'] = $request->packing_cost;
                        $order['shipping_title'] = $request->shipping_title;
                        $order['packing_title'] = $request->packing_title;
                        $order['tax'] = $request->tax;
                        $order['dp'] = $request->dp;
                        $order['vendor_shipping_id'] = $request->vendor_shipping_id;
                        $order['vendor_packing_id'] = $request->vendor_packing_id;
                        $order['wallet_price'] = round($request->wallet_price / $curr->value, 2);  
                        if($order['dp'] == 1)
                        {
                            $order['status'] = 'completed';
                            $val = ($request->total + $request->wallet_price) / $curr->value;
                        }


                        // if (Session::has('affilate')) 
                        // {
                        //     $val = $request->total / $curr->value;
                        //     $val = $val / 100;
                        //     $sub = $val * $settings->affilate_charge;
                        //     $user = User::findOrFail(Session::get('affilate'));
                        //     if($order['dp'] == 1)
                        //     {
                        //         $user->affilate_income += $sub;
                        //         $user->update();
                        //     }

                        //     $order['affilate_user'] = $user->id;
                        //     $order['affilate_charge'] = $sub;
                        // }
                        $order->save();
                        if($order->dp==1) Affiliate::setCashback($order->user_id, $order);
                        if(Auth::check()){
                            Auth::user()->update(['balance' => (Auth::user()->balance - $order->wallet_price)]);
                        }


                        if($request->coupon_id != "")
                        {
                           $coupon = Coupon::findOrFail($request->coupon_id);
                           $coupon->used++;
                           if($coupon->times != null)
                           {
                                $i = (int)$coupon->times;
                                $i--;
                                $coupon->times = (string)$i;
                           }
                           $coupon->update();
    
                        }
                        foreach($cart->items as $prod)
                        {
                    $x = (string)$prod['stock'];
                    if($x != null)
                    {
                                $product = Product::findOrFail($prod['item']['id']);
                                $product->stock =  $prod['stock'];
                                $product->update();                
                            }
                        }
            foreach($cart->items as $prod)
            {
                $x = (string)$prod['size_qty'];
                if(!empty($x))
                {
                    $product = Product::findOrFail($prod['item']['id']);
                    $x = (int)$x;
                    $x = $x - $prod['qty'];
                    $temp = $product->size_qty;
                    $temp[$prod['size_key']] = $x;
                    $temp1 = implode(',', $temp);
                    $product->size_qty =  $temp1;
                    $product->update();               
                }
            }
            foreach($cart->items as $prod)
            {
                $x = (string)$prod['stock'];
                if($x != null)
                {
    
                    $product = Product::findOrFail($prod['item']['id']);
                    $product->stock =  $prod['stock'];
                    $product->update();  
                    if($product->stock <= 5)
                    {
                        $notification = new Notification;
                        $notification->product_id = $product->id;
                        $notification->save();                    
                    }              
                }
            }
    
    
            $notf = null;
    
            foreach($cart->items as $prod)
            {
                if($prod['item']['user_id'] != 0)
                {
                    $vorder =  new VendorOrder;
                    $vorder->order_id = $order->id;
                    $vorder->user_id = $prod['item']['user_id'];
                    $notf[] = $prod['item']['user_id'];
                    $vorder->qty = $prod['qty'];
                    $vorder->price = $prod['price'];
                    $vorder->order_number = $order->order_number;             
                    $vorder->save();
                    if($order->dp == 1){
                        $vorder->user->update(['current_balance' => $vorder->user->current_balance += $prod['price']]);
                    }
                }
    
            }
    
            if(!empty($notf))
            {
                $users = array_unique($notf);
                foreach ($users as $user) {
                    $notification = new UserNotification;
                    $notification->user_id = $user;
                    $notification->order_number = $order->order_number;
                    $notification->save();    
                }
            }
         Session::put('temporder',$order);
         Session::put('tempcart',$cart);
         Session::forget('cart');
    
        //Sending Email To Buyer

        if($settings->is_smtp == 1)
        {
        $data = [
            'to' => $request->email,
            'type' => "new_order",
            'cname' => $request->name,
            'oamount' => "",
            'aname' => "",
            'aemail' => "",
            'wtitle' => "",
            'onumber' => $order->order_number,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendAutoOrderMail($data,$order->id);            
        }
        else
        {
           $to = $request->email;
           $subject = "Your Order Placed!!";
           $msg = "Hello ".$request->name."!\nYou have placed a new order.\nYour order number is ".$order->order_number.".Please wait for your delivery. \nThank you.";
            $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }
        //Sending Email To Admin
        if($settings->is_smtp == 1)
        {
            $data = [
                'to' => Pagesetting::find(1)->contact_email,
                'subject' => "New Order Recieved!!",
                'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is ".$order->order_number.".Please login to your panel to check. <br>Thank you.",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);            
        }
        else
        {
           $to = Pagesetting::find(1)->contact_email;
           $subject = "New Order Recieved!!";
           $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is ".$order->order_number.".Please login to your panel to check. \nThank you.";
            $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
           mail($to,$subject,$msg,$headers);
        }



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
        if(Session::has('tempcart')){
        $oldCart = Session::get('tempcart');
        $tempcart = new Cart($oldCart);
        $order = Session::get('temporder');
        }
        else{
            $tempcart = '';
            return redirect()->back();
        }

         return view('front.success',compact('tempcart','order'));
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
                $order = Order::where('order_number', $order_number)->first();
                $data['payment_status'] = "Completed";
                $data['txnid'] = $request['data']['id'];
                if($order->dp == 1)
                {
                    $data['status'] = 'completed';
                }
                $order->update($data);

                if ($order->user_id != 0 && $order->wallet_price != 0) {
                    $transaction = new \App\Models\Transaction;
                    $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
                    $transaction->user_id = $order->user_id;
                    $transaction->amount = $order->wallet_price;
                    $transaction->currency_sign = $order->currency_sign;
                    $transaction->currency_code = \App\Models\Currency::where('sign',$order->currency_sign)->first()->name;
                    $transaction->currency_value= $order->currency_value;
                    $transaction->details = 'Payment Via Wallet';
                    $transaction->type = 'minus';
                    $transaction->save();
                }


                $notification = new Notification;
                $notification->order_id = $order->id;
                $notification->save();
                Session::forget('cart');

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
