<?php

namespace App\Http\Controllers\Front;

use Mollie\Laravel\Facades\Mollie;
use App\Classes\GeniusMailer;
use App\Classes\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderTrack;
use App\Models\Pagesetting;
use App\Models\Product;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\VendorOrder;
use Config;
use Illuminate\Http\Request;
use Auth;
use Session;

class MollyController extends Controller
{
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


        $input = $request->all();
        Session::put('paypal_data',$input);

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
        $data['return_url'] = action('Front\PaymentController@notify');
        $data['cancel_url'] = action('Front\PaymentController@paycancle');
        Session::put('paypal_items',$data);


        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $this->curr->name,
                'value' => ''.sprintf('%0.2f', $order['item_amount']).'', // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => $order['item_name'] ,
            'redirectUrl' => route('molly.notify'),
            ]);

        Session::put('payment_id',$payment->id);
        Session::put('molly_data',$order);

        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);
 }



public function notify(Request $request){

        $paypal_data = Session::get('paypal_data');
        $molly_data = Session::get('molly_data');
        $success_url = action('Front\PaymentController@payreturn');
        $cancel_url = action('Front\PaymentController@paycancle');
        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));
        // dd($response);
        if($payment->status == 'paid'){

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
                    $order['pay_amount'] = $molly_data['item_amount'];
                    $order['method'] = $paypal_data['method'];
                    $order['customer_email'] = $paypal_data['email'];
                    $order['customer_name'] = $paypal_data['name'];
                    $order['customer_phone'] = $paypal_data['phone'];
                    $order['order_number'] = $molly_data['item_number'];
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
                    $order['txnid'] = $payment->id;
                    $order['wallet_price'] = round($paypal_data['wallet_price']/ $this->curr->value, 2);  
                    $order['vendor_shipping_id'] = $paypal_data['vendor_shipping_id'];
                    $order['vendor_packing_id'] = $paypal_data['vendor_packing_id'];

                    if($order['dp'] == 1)
                    {
                        $order['status'] = 'completed';
                        $val = ($molly_data['item_amount'] + $paypal_data['wallet_price']) / $this->curr->value;                        
                    }

                    // if (Session::has('affilate')) 
                    // {
                    //     $val = $molly_data['item_amount'] / $this->curr->value;
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
            'onumber' => $molly_data['item_number']
        ];

        $mailer = new GeniusMailer();
        $mailer->sendAutoOrderMail($data,$order->id);            
        }
        else
        {
           $to = $paypal_data['email'];
           $subject = "Your Order Placed!!";
           $msg = "Hello ".$paypal_data['name']."!\nYou have placed a new order.\nYour order number is ".$molly_data['item_number'].".Please wait for your delivery. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }
        //Sending Email To Admin
        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => Pagesetting::find(1)->contact_email,
                'subject' => "New Order Recieved!!",
                'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is ".$molly_data['item_number'].".Please login to your panel to check. <br>Thank you.",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);            
        }
        else
        {
           $to = Pagesetting::find(1)->contact_email;
           $subject = "New Order Recieved!!";
           $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is ".$molly_data['item_number'].".Please login to your panel to check. \nThank you.";
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
        Session::forget('cart');
        Session::forget('paypal_data');
        Session::forget('molly_data');
            return redirect($success_url);
        }
        else {
            return redirect($cancel_url);
        }
}



}
