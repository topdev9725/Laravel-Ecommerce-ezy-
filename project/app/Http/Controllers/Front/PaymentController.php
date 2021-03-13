<?php

namespace App\Http\Controllers\Front;

use App\Classes\Affiliate;

use App\Models\Generalsetting;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use App\Classes\GeniusMailer;
use App\Models\Order;
use App\Models\OrderTrack;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Pagesetting;
use App\Models\User;
use App\Models\VendorOrder;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    private $_api_context;
    public $curr;

    public function __construct()
    {
        if (Session::has('currency')) 
        {
            $this->curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $this->curr = Currency::where('is_default','=',1)->first();
        }
        $gs = Generalsetting::find(1);
        $paypal_conf = \Config::get('paypal');
        $paypal_conf['client_id'] = $gs->paypal_client_id;
        $paypal_conf['secret'] = $gs->paypal_client_secret;
        $paypal_conf['settings']['mode'] = $gs->paypal_sandbox_check == 1 ? 'sandbox' : 'live';
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function store(Request $request)
    {
        $input = $request->all();

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

        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
        }

        $settings = Generalsetting::findOrFail(1);
        $order['item_name'] = $settings->title." Order";
        $order['item_number'] = str_random(4).time();
        $order['item_amount'] = round($request->total / $this->curr->value, 2);
        $cancel_url = action('Front\PaymentController@paycancle');
        $notify_url = action('Front\PaymentController@notify');

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($order['item_name']) /** item name **/
            ->setCurrency($this->curr->name)
            ->setQuantity(1)
            ->setPrice($order['item_amount']); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($this->curr->name)
            ->setTotal($order['item_amount']);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($order['item_name'].' Via Paypal');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($notify_url) /** Specify return URL **/
            ->setCancelUrl($cancel_url);
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            return redirect()->back()->with('unsuccess',$ex->getMessage());
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_data',$input);
        Session::put('order_data',$order);
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        return redirect()->back()->with('unsuccess','Unknown error occurred');
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
        $final_results = Session::get('final_results');
        $final_price = Session::get('final_price');
        $total_delivery_fee = Session::get('total_delivery_fee');
        $every_shop_total_price = Session::get('every_shop_total_price');
        $order_infos = Session::get('order_infos');
        }
        else{
            $tempcart = '';
            return redirect()->back();
        }
        Session::forget('cart');
        // Session::forget('final_results');
        Session::forget('final_price');
        Session::forget('total_delivery_fee');
        Session::forget('every_shop_total_price');
        Session::forget('order_infos');
        return view('front.success',compact('tempcart','order', 'final_results', 'every_shop_total_price', 'final_price', 'total_delivery_fee', 'order_infos'));
     }

     public function payreturn1(){
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
        
        $all_paid_check = false;
        $final_results = Session::get('final_results');
        $new_final_results = array();
        if (!empty(Session::get('final_results'))) {
            foreach (Session::get('final_results') as $vendor_id => $products) {
                if ($vendor_id != Session::get('vendor_id')) {
                    $new_final_results[$vendor_id] = $products;
                }
                // if($vendor_id == Session::get('vendor_id')) {
                //     $removed_pids = array();
                //     foreach ($products as $product) {
                //         $removed_pids[] = $product['item']['id'];
                //     }
                // }
            }
            if (count($new_final_results) == 0) {
                Session::forget('cart');
                Session::forget('final_results');
                // Session::forget('vendor_id');
                Session::forget('every_shop_total_price');
                Session::forget('new_final_results_check');
                Session::forget('state');
                Session::forget('shipping_name');
                Session::forget('shipping_phone');
                Session::forget('shipping_address');
                Session::forget('shipping_city');
                Session::forget('shipping_state');
                Session::forget('shipping_zip');
                $all_paid_check = true;
            } else {
                Session::forget('final_results');
                Session::put('final_results', $new_final_results);
                Session::put('new_final_results_check', true);
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                // foreach ($removed_pids as $removed_pid) {
                //     $cart->removeItem($removed_pid);
                // }
                Session::put('cart', $cart);
            }
            
        } else {
            Session::forget('cart');
            Session::forget('final_results');
            // Session::forget('vendor_id');
            Session::forget('every_shop_total_price');
            Session::forget('new_final_results_check');
            Session::forget('state');
            Session::forget('shipping_name');
            Session::forget('shipping_phone');
            Session::forget('shipping_address');
            Session::forget('shipping_city');
            Session::forget('shipping_state');
            Session::forget('shipping_zip');
            $all_paid_check = true;
        }
        
        return view('front.success',compact('tempcart','order','final_results', 'all_paid_check'));
     }

    public function notify(Request $request)
    {
        $paypal_data = Session::get('paypal_data');
        $order_data = Session::get('order_data');
        $success_url = action('Front\PaymentController@payreturn');
        $cancel_url = action('Front\PaymentController@paycancle');
        $input = $request->all();
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        if (empty( $input['PayerID']) || empty( $input['token'])) {
            return redirect($cancel_url);
        } 
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($input['PayerID']);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            $resp = json_decode($payment, true);

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

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
                    $order['customer_state'] = $paypal_data['state'];
                    $order['shipping_state'] = $paypal_data['shipping_state'];
                    $order['user_id'] = $paypal_data['user_id'];
                    $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
                    $order['totalQty'] = $paypal_data['totalQty'];
                    $order['pay_amount'] = $order_data['item_amount'];
                    $order['method'] = $paypal_data['method'];
                    $order['customer_email'] = $paypal_data['email'];
                    $order['customer_name'] = $paypal_data['name'];
                    $order['customer_phone'] = $paypal_data['phone'];
                    $order['order_number'] = $order_data['item_number'];
                    $order['shipping'] = $paypal_data['shipping'];
                    $order['pickup_location'] = $paypal_data['pickup_location'];
                    $order['customer_address'] = $paypal_data['address'];
                    $order['customer_country'] = $paypal_data['customer_country'];
                    $order['customer_city'] = $paypal_data['city'];
                    $order['customer_zip'] = $paypal_data['zip'];
                    $order['shipping_email'] = $paypal_data['shipping_email'];
                    $order['shipping_name'] = $paypal_data['shipping_name'];
                    $order['shipping_phone'] = $paypal_data['shipping_phone'];
                    $order['shipping_address'] = $paypal_data['shipping_address'];
                    $order['shipping_country'] = $paypal_data['shipping_country'];
                    $order['shipping_city'] = $paypal_data['shipping_city'];
                    $order['shipping_zip'] = $paypal_data['shipping_zip'];
                    $order['order_note'] = $paypal_data['order_notes'];
                    $order['coupon_code'] = $paypal_data['coupon_code'];
                    $order['coupon_discount'] = $paypal_data['coupon_discount'];
                    $order['payment_status'] = 'Completed';
                    $order['currency_sign'] = $this->curr->sign;
                    $order['currency_value'] = $this->curr->value;
                    $order['shipping_cost'] = $paypal_data['shipping_cost'];
                    $order['packing_cost'] = $paypal_data['packing_cost'];
                    $order['tax'] = $paypal_data['tax'];
                    $order['dp'] = $paypal_data['dp'];
                    $order['txnid'] = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
                    $order['wallet_price'] = round($paypal_data['wallet_price']/ $this->curr->value, 2);  
                    $order['vendor_shipping_id'] = $paypal_data['vendor_shipping_id'];
                    $order['vendor_packing_id'] = $paypal_data['vendor_packing_id'];

                    if($order['dp'] == 1)
                    {
                        $order['status'] = 'completed';
                        $val = ($order_data['item_amount'] + $paypal_data['wallet_price']) / $this->curr->value;                        
                    }

                    // if (Session::has('affilate')) 
                    // {
                    //     $val = $order_data['item_amount'] / $this->curr->value;
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


        if($order->dp == 1){
            Affiliate::setCashback($order->user_id, $order);
            $track = new OrderTrack;
            $track->title = 'Completed';
            $track->text = 'Your order has completed successfully.';
            $track->order_id = $order->id;
            $track->save();
        }
        else {
            $track = new OrderTrack;
            $track->title = 'Pending';
            $track->text = 'You have successfully placed your order.';
            $track->order_id = $order->id;
            $track->save();
        }
                    
                    $notification = new Notification;
                    $notification->order_id = $order->id;
                    $notification->save();
                    
                    if($paypal_data['coupon_id'] != "")
                    {
                       $coupon = Coupon::findOrFail($paypal_data['coupon_id']);
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

        $gs = Generalsetting::find(1);

        //Sending Email To Buyer

        if($gs->is_smtp == 1)
        {
        $data = [
            'to' => $paypal_data['email'],
            'type' => "new_order",
            'cname' => $paypal_data['name'],
            'oamount' => "",
            'aname' => "",
            'aemail' => "",
            'wtitle' => "",
            'onumber' => $order_data['item_number']
        ];

        $mailer = new GeniusMailer();
        $mailer->sendAutoOrderMail($data,$order->id);            
        }
        else
        {
           $to = $paypal_data['email'];
           $subject = "Your Order Placed!!";
           $msg = "Hello ".$paypal_data['name']."!\nYou have placed a new order.\nYour order number is ".$order_data['item_number'].".Please wait for your delivery. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }
        //Sending Email To Admin
        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => Pagesetting::find(1)->contact_email,
                'subject' => "New Order Recieved!!",
                'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is ".$order_data['item_number'].".Please login to your panel to check. <br>Thank you.",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);            
        }
        else
        {
           $to = Pagesetting::find(1)->contact_email;
           $subject = "New Order Recieved!!";
           $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is ".$order_data['item_number'].".Please login to your panel to check. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);
        }

        Session::put('temporder',$order);
        Session::put('tempcart',$cart);
        Session::forget('cart');
        Session::forget('already');
        Session::forget('coupon');
        Session::forget('coupon_total');
        Session::forget('coupon_total1');
        Session::forget('coupon_percentage');
        Session::forget('paypal_data');
        Session::forget('order_data');
        Session::forget('paypal_payment_id');
            return redirect($success_url);

        }
        return redirect($cancel_url);
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