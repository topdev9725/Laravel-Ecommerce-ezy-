<?php

namespace App\Http\Controllers\Front;

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
use App\Models\PaymentGateway;
use App\Models\Pickup;
use App\Models\Product;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\VendorOrder;
use App\Models\DeliveryFee;
use App\Models\DeliveryCoupon;
use App\Models\Province;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;
use Validator;

class CheckoutController extends Controller
{
    public function loadpayment($slug1,$slug2)
    {
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        }
        else {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $payment = $slug1;
        $pay_id = $slug2;
        $gateway = '';
        if($pay_id != 0) {
            $gateway = PaymentGateway::findOrFail($pay_id);
        }
        return view('load.payment',compact('payment','pay_id','gateway','curr'));
    }

    public function checkout()
    {
        $this->code_image();
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
        }

        $gs = Generalsetting::findOrFail(1);
        $dp = 1;
        $vendor_shipping_id = 0;
        $vendor_packing_id = 0;
            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }

// If a user is Authenticated then there is no problm user can go for checkout

        if(Auth::guard('web')->check())
        {
                $gateways =  PaymentGateway::where('status','=',1)->get();
                $pickups = Pickup::all();
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $products = $cart->items;

                // Shipping Method

                if($gs->multiple_shipping == 1)
                {                        
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {

                        $shipping_data  = DB::table('shippings')->where('user_id','=',$users[0])->get();
                        if(count($shipping_data) == 0){
                            $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_shipping_id = $users[0];
                        }
                    }
                    else {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                    }

                }
                else{
                $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                }

                // Packaging

                if($gs->multiple_packaging == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $package_data  = DB::table('packages')->where('user_id','=',$users[0])->get();
                        if(count($package_data) == 0){
                            $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_packing_id = $users[0];
                        }
                    }
                    else {
                        $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                    }

                }
                else{
                $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                }


                foreach ($products as $prod) {
                    if($prod['item']['type'] == 'Physical')
                    {
                        $dp = 0;
                        break;
                    }
                }
                if($dp == 1)
                {
                $ship  = 0;                    
                }
                $total = $cart->totalPrice;
                $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
                if($gs->tax != 0)
                {
                    $tax = ($total / 100) * $gs->tax;
                    $total = $total + $tax;
                }
                if(!Session::has('coupon_total'))
                {
                $total = $total - $coupon;     
                $total = $total + 0;               
                }
                else {
                $total = Session::get('coupon_total');  
                $total = $total + round(0 * $curr->value, 2); 
                }
        return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr,'shipping_data' => $shipping_data,'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);             
        }

        else

        {
// If guest checkout is activated then user can go for checkout
           	if($gs->guest_checkout == 1)
              {
                $gateways =  PaymentGateway::where('status','=',1)->get();
                $pickups = Pickup::all();
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $products = $cart->items;

                // Shipping Method

                if($gs->multiple_shipping == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',$users[0])->get();

                        if(count($shipping_data) == 0){
                            $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_shipping_id = $users[0];
                        }                        
                    }
                    else {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                    }

                }
                else{
                $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                }

                // Packaging

                if($gs->multiple_packaging == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $package_data  = DB::table('packages')->where('user_id','=',$users[0])->get();

                        if(count($package_data) == 0){
                            $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_packing_id = $users[0];
                        }  
                    }
                    else {
                        $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                    }

                }
                else{
                $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                }


                foreach ($products as $prod) {
                    if($prod['item']['type'] == 'Physical')
                    {
                        $dp = 0;
                        break;
                    }
                }
                if($dp == 1)
                {
                $ship  = 0;                    
                }
                $total = $cart->totalPrice;
                $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
                if($gs->tax != 0)
                {
                    $tax = ($total / 100) * $gs->tax;
                    $total = $total + $tax;
                }
                if(!Session::has('coupon_total'))
                {
                $total = $total - $coupon;     
                $total = $total + 0;               
                }
                else {
                $total = Session::get('coupon_total');  
                $total =  str_replace($curr->sign,'',$total) + round(0 * $curr->value, 2); 
                }
                foreach ($products as $prod) {
                    if($prod['item']['type'] != 'Physical')
                    {
                        if(!Auth::guard('web')->check())
                        {
                $ck = 1;
        return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'checked' => $ck, 'digital' => $dp, 'curr' => $curr,'shipping_data' => $shipping_data,'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);  
                        }
                    }
                }
        return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr,'shipping_data' => $shipping_data,'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);                 
               }

// If guest checkout is Deactivated then display pop up form with proper error message

                    else{
                $gateways =  PaymentGateway::where('status','=',1)->get();
                $pickups = Pickup::all();
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $products = $cart->items;

                // Shipping Method

                if($gs->multiple_shipping == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',$users[0])->get();

                        if(count($shipping_data) == 0){
                            $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_shipping_id = $users[0];
                        }  
                    }
                    else {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                    }

                }
                else{
                $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                }

                // Packaging

                if($gs->multiple_packaging == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $package_data  = DB::table('packages')->where('user_id','=',$users[0])->get();

                        if(count($package_data) == 0){
                            $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_packing_id = $users[0];
                        }  
                    }
                    else {
                        $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                    }

                }
                else{
                $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                }


                $total = $cart->totalPrice;
                $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
                if($gs->tax != 0)
                {
                    $tax = ($total / 100) * $gs->tax;
                    $total = $total + $tax;
                }
                if(!Session::has('coupon_total'))
                {
                $total = $total - $coupon;     
                $total = $total + 0;               
                }
                else {
                $total = Session::get('coupon_total');  
                $total = $total + round(0 * $curr->value, 2); 
                }
                $ck = 1;
        return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'checked' => $ck, 'digital' => $dp, 'curr' => $curr,'shipping_data' => $shipping_data,'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id]);                 
                    }
        }

    }

    // ----------------Ezy
    public function shippingdetailcheckout(Request $request) 
    {
        $state = $request->state;
        $total_price = $request->total_price;
        
        //--------------------------------------------------------- new updated start
        $province_info = Province::where('province_name', $state)->first();
        $store_delivery_fees = array();
        foreach(Session::get('final_results') as $vendor_id => $product) {
            $store_delivery_fees[$vendor_id]['shop_name'] = User::where('id', '=', $vendor_id)->first()->shop_name;
            $state_delivery_fee = DeliveryFee::where('vendor_id', $vendor_id)->whereRaw("JSON_CONTAINS(province_ids,".$province_info->id.",'$')=1")->first();
            if (!empty($state_delivery_fee)) {
                $store_delivery_fees[$vendor_id]['delivery_fee'] = $state_delivery_fee->delivery_fee;
            } else {
                $store_delivery_fees[$vendor_id]['delivery_fee'] = "impossible";
            }
        }
        Session::put("store_delivery_fees", $store_delivery_fees);

        $data['status'] = 0;
        $data['store_delivery_fees'] = '';
        foreach ($store_delivery_fees as $store_delivery_fee) {
            if ($store_delivery_fee['delivery_fee'] == "impossible") {
                return $store_delivery_fee;
            } else {
                continue;
            }
        }
        
        //--------------------------- get delivery coupon
        foreach (Session::get('final_results') as $vendor_id => $product) {
            $store_delivery_coupons[$vendor_id]['shop_name'] = User::where('id', '=', $vendor_id)->first()->shop_name;
            $province_info = Province::where('province_name', $state)->first();
            $state_class = DeliveryFee::where('vendor_id', $vendor_id)->whereRaw("JSON_CONTAINS(province_ids,".$province_info->id.",'$')=1")->first();
            $shop_delivery_coupon = DeliveryCoupon::where('vendor_id', $vendor_id)
                                                   ->where('deliveryfee_id', $state_class->id)
                                                   ->where('min_amount', '<=', Session::get('every_shop_total_price')[$vendor_id])
                                                   ->where('max_amount', '>=', Session::get('every_shop_total_price')[$vendor_id])
                                                   ->first();
            if (!empty($shop_delivery_coupon)) {
                $store_delivery_coupons[$vendor_id]['delivery_coupon'] = $shop_delivery_coupon->delivery_rate;
            } else {
                $store_delivery_coupons[$vendor_id]['delivery_coupon'] = 100;
            }
        } 
        Session::put("store_delivery_coupons", $store_delivery_coupons);

        $data['store_delivery_coupons'] = "";
        foreach ($store_delivery_coupons as $vendor_id => $store_delivery_coupon) {
            $data['store_delivery_coupons'] .= "
            <li style='padding: 0px 20px'>
                <label class='form-check-label' for='radio2' style='font-size: 12px;'>
                    <i class='fa fa-check' style='font-size:12px;margin-right: 5px;color: #00b14f'></i>".
                        $store_delivery_coupon['shop_name']
                ."</label>
                <P>
                    <b style='font-size: 12px;'>".$store_delivery_coupon['delivery_coupon'].' %'."</b>
                </P>
            </li>";
        }
        
        $data['status'] = 1;
        $data['store_delivery_fees'] = "";
        $data['total_delivery_fee'] =0;
        foreach ($store_delivery_fees as $vendor_id => $store_delivery_fee) {
            $data['store_delivery_fees'] .= "
            <li style='padding: 0px 20px' class='delivery_fee'>
                <label class='form-check-label' for='radio2' style='font-size: 12px'>
                    <i class='fa fa-check' style='font-size:12px;color: #00b14f;margin-right: 5px'></i>".$store_delivery_fee['shop_name'].
                "</label>
                <P>
                    <b style='font-size: 12px'>RM ".$store_delivery_fee['delivery_fee']."</b>
                </P>
            </li>";
            
            $data['total_delivery_fee'] += $store_delivery_fee['delivery_fee'] * Session::get("store_delivery_coupons")[$vendor_id]['delivery_coupon']/100;
        }

        $data['final_price'] = 'RM '.number_format($total_price + $data['total_delivery_fee'], 2);
        $data['final_price_number'] = $total_price + $data['total_delivery_fee'];
        Session::put('final_price', $data['final_price']);
        Session::put('total_delivery_fee', $data['total_delivery_fee']);
        //----------------------------------------------------------- new updated end

        Session::put('shipping_name', $request->shipping_name);
        Session::put('shipping_phone', $request->shipping_phone);
        Session::put('shipping_address', $request->shipping_address);
        Session::put('shipping_city', $request->shipping_city);
        Session::put('shipping_state', $request->shipping_state);
        Session::put('shipping_zip', $request->shipping_zip);

        return $data;
    }

    // ---------- Ezy 
    public function shopcheckout(Request $request)
    {
        if (!empty($request->vendor_id)) {
            Session::put('vendor_id', $request->vendor_id);
        }

        //---------------somchai
        $shop_delivery_fees = array();
        $delivery_fees = DeliveryFee::where('vendor_id', Session::get('vendor_id'))->get();
        if (count($delivery_fees) != 0) {
            foreach($delivery_fees as $delivery_fee) {
                $shop_delivery_fees[$delivery_fee->id]['delivery_fee'] = $delivery_fee->delivery_fee;
                $shop_delivery_fees[$delivery_fee->id]['province_name'] = '';
                $ori_province_ids = substr($delivery_fee->province_ids, 1);
                $ori_province_ids = substr($ori_province_ids, 0, -1);
                $new_province_ids = explode(',', $ori_province_ids);
                foreach ($new_province_ids as $new_province_id) {
                    $shop_delivery_fees[$delivery_fee->id]['province_name'] .= Province::where('id', $new_province_id)->first()->province_name . ', ';
                }
                $shop_delivery_fees[$delivery_fee->id]['province_name'] = substr($shop_delivery_fees[$delivery_fee->id]['province_name'], 0, -2);
            }
        }

        $store_delivery_coupons = array();
        foreach (Session::get('final_results') as $vendor_id => $product) {
            $store_delivery_coupons[$vendor_id]['shop_name'] = User::where('id', '=', $vendor_id)->shop_name;
            $shop_delivery_coupon = DeliveryCoupon::where('vendor_id', $vendor_id)
                                                   ->where('min_amount', '<=', Session::get('every_shop_total_price')[$vendor_id])
                                                   ->where('max_amount', '>=', Session::get('every_shop_total_price')[$vendor_id])
                                                   ->first();
            if (!empty($shop_delivery_coupon)) {
                $store_delivery_coupons[$vendor_id]['delivery_coupon'] = $shop_delivery_coupon->delivery_rate;
            } else {
                $store_delivery_coupons[$vendor_id]['delivery_coupon'] = 0;
            }
        }
        // $shop_delivery_coupons = DeliveryCoupon::where('vendor_id', Session::get('vendor_id'))->get();
        
        $this->code_image();
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
        }
        $gs = Generalsetting::findOrFail(1);
        $dp = 1;
        $vendor_shipping_id = 0;
        $vendor_packing_id = 0;
            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }

// If a user is Authenticated then there is no problm user can go for checkout

        if(Auth::guard('web')->check())
        {
                $gateways =  PaymentGateway::where('status','=',1)->get();
                $pickups = Pickup::all();
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $products = $cart->items;

                // Shipping Method

                if($gs->multiple_shipping == 1)
                {                        
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {

                        $shipping_data  = DB::table('shippings')->where('user_id','=',$users[0])->get();
                        if(count($shipping_data) == 0){
                            $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_shipping_id = $users[0];
                        }
                    }
                    else {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                    }

                }
                else{
                $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                }

                // Packaging

                if($gs->multiple_packaging == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $package_data  = DB::table('packages')->where('user_id','=',$users[0])->get();
                        if(count($package_data) == 0){
                            $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_packing_id = $users[0];
                        }
                    }
                    else {
                        $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                    }

                }
                else{
                $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                }


                foreach ($products as $prod) {
                    if($prod['item']['type'] == 'Physical')
                    {
                        $dp = 0;
                        break;
                    }
                }
                if($dp == 1)
                {
                $ship  = 0;                    
                }
                $total = $cart->totalPrice;
                $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
                if($gs->tax != 0)
                {
                    $tax = ($total / 100) * $gs->tax;
                    $total = $total + $tax;
                }
                if(!Session::has('coupon_total'))
                {
                $total = $total - $coupon;     
                $total = $total + 0;               
                }
                else {
                $total = Session::get('coupon_total');  
                $total = $total + round(0 * $curr->value, 2); 
                }
        return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr,'shipping_data' => $shipping_data,'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id, 'shop_delivery_fees' => $shop_delivery_fees, 'store_delivery_coupons' => $store_delivery_coupons]);             
        }

        else

        {
// If guest checkout is activated then user can go for checkout
           	if($gs->guest_checkout == 1)
              {
                $gateways =  PaymentGateway::where('status','=',1)->get();
                $pickups = Pickup::all();
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $products = $cart->items;

                // Shipping Method

                if($gs->multiple_shipping == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',$users[0])->get();

                        if(count($shipping_data) == 0){
                            $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_shipping_id = $users[0];
                        }                        
                    }
                    else {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                    }

                }
                else{
                $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                }

                // Packaging

                if($gs->multiple_packaging == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $package_data  = DB::table('packages')->where('user_id','=',$users[0])->get();

                        if(count($package_data) == 0){
                            $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_packing_id = $users[0];
                        }  
                    }
                    else {
                        $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                    }

                }
                else{
                $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                }


                foreach ($products as $prod) {
                    if($prod['item']['type'] == 'Physical')
                    {
                        $dp = 0;
                        break;
                    }
                }
                if($dp == 1)
                {
                $ship  = 0;                    
                }
                $total = $cart->totalPrice;
                $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
                if($gs->tax != 0)
                {
                    $tax = ($total / 100) * $gs->tax;
                    $total = $total + $tax;
                }
                if(!Session::has('coupon_total'))
                {
                $total = $total - $coupon;     
                $total = $total + 0;               
                }
                else {
                $total = Session::get('coupon_total');  
                $total =  str_replace($curr->sign,'',$total) + round(0 * $curr->value, 2); 
                }
                foreach ($products as $prod) {
                    if($prod['item']['type'] != 'Physical')
                    {
                        if(!Auth::guard('web')->check())
                        {
                $ck = 1;
        return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'checked' => $ck, 'digital' => $dp, 'curr' => $curr,'shipping_data' => $shipping_data,'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id, 'shop_delivery_fees' => $shop_delivery_fees, 'store_delivery_coupons' => $store_delivery_coupons]);  
                        }
                    }
                }
        return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'digital' => $dp, 'curr' => $curr,'shipping_data' => $shipping_data,'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id, 'shop_delivery_fees' => $shop_delivery_fees, 'store_delivery_coupons' => $store_delivery_coupons]);                 
               }

// If guest checkout is Deactivated then display pop up form with proper error message

                    else{
                $gateways =  PaymentGateway::where('status','=',1)->get();
                $pickups = Pickup::all();
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $products = $cart->items;

                // Shipping Method

                if($gs->multiple_shipping == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',$users[0])->get();

                        if(count($shipping_data) == 0){
                            $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_shipping_id = $users[0];
                        }  
                    }
                    else {
                        $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                    }

                }
                else{
                $shipping_data  = DB::table('shippings')->where('user_id','=',0)->get();
                }

                // Packaging

                if($gs->multiple_packaging == 1)
                {
                    $user = null;
                    foreach ($cart->items as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $users = array_unique($user);
                    if(count($users) == 1)
                    {
                        $package_data  = DB::table('packages')->where('user_id','=',$users[0])->get();

                        if(count($package_data) == 0){
                            $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                        }
                        else{
                            $vendor_packing_id = $users[0];
                        }  
                    }
                    else {
                        $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                    }

                }
                else{
                $package_data  = DB::table('packages')->where('user_id','=',0)->get();
                }


                $total = $cart->totalPrice;
                $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
                if($gs->tax != 0)
                {
                    $tax = ($total / 100) * $gs->tax;
                    $total = $total + $tax;
                }
                if(!Session::has('coupon_total'))
                {
                $total = $total - $coupon;     
                $total = $total + 0;               
                }
                else {
                $total = Session::get('coupon_total');  
                $total = $total + round(0 * $curr->value, 2); 
                }
                $ck = 1;
        return view('front.checkout', ['products' => $cart->items, 'totalPrice' => $total, 'pickups' => $pickups, 'totalQty' => $cart->totalQty, 'gateways' => $gateways, 'shipping_cost' => 0, 'checked' => $ck, 'digital' => $dp, 'curr' => $curr,'shipping_data' => $shipping_data,'package_data' => $package_data, 'vendor_shipping_id' => $vendor_shipping_id, 'vendor_packing_id' => $vendor_packing_id, 'shop_delivery_fees' => $shop_delivery_fees, 'store_delivery_coupons' => $store_delivery_coupons]);                 
                    }
        }

    }


    public function cashondelivery(Request $request)
    {
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
                    $user->emai_verified = 'Yes';
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
            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }
        $gs = Generalsetting::findOrFail(1);
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
        $order = new Order;
        $order['customer_state'] = Auth::user()->state;
        $order['shipping_state'] = $request->shipping_state;
        $success_url = action('Front\PaymentController@payreturn');
        $item_name = $gs->title." Order";
        $item_number = str_random(4).time();
        $order['user_id'] = Auth::user()->id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9)); 
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round($request->total / $curr->value, 2);
        $order['method'] = $request->method;
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;
        $order['customer_email'] = Auth::user()->email;
        $order['customer_name'] = Auth::user()->name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;
        $order['shipping_title'] = $request->shipping_title;
        $order['packing_title'] = $request->packing_title;
        $order['tax'] = $request->tax;
        $order['customer_phone'] = Auth::user()->phone;
        $order['order_number'] = str_random(4).time();
        $order['customer_address'] = Auth::user()->address;
        $order['customer_country'] = Auth::user()->country;
        $order['customer_city'] = Auth::user()->city;
        $order['customer_zip'] = Auth::user()->zip;
        $order['shipping_email'] = $request->shipping_email;
        $order['shipping_name'] = $request->shipping_name;
        $order['shipping_phone'] = $request->shipping_phone;
        $order['shipping_address'] = $request->shipping_address;
        $order['shipping_country'] = "Malaysia";
        $order['shipping_city'] = $request->shipping_city;
        $order['shipping_zip'] = $request->shipping_zip;
        $order['order_note'] = $request->order_notes;
        $order['coupon_code'] = $request->coupon_code;
        $order['coupon_discount'] = $request->coupon_discount;
        $order['dp'] = $request->dp;
        $order['payment_status'] = "Pending";
        $order['currency_sign'] = $curr->sign;
        $order['currency_value'] = $curr->value;
        $order['vendor_shipping_id'] = $request->vendor_shipping_id;
        $order['vendor_packing_id'] = $request->vendor_packing_id;
        $order['wallet_price'] = round($request->wallet_price / $curr->value, 2);
        $order['vendor_id'] = Session::get('vendor_id');
            if (Session::has('affilate')) 
            {
                $order['affilate_user'] = $user->name;
                $order['affilate_charge'] = $sub;
            }
        $order->save();
        if(Auth::check()){
            Auth::user()->update(['balance' => (Auth::user()->balance - $order->wallet_price)]);
        }
        $track = new OrderTrack;
        $track->title = 'Pending';
        $track->text = 'You have successfully placed your order.';
        $track->order_id = $order->id;
        $track->save();

        $notification = new Notification;
        $notification->order_id = $order->id;
        $notification->save();
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

            Session::put('temporder',$order);
            Session::put('tempcart',$cart);
            Session::forget('cart');
            //--------------------
            Session::forget('final_results');
            Session::forget('vendor_id');
            Session::forget('every_shop_total_price');
            //----------------------
            Session::forget('already');
            Session::forget('coupon');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('coupon_percentage');



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

        //Sending Email To Buyer

        if($gs->is_smtp == 1)
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
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }
        //Sending Email To Admin
        if($gs->is_smtp == 1)
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
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);
        }

        return redirect($success_url);
    }

    public function gateway(Request $request)
    {

$input = $request->all();

$rules = [
    'txn_id4' => 'required',
];


$messages = [
    'required' => 'The Transaction ID field is required.',
];

$validator = Validator::make($input, $rules, $messages);

       if ($validator->fails()) {
            Session::flash('unsuccess', $validator->messages()->first());
            return redirect()->back()->withInput();
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

        $gs = Generalsetting::findOrFail(1);
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
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
        $order['customer_state'] = Auth::user()->state;
        $order['shipping_state'] = $request->shipping_state;
        $success_url = action('Front\PaymentController@payreturn');
        $item_name = $settings->title." Order";
        $item_number = str_random(4).time();
        $order['user_id'] = Auth::user()->id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round($request->total / $curr->value, 2);
        $order['method'] = $request->method;
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;
        $order['customer_email'] = Auth::user()->email;
        $order['customer_name'] = Auth::user()->name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;
        $order['shipping_title'] = $request->shipping_title;
        $order['packing_title'] = $request->packing_title;
        $order['tax'] = $request->tax;
        $order['customer_phone'] = Auth::user()->phone;
        $order['order_number'] = str_random(4).time();
        $order['customer_address'] = Auth::user()->address;
        $order['customer_country'] = Auth::user()->country;
        $order['customer_city'] = Auth::user()->city;
        $order['customer_zip'] = Auth::user()->zip;
        $order['shipping_email'] = $request->shipping_email;
        $order['shipping_name'] = $request->shipping_name;
        $order['shipping_phone'] = $request->shipping_phone;
        $order['shipping_address'] = $request->shipping_address;
        $order['shipping_country'] = $request->shipping_country;
        $order['shipping_city'] = $request->shipping_city;
        $order['shipping_zip'] = $request->shipping_zip;
        $order['order_note'] = $request->order_notes;
        $order['txnid'] = $request->txn_id4;
        $order['coupon_code'] = $request->coupon_code;
        $order['coupon_discount'] = $request->coupon_discount;
        $order['dp'] = $request->dp;
        $order['payment_status'] = "Pending";
        $order['currency_sign'] = $curr->sign;
        $order['currency_value'] = $curr->value;
        $order['vendor_shipping_id'] = $request->vendor_shipping_id;
        $order['vendor_packing_id'] = $request->vendor_packing_id;  
        $order['wallet_price'] = round($request->wallet_price / $curr->value, 2);     
            if (Session::has('affilate')) 
            {
                $order['affilate_user'] = $user->name;
                $order['affilate_charge'] = $sub;
            }
        $order->save();
        if(Auth::check()){
            Auth::user()->update(['balance' => (Auth::user()->balance - $order->wallet_price)]);
        }
        $track = new OrderTrack;
        $track->title = 'Pending';
        $track->text = 'You have successfully placed your order.';
        $track->order_id = $order->id;
        $track->save();
        
        $notification = new Notification;
        $notification->order_id = $order->id;
        $notification->save();
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

        Session::put('temporder',$order);
        Session::put('tempcart',$cart);
        Session::forget('cart');
        //-------------------------
        Session::forget('final_results');
        Session::forget('vendor_id');
        Session::forget('every_shop_total_price');
        //------------------------------
        Session::forget('already');
        Session::forget('coupon');
        Session::forget('coupon_total');
        Session::forget('coupon_total1');
        Session::forget('coupon_percentage');

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

        //Sending Email To Buyer
        if($gs->is_smtp == 1)
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
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }
        //Sending Email To Admin
        if($gs->is_smtp == 1)
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
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);
        }

        return redirect($success_url);
    }


    public function wallet(Request $request)
    {
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
                    $user->emai_verified = 'Yes';
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
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        } else {
            $curr = Currency::where('is_default','=',1)->first();
        }

        $gs = Generalsetting::findOrFail(1);

        $order_infos = array();
        $final_results = Session::get('final_results');
        foreach (Session::get("final_results") as $vendor_id => $products) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            //remain products according to every vendor
            foreach ($final_results as $store_id => $products) {
                if($store_id != $vendor_id) {
                    $remove_pids = array();
                    foreach ($products as $product) {
                        $remove_pids[] = $product['item']['id'];
                    }
                    foreach ($remove_pids as $remove_pid) {
                        $cart->removeItem($remove_pid);
                    }
                }
            }

            foreach($cart->items as $key => $prod)
            {
                if(!empty($prod['item']['license']) && !empty($prod['item']['license_qty']))
                {
                    foreach($prod['item']['license_qty'] as $ttl => $dtl)
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

            // get product quantity according to every shop
            $every_shop_qty = 0;
            foreach ($products as $product) {
                $every_shop_qty += $product['qty'];
            }
            
            $order = new Order;
            $order['customer_state'] = $request->state;
            $order['shipping_state'] = $request->shipping_state;
            $success_url = action('Front\PaymentController@payreturn');
            $item_name = $gs->title." Order";
            $item_number = str_random(4).time().$vendor_id;
            $order['user_id'] = Auth::user()->id;
            $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9)); 
            // $order['totalQty'] = $request->totalQty;
            $order['totalQty'] = $every_shop_qty;                          
            $order['pay_amount'] = 0;      //------------------------- ?
            $order['method'] = 'Wallet';
            $order['shipping'] = $request->shipping;
            $order['pickup_location'] = $request->pickup_location;
            $order['customer_email'] = Auth::user()->email;
            $order['customer_name'] = Auth::user()->name;
            $order['shipping_cost'] = $request->shipping_cost;
            $order['packing_cost'] = $request->packing_cost;
            $order['shipping_title'] = $request->shipping_title;
            $order['packing_title'] = $request->packing_title;
            $order['tax'] = $request->tax;
            $order['customer_phone'] = Auth::user()->phone;
            $order['order_number'] = str_random(4).time().$vendor_id;
            $order['customer_address'] = Auth::user()->address;
            $order['customer_country'] = Auth::user()->country;
            $order['customer_city'] = Auth::user()->city;
            $order['customer_zip'] = Auth::user()->zip;
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
            $order['dp'] = $request->dp;
            $order['payment_status'] = "Completed";
            $order['currency_sign'] = $curr->sign;
            $order['currency_value'] = $curr->value;
            $order['vendor_shipping_id'] = $request->vendor_shipping_id;
            $order['vendor_packing_id'] = $request->vendor_packing_id;
            $wallet_price = round(Session::get('every_shop_total_price')[$vendor_id] / $curr->value, 2);
            $order['wallet_price'] = $wallet_price + Session::get('store_delivery_fees')[$vendor_id]['delivery_fee'] * Session::get('store_delivery_coupons')[$vendor_id]['delivery_coupon'] / 100;         
            $order['vendor_id'] = $vendor_id;
            $order['message'] = Session::get('message_'.$vendor_id);
            $order['delivery_cost'] = Session::get('store_delivery_fees')[$vendor_id]['delivery_fee'] * Session::get('store_delivery_coupons')[$vendor_id]['delivery_coupon'] / 100;
            if($order['dp'] == 1)
            {
                $order['status'] = 'completed';
                $val = ($request->total + $wallet_price) / $curr->value;            
            }
            $order->save();
            $order_infos[$vendor_id]['order_number'] = $order->order_number;

            if($order->dp==1) Affiliate::setCashback($order->user_id, $order);
            
            if(Auth::check()){
                Auth::user()->update(['balance' => (Auth::user()->balance - $order->wallet_price)]);
            }
    
            $track = new OrderTrack;
            $track->title = 'Pending';
            $track->text = 'You have successfully placed your order.';
            $track->order_id = $order->id;
            $track->save();
    
            $notification = new Notification;
            $notification->order_id = $order->id;
            $notification->save();
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
            $n = 0;
            $delivery_cost = Session::get('store_delivery_fees')[$vendor_id]['delivery_fee'] * Session::get('store_delivery_coupons')[$vendor_id]['delivery_coupon'] / 100;
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
                    $vorder->message = Session::get('message_'.$prod['item']['user_id']);
                    $vorder->order_number = $order->order_number;
                    if($n==0) $vorder->delivery_fee = $delivery_cost;
                    $n++;
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
    
            Session::put('temporder',$order);
            Session::put('tempcart',$cart);
    
            // Session::forget('cart');
    
                Session::forget('already');
                Session::forget('coupon');
                Session::forget('coupon_total');
                Session::forget('coupon_total1');
                Session::forget('coupon_percentage');
    
    
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
    
            //Sending Email To Buyer
    
            if($gs->is_smtp == 1)
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
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                // mail($to,$subject,$msg,$headers);   // Liyin         
            }
            //Sending Email To Admin
            if($gs->is_smtp == 1)
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
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                // mail($to,$subject,$msg,$headers); // Liyin
            }
        }
        Session::put('order_infos', $order_infos);

        return redirect($success_url);
    }
    
    public function primepay(Request $request)
    {
        $status = $request->status;
        if ($status != 1) {
            return redirect(route('front.checkout'));
        } else {
            $request = Session::get('request');
        
            // if($request['pass_check']) {
            //     $users = User::where('email','=',$request['personal_email'])->get();
            //     if(count($users) == 0) {
            //         if ($request['personal_pass'] == $request['personal_confirm']){
            //             $user = new User;
            //             $user->name = $request['personal_name']; 
            //             $user->email = $request['personal_email'];   
            //             $user->password = bcrypt($request['personal_pass']);
            //             $token = md5(time().$request['personal_name'].$request['personal_email']);
            //             $user->verification_link = $token;
            //             $user->affilate_code = md5($request['name'].$request['email']);
            //             $user->email_verified = 'Yes';
            //             $user->save();
            //             Auth::guard('web')->login($user);                     
            //         }else{
            //             return redirect()->back()->with('unsuccess',"Confirm Password Doesn't Match.");     
            //         }
            //     }
            //     else {
            //         return redirect()->back()->with('unsuccess',"This Email Already Exist.");  
            //     }
            // }

            if (!Session::has('cart')) {
                return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
            }
            if (Session::has('currency')) {
                $curr = Currency::find(Session::get('currency'));
            } else {
                $curr = Currency::where('is_default','=',1)->first();
            }

            $gs = Generalsetting::findOrFail(1);

            $order_infos = array();
            $final_results = Session::get('final_results');
            foreach (Session::get("final_results") as $vendor_id => $products) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);

                //remain products according to every vendor
                foreach ($final_results as $store_id => $products) {
                    if($store_id != $vendor_id) {
                        $remove_pids = array();
                        foreach ($products as $product) {
                            $remove_pids[] = $product['item']['id'];
                        }
                        foreach ($remove_pids as $remove_pid) {
                            $cart->removeItem($remove_pid);
                        }
                    }
                }

                foreach($cart->items as $key => $prod)
                {
                    if(!empty($prod['item']['license']) && !empty($prod['item']['license_qty']))
                    {
                        foreach($prod['item']['license_qty'] as $ttl => $dtl)
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

                // get product quantity according to every shop
                $every_shop_qty = 0;
                foreach ($products as $product) {
                    $every_shop_qty += $product['qty'];
                }
                
                $order = new Order;
                // $order['customer_state'] = $request['state'];
                $order['shipping_state'] = $request['shipping_state'];
                $success_url = action('Front\PaymentController@payreturn');
                $item_name = $gs->title." Order";
                $item_number = str_random(4).time().$vendor_id;
                $order['user_id'] = Auth::user()->id;
                $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9)); 
                // $order['totalQty'] = $request->totalQty;
                $order['totalQty'] = $every_shop_qty;                          
                $order['pay_amount'] = 0;      //------------------------- ?
                $order['method'] = 'Prime';
                // $order['shipping'] = $request['shipping'];
                // $order['pickup_location'] = $request['pickup_location'];
                $order['customer_email'] = Auth::user()->email;
                $order['customer_name'] = Auth::user()->name;
                $order['shipping_cost'] = $request['shipping_cost'];
                $order['packing_cost'] = $request['packing_cost'];
                $order['shipping_title'] = $request['shipping_title'];
                $order['packing_title'] = $request['packing_title'];
                $order['tax'] = $request['tax'];
                $order['customer_phone'] = Auth::user()->phone;
                $order['order_number'] = str_random(4).time().$vendor_id;
                $order['customer_address'] = Auth::user()->address;
                $order['customer_country'] = Auth::user()->country;
                $order['customer_city'] = Auth::user()->city;
                $order['customer_zip'] = Auth::user()->zip;
                $order['shipping_email'] = $request['shipping_email'];
                $order['shipping_name'] = $request['shipping_name'];
                $order['shipping_phone'] = $request['shipping_phone'];
                $order['shipping_address'] = $request['shipping_address'];
                // $order['shipping_country'] = $request['shipping_country'];
                $order['shipping_city'] = $request['shipping_city'];
                $order['shipping_zip'] = $request['shipping_zip'];
                // $order['order_note'] = $request['order_notes'];
                $order['coupon_code'] = $request['coupon_code'];
                $order['coupon_discount'] = $request['coupon_discount'];
                $order['dp'] = $request['dp'];
                $order['payment_status'] = "Completed";
                $order['currency_sign'] = $curr->sign;
                $order['currency_value'] = $curr->value;
                $order['vendor_shipping_id'] = $request['vendor_shipping_id'];
                $order['vendor_packing_id'] = $request['vendor_packing_id'];
                $wallet_price = round(Session::get('every_shop_total_price')[$vendor_id] / $curr->value, 2);
                $order['wallet_price'] = $wallet_price + Session::get('store_delivery_fees')[$vendor_id]['delivery_fee'] * Session::get('store_delivery_coupons')[$vendor_id]['delivery_coupon'] / 100;         
                $order['vendor_id'] = $vendor_id;
                $order['message'] = Session::get('message_'.$vendor_id);
                $order['delivery_cost'] = Session::get('store_delivery_fees')[$vendor_id]['delivery_fee'] * Session::get('store_delivery_coupons')[$vendor_id]['delivery_coupon'] / 100;
                if($order['dp'] == 1)
                {
                    $order['status'] = 'completed';
                    $val = ($request['total'] + $wallet_price) / $curr->value;            
                }
                $order->save();
                $order_infos[$vendor_id]['order_number'] = $order->order_number;

                if($order->dp==1) Affiliate::setCashback($order->user_id, $order);
                
                // if(Auth::check()){
                //     Auth::user()->update(['balance' => (Auth::user()->balance - $order->wallet_price)]);
                // }
        
                $track = new OrderTrack;
                $track->title = 'Pending';
                $track->text = 'You have successfully placed your order.';
                $track->order_id = $order->id;
                $track->save();
        
                $notification = new Notification;
                $notification->order_id = $order->id;
                $notification->save();
                            if($request['coupon_id'] != "")
                            {
                            $coupon = Coupon::findOrFail($request['coupon_id']);
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
                $n = 0;
                $delivery_cost = Session::get('store_delivery_fees')[$vendor_id]['delivery_fee'] * Session::get('store_delivery_coupons')[$vendor_id]['delivery_coupon'] / 100;
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
                        $vorder->message = Session::get('message_'.$prod['item']['user_id']);
                        $vorder->order_number = $order->order_number;
                        if($n==0) $vorder->delivery_fee = $delivery_cost;
                        $n++;
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
        
                Session::put('temporder',$order);
                Session::put('tempcart',$cart);
        
                // Session::forget('cart');
        
                    Session::forget('already');
                    Session::forget('coupon');
                    Session::forget('coupon_total');
                    Session::forget('coupon_total1');
                    Session::forget('coupon_percentage');
        
        
                    if ($order->user_id != 0 && $order->wallet_price != 0) {
                        $transaction = new \App\Models\Transaction;
                        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
                        $transaction->user_id = $order->user_id;
                        $transaction->amount = $order->wallet_price;
                        $transaction->currency_sign = $order->currency_sign;
                        $transaction->currency_code = \App\Models\Currency::where('sign',$order->currency_sign)->first()->name;
                        $transaction->currency_value= $order->currency_value;
                        $transaction->details = 'Payment Via Prime';
                        $transaction->type = 'minus';
                        $transaction->save();
                    }
        
                //Sending Email To Buyer
        
                if($gs->is_smtp == 1)
                {
                $data = [
                    // 'to' => $request['email'],
                    'type' => "new_order",
                    // 'cname' => $request['name'],
                    'oamount' => "",
                    'aname' => "",
                    'aemail' => "",
                    'wtitle' => "",
                    'onumber' => $order->order_number,
                ];
        
                $mailer = new GeniusMailer();
                // $mailer->sendAutoOrderMail($data,$order->id);            
                }
                else
                {
                // $to = $request['email'];
                $subject = "Your Order Placed!!";
                $msg = "Hello ".$request['name']."!\nYou have placed a new order.\nYour order number is ".$order->order_number.".Please wait for your delivery. \nThank you.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    // mail($to,$subject,$msg,$headers);   // Liyin         
                }
                //Sending Email To Admin
                if($gs->is_smtp == 1)
                {
                    $data = [
                        'to' => Pagesetting::find(1)->contact_email,
                        'subject' => "New Order Recieved!!",
                        'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is ".$order->order_number.".Please login to your panel to check. <br>Thank you.",
                    ];
        
                    $mailer = new GeniusMailer();
                    // $mailer->sendCustomMail($data);            
                }
                else
                {
                $to = Pagesetting::find(1)->contact_email;
                $subject = "New Order Recieved!!";
                $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is ".$order->order_number.".Please login to your panel to check. \nThank you.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    // mail($to,$subject,$msg,$headers); // Liyin
                }
            }
            Session::put('order_infos', $order_infos);

            return redirect($success_url);
        }
    }

    public function prime(Request $request)
    {
        Session::put('request', $request->all());
        $amount = $request->amount;
        $client = new \GuzzleHttp\Client();

        $data = [
            'api_key' => 'pzU3nyS1T0jyd9tdywZHHXhk5PbQMy3GD8XG9eKiOXFcZAobEB2vImgENvnyRfafTW9S9fPVsuW6v958',
            'amount' => $amount,
            'currency_code' => 'MYR',
            'merchant_id' => '6061851360',
            'redirect_url' => route('front.primepay'),
            'callback_url' => route('front.primepay.callback'),
            'description' => 'Please pay by prime',
        ];
    
        ksort($data);
    
        $str = hash('sha256', implode('|', $data));
    
        $response = $client->request('POST', 'https://pamm.network/api/v1/integration/merchant/init', [
            'form_params' => [
                'api_key' => 'pzU3nyS1T0jyd9tdywZHHXhk5PbQMy3GD8XG9eKiOXFcZAobEB2vImgENvnyRfafTW9S9fPVsuW6v958',
                'amount' => $amount,
                'currency_code' => 'MYR',
                'redirect_url' => route('front.primepay'),
                'callback_url' => route('front.primepay.callback'),
                'description' => 'Please pay by prime',
                'merchant_id' => '6061851360',
                'signature' => $str,
            ],
            'verify' => false,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    
        $body = json_decode($response->getBody()->getContents());
    
        $paymentUrl = $body->payment_url;
    
       // redirect or return to view page and direct afterwards
        return ['paymentUrl' => $paymentUrl];
    }
    
    public function primePayCallback(Request $request)
    {
        $status = $request->status;
        if ($status != 1) {
            return redirect(route('front.checkout'));
        } else {
            $request = Session::get('request');

            if (!Session::has('cart')) {
                return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
            }
            if (Session::has('currency')) {
                $curr = Currency::find(Session::get('currency'));
            } else {
                $curr = Currency::where('is_default','=',1)->first();
            }

            $gs = Generalsetting::findOrFail(1);

            $order_infos = array();
            $final_results = Session::get('final_results');
            foreach (Session::get("final_results") as $vendor_id => $products) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);

                //remain products according to every vendor
                foreach ($final_results as $store_id => $products) {
                    if($store_id != $vendor_id) {
                        $remove_pids = array();
                        foreach ($products as $product) {
                            $remove_pids[] = $product['item']['id'];
                        }
                        foreach ($remove_pids as $remove_pid) {
                            $cart->removeItem($remove_pid);
                        }
                    }
                }

                foreach($cart->items as $key => $prod)
                {
                    if(!empty($prod['item']['license']) && !empty($prod['item']['license_qty']))
                    {
                        foreach($prod['item']['license_qty'] as $ttl => $dtl)
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

                // get product quantity according to every shop
                $every_shop_qty = 0;
                foreach ($products as $product) {
                    $every_shop_qty += $product['qty'];
                }
                
                $order = new Order;
                // $order['customer_state'] = $request['state'];
                $order['shipping_state'] = $request['shipping_state'];
                $success_url = action('Front\PaymentController@payreturn');
                $item_name = $gs->title." Order";
                $item_number = str_random(4).time().$vendor_id;
                $order['user_id'] = Auth::user()->id;
                $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9)); 
                // $order['totalQty'] = $request->totalQty;
                $order['totalQty'] = $every_shop_qty;                          
                $order['pay_amount'] = 0;      //------------------------- ?
                $order['method'] = 'Prime';
                // $order['shipping'] = $request['shipping'];
                // $order['pickup_location'] = $request['pickup_location'];
                $order['customer_email'] = Auth::user()->email;
                $order['customer_name'] = Auth::user()->name;
                $order['shipping_cost'] = $request['shipping_cost'];
                $order['packing_cost'] = $request['packing_cost'];
                $order['shipping_title'] = $request['shipping_title'];
                $order['packing_title'] = $request['packing_title'];
                $order['tax'] = $request['tax'];
                $order['customer_phone'] = Auth::user()->phone;
                $order['order_number'] = str_random(4).time().$vendor_id;
                $order['customer_address'] = Auth::user()->address;
                $order['customer_country'] = Auth::user()->country;
                $order['customer_city'] = Auth::user()->city;
                $order['customer_zip'] = Auth::user()->zip;
                $order['shipping_email'] = $request['shipping_email'];
                $order['shipping_name'] = $request['shipping_name'];
                $order['shipping_phone'] = $request['shipping_phone'];
                $order['shipping_address'] = $request['shipping_address'];
                // $order['shipping_country'] = $request['shipping_country'];
                $order['shipping_city'] = $request['shipping_city'];
                $order['shipping_zip'] = $request['shipping_zip'];
                // $order['order_note'] = $request['order_notes'];
                $order['coupon_code'] = $request['coupon_code'];
                $order['coupon_discount'] = $request['coupon_discount'];
                $order['dp'] = $request['dp'];
                $order['payment_status'] = "Completed";
                $order['currency_sign'] = $curr->sign;
                $order['currency_value'] = $curr->value;
                $order['vendor_shipping_id'] = $request['vendor_shipping_id'];
                $order['vendor_packing_id'] = $request['vendor_packing_id'];
                $wallet_price = round(Session::get('every_shop_total_price')[$vendor_id] / $curr->value, 2);
                $order['wallet_price'] = $wallet_price + Session::get('store_delivery_fees')[$vendor_id]['delivery_fee'] * Session::get('store_delivery_coupons')[$vendor_id]['delivery_coupon'] / 100;         
                $order['vendor_id'] = $vendor_id;
                $order['message'] = Session::get('message_'.$vendor_id);
                $order['delivery_cost'] = Session::get('store_delivery_fees')[$vendor_id]['delivery_fee'] * Session::get('store_delivery_coupons')[$vendor_id]['delivery_coupon'] / 100;
                if($order['dp'] == 1)
                {
                    $order['status'] = 'completed';
                    $val = ($request['total'] + $wallet_price) / $curr->value;            
                }
                $order->save();
                $order_infos[$vendor_id]['order_number'] = $order->order_number;

                if($order->dp==1) Affiliate::setCashback($order->user_id, $order);
                
                // if(Auth::check()){
                //     Auth::user()->update(['balance' => (Auth::user()->balance - $order->wallet_price)]);
                // }
        
                $track = new OrderTrack;
                $track->title = 'Pending';
                $track->text = 'You have successfully placed your order.';
                $track->order_id = $order->id;
                $track->save();
        
                $notification = new Notification;
                $notification->order_id = $order->id;
                $notification->save();
                            if($request['coupon_id'] != "")
                            {
                            $coupon = Coupon::findOrFail($request['coupon_id']);
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
                $n = 0;
                $delivery_cost = Session::get('store_delivery_fees')[$vendor_id]['delivery_fee'] * Session::get('store_delivery_coupons')[$vendor_id]['delivery_coupon'] / 100;
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
                        $vorder->message = Session::get('message_'.$prod['item']['user_id']);
                        $vorder->order_number = $order->order_number;
                        if($n==0) $vorder->delivery_fee = $delivery_cost;
                        $n++;
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
        
                Session::put('temporder',$order);
                Session::put('tempcart',$cart);
        
                // Session::forget('cart');
        
                    Session::forget('already');
                    Session::forget('coupon');
                    Session::forget('coupon_total');
                    Session::forget('coupon_total1');
                    Session::forget('coupon_percentage');
        
        
                    if ($order->user_id != 0 && $order->wallet_price != 0) {
                        $transaction = new \App\Models\Transaction;
                        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
                        $transaction->user_id = $order->user_id;
                        $transaction->amount = $order->wallet_price;
                        $transaction->currency_sign = $order->currency_sign;
                        $transaction->currency_code = \App\Models\Currency::where('sign',$order->currency_sign)->first()->name;
                        $transaction->currency_value= $order->currency_value;
                        $transaction->details = 'Payment Via Prime';
                        $transaction->type = 'minus';
                        $transaction->save();
                    }
        
                //Sending Email To Buyer
        
                if($gs->is_smtp == 1)
                {
                $data = [
                    // 'to' => $request['email'],
                    'type' => "new_order",
                    // 'cname' => $request['name'],
                    'oamount' => "",
                    'aname' => "",
                    'aemail' => "",
                    'wtitle' => "",
                    'onumber' => $order->order_number,
                ];
        
                $mailer = new GeniusMailer();
                // $mailer->sendAutoOrderMail($data,$order->id);            
                }
                else
                {
                // $to = $request['email'];
                $subject = "Your Order Placed!!";
                $msg = "Hello ".$request['name']."!\nYou have placed a new order.\nYour order number is ".$order->order_number.".Please wait for your delivery. \nThank you.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    // mail($to,$subject,$msg,$headers);   // Liyin         
                }
                //Sending Email To Admin
                if($gs->is_smtp == 1)
                {
                    $data = [
                        'to' => Pagesetting::find(1)->contact_email,
                        'subject' => "New Order Recieved!!",
                        'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is ".$order->order_number.".Please login to your panel to check. <br>Thank you.",
                    ];
        
                    $mailer = new GeniusMailer();
                    // $mailer->sendCustomMail($data);            
                }
                else
                {
                $to = Pagesetting::find(1)->contact_email;
                $subject = "New Order Recieved!!";
                $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is ".$order->order_number.".Please login to your panel to check. \nThank you.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    // mail($to,$subject,$msg,$headers); // Liyin
                }
            }
            Session::put('order_infos', $order_infos);

            return redirect($success_url);
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
