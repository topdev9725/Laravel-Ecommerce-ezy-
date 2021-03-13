<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Coupon;
use App\Models\Generalsetting;
use Session;
use Auth;

class CartController extends Controller
{

    public function cart()
    {
        $this->code_image();
        if (!Session::has('cart')) {
            return view('front.cart');
        }
        if (Session::has('already')) {
            Session::forget('already');
        }
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        if (Session::has('coupon_total')) {
            Session::forget('coupon_total');
        }
        if (Session::has('coupon_total1')) {
            Session::forget('coupon_total1');
        }
        if (Session::has('coupon_percentage')) {
            Session::forget('coupon_percentage');
        }
        $gs = Generalsetting::findOrFail(1);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;
        $totalPrice = $cart->totalPrice;
        $mainTotal = $totalPrice;
        $tx = $gs->tax;
        if($tx != 0)
        {
            $tax = ($totalPrice / 100) * $tx;
            $mainTotal = $totalPrice + $tax;
        }

        $final_results = array();
        foreach ($products as $product) {
            $vendor_id = $product['item']['user_id'];
            $final_results[$vendor_id][] = $product;
            Session::put('message_'.$vendor_id, '');
        }

        $every_shop_total_price = array();
        foreach ($final_results as $key => $result) {
            $price = 0;
            foreach ($result as $item) {
                $price += $item['price'];
            }
            $every_shop_total_price[$key] = $price;
        }  
        
        Session::put('every_shop_total_price', $every_shop_total_price);
        Session::put('final_results', $final_results);

        return view('front.cart', compact('totalPrice','mainTotal','tx')); 
    }

    public function cartview()
    {
        return view('load.cart'); 
    }

   public function addtocart($id)
    {
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes']);

        // Set Attrubutes

        $keys = '';
        $values = '';
        if(!empty($prod->license_qty))
        {
        $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl)
            {
                if($dtl < 1)
                {
                    $lcheck = 0;
                }
                else
                {
                    $lcheck = 1;
                    break;
                }                    
            }
                if($lcheck == 0)
                {
                    return 0;            
                }
        }


        // Set Size

        $size = '';
        if(!empty($prod->size))
        { 
        $size = trim($prod->size[0]);
        }  
        $size = str_replace(' ','-',$size);

        // Set Color

        $color = '';
        if(!empty($prod->color))
        { 
        $color = $prod->color[0];
        $color = str_replace('#','',$color);
        }  


        if($prod->user_id != 0){
        $gs = Generalsetting::findOrFail(1);
        $prc = $prod->price + $gs->fixed_commission + ($prod->price/100) * $gs->percentage_commission ;
        $prod->price = round($prc,2);
        }

        // Set Attribute


            if (!empty($prod->attributes))
            {
                $attrArr = json_decode($prod->attributes, true);

                $count = count($attrArr);
                $i = 0;
                $j = 0; 
                      if (!empty($attrArr))
                      {
                          foreach ($attrArr as $attrKey => $attrVal)
                          {

                            if (is_array($attrVal) && array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1) {
                                if($j == $count - 1){
                                    $keys .= $attrKey;
                                }else{
                                    $keys .= $attrKey.',';
                                }
                                $j++;

                                foreach($attrVal['values'] as $optionKey => $optionVal)
                                {
                                    
                                    $values .= $optionVal . ',';

                                    $prod->price += $attrVal['prices'][$optionKey];
                                    break;
                                     
                                    
                                }

                            }
                          }

                      }

                }
                $keys = rtrim($keys, ',');
                $values = rtrim($values, ',');



        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($prod, $prod->id, $size ,$color, $keys, $values);
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['dp'] == 1)
        {
            return redirect()->route('front.cart');
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['stock'] < 0)
        {
            return redirect()->route('front.cart');
        }
        if(!empty($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty']))
        {
            if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] > $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
            {
                return redirect()->route('front.cart');
            }           
        }

        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];
        Session::put('cart',$cart);
         return redirect()->route('front.cart');
    }  

   public function addcart($id)
    {
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes']);

        // Set Attrubutes

        $keys = '';
        $values = '';
        if(!empty($prod->license_qty))
        {
        $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl)
            {
                if($dtl < 1)
                {
                    $lcheck = 0;
                }
                else
                {
                    $lcheck = 1;
                    break;
                }                    
            }
                if($lcheck == 0)
                {
                    return 0;            
                }
        }

        // Set Size

        $size = '';
        if(!empty($prod->size))
        { 
        $size = trim($prod->size[0]);
        }  
        $size = str_replace(' ','-',$size);

        // Set Color

        $color = '';
        if(!empty($prod->color))
        { 
        $color = $prod->color[0];
        $color = str_replace('#','',$color);
        }  

        // Vendor Comission

        if($prod->user_id != 0){
        $gs = Generalsetting::findOrFail(1);
        $prc = $prod->price + $gs->fixed_commission + ($prod->price/100) * $gs->percentage_commission;
        $prod->price = round($prc,2);
        }


        // Set Attribute


            if (!empty($prod->attributes))
            {
                $attrArr = json_decode($prod->attributes, true);

                $count = count($attrArr);
                $i = 0;
                $j = 0; 
                      if (!empty($attrArr))
                      {
                          foreach ($attrArr as $attrKey => $attrVal)
                          {

                            if (is_array($attrVal) && array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1) {
                                if($j == $count - 1){
                                    $keys .= $attrKey;
                                }else{
                                    $keys .= $attrKey.',';
                                }
                                $j++;

                                foreach($attrVal['values'] as $optionKey => $optionVal)
                                {
                                    
                                    $values .= $optionVal . ',';
                                    $prod->price += $attrVal['prices'][$optionKey];
                                    break;
                                }

                            }
                          }

                      }

                }
                $keys = rtrim($keys, ',');
                $values = rtrim($values, ',');





        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($prod, $prod->id,$size,$color,$keys,$values);
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['dp'] == 1)
        {
            return 'digital';
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['stock'] < 0)
        {
            return 0;
        }
        if(!empty($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty']))
        {
            if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] > $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
            {
                return 0;
            }           
        }
        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];
        Session::put('cart',$cart);
        $data[0] = count($cart->items);        
        return response()->json($data);           
    }  

    public function addnumcart()
    {
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $size = str_replace(' ','-',$_GET['size']);
        $color = $_GET['color'];
        $size_qty = $_GET['size_qty'];
        $size_price = (double)$_GET['size_price'];
        $size_key = $_GET['size_key'];
        $keys =  $_GET['keys'];
        $values = $_GET['values'];
        $prices = $_GET['prices'];
        $keys = $keys == "" ? '' :implode(',',$keys);
        $values = $values == "" ? '' : implode(',',$values );
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        }
        else {
            $curr = Currency::where('is_default','=',1)->first();
        }


        $size_price = ($size_price / $curr->value);
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes']);


        if($prod->user_id != 0){
        $gs = Generalsetting::findOrFail(1);
        $prc = $prod->price + $gs->fixed_commission + ($prod->price/100) * $gs->percentage_commission ;
        $prod->price = round($prc,2);
        }
        if(!empty($prices))
        {
         foreach($prices as $data){
            $prod->price += ($data / $curr->value);
        }
            
        }


        if(!empty($prod->license_qty))
        {
        $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl)
            {
                if($dtl < 1)
                {
                    $lcheck = 0;
                }
                else
                {
                    $lcheck = 1;
                    break;
                }                    
            }
                if($lcheck == 0)
                {
                    return 0;            
                }
        }
        if(empty($size))
        {
            if(!empty($prod->size))
            { 
            $size = trim($prod->size[0]);
            }   
            $size = str_replace(' ','-',$size);       
        }
 
        if(empty($color))
        {
            if(!empty($prod->color))
            { 
            $color = $prod->color[0];
                    
            }          
        }
        $color = str_replace('#','',$color);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addnum($prod, $prod->id, $qty, $size,$color,$size_qty,$size_price,$size_key,$keys,$values);
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['dp'] == 1)
        {
            return 'digital';
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['stock'] < 0)
        {
            return 0;
        }
        if(!empty($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty']))
        {
            if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] > $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
            {
                return 0;
            }           
        }

        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];        
        Session::put('cart',$cart);
        $data[0] = count($cart->items);   
        return response()->json($data);        
    }  


    public function addtonumcart()
    {
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $size = str_replace(' ','-',$_GET['size']);
        $color = $_GET['color'];
        $size_qty = $_GET['size_qty'];
        $size_price = (double)$_GET['size_price'];
        $size_key = $_GET['size_key'];
        $keys =  $_GET['keys'];
        $keys = explode(",",$keys);
        $values = $_GET['values'];
        $values = explode(",",$values);
        $prices = $_GET['prices'];
        if(!empty($prices)){
            $prices = explode(",",$prices);
        }

        $keys = $keys == "" ? '' :implode(',',$keys);

        $values = $values == "" ? '' : implode(',',$values );
        if (Session::has('currency')) {
            $curr = Currency::find(Session::get('currency'));
        }
        else {
            $curr = Currency::where('is_default','=',1)->first();
        }


        $size_price = ($size_price / $curr->value);
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes']);


        if($prod->user_id != 0){
        $gs = Generalsetting::findOrFail(1);
        $prc = $prod->price + $gs->fixed_commission + ($prod->price/100) * $gs->percentage_commission ;
        $prod->price = round($prc,2);
        }
        
        if(!empty($prices)){
            if(!empty($prices[0])){
                foreach($prices as $data){
                    $prod->price += ($data / $curr->value);
                }
            }
        }


        if(!empty($prod->license_qty))
        {
        $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl)
            {
                if($dtl < 1)
                {
                    $lcheck = 0;
                }
                else
                {
                    $lcheck = 1;
                    break;
                }                    
            }
                if($lcheck == 0)
                {
                    return 0;            
                }
        }
        if(empty($size))
        {
            if(!empty($prod->size))
            { 
            $size = trim($prod->size[0]);
            }          
            $size = str_replace(' ','-',$size);
        }
 
        if(empty($color))
        {
            if(!empty($prod->color))
            { 
            $color = $prod->color[0];
                    
            }          
        }
        $color = str_replace('#','',$color);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addnum($prod, $prod->id, $qty, $size,$color,$size_qty,$size_price,$size_key,$keys,$values);
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['dp'] == 1)
        {
            return 'digital';
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['stock'] < 0)
        {
            return 0;
        }
        if(!empty($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty']))
        {
            if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] > $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
            {
                return 0;
            }           
        }

        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];        
        Session::put('cart',$cart);
        return redirect()->route('front.cart');      
    }  


    public function addbyone()
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) 
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $id = $_GET['id'];
        $itemid = $_GET['itemid'];
        $size_qty = $_GET['size_qty'];
        $size_price = $_GET['size_price'];
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes']);

        if($prod->user_id != 0){
        $gs = Generalsetting::findOrFail(1);
        $prc = $prod->price + $gs->fixed_commission + ($prod->price/100) * $gs->percentage_commission ;
        $prod->price = round($prc,2);
        }

            if (!empty($prod->attributes))
            {
                $attrArr = json_decode($prod->attributes, true);
                $count = count($attrArr);
                $j = 0; 
                      if (!empty($attrArr))
                      {
                          foreach ($attrArr as $attrKey => $attrVal)
                          {

                            if (is_array($attrVal) && array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1) {

                                foreach($attrVal['values'] as $optionKey => $optionVal)
                                {
                                    $prod->price += $attrVal['prices'][$optionKey];
                                    break;
                                }

                            }
                          }

                      }

                }



        if(!empty($prod->license_qty))
        {
        $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl)
            {
                if($dtl < 1)
                {
                    $lcheck = 0;
                }
                else
                {
                    $lcheck = 1;
                    break;
                }                    
            }
                if($lcheck == 0)
                {
                    return 0;            
                }
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->adding($prod, $itemid,$size_qty,$size_price);
        if($cart->items[$itemid]['stock'] < 0)
        {
            return 0;
        }
        if(!empty($size_qty))
        {
            if($cart->items[$itemid]['qty'] > $cart->items[$itemid]['size_qty'])
            {
                return 0;
            }            
        }
        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];        
        Session::put('cart',$cart);
        $data[0] = $cart->totalPrice;

        //-----------------------------------------------
        $final_results = array();
        foreach (Session::get('cart')->items as $product) {
            $vender_id = $product['item']['user_id'];
            $final_results[$vender_id][] = $product;
        }

        $every_shop_total_price = array();
        foreach ($final_results as $key => $result) {
            $price = 0;
            foreach ($result as $item) {
                $price += $item['price'];
            }
            $every_shop_total_price[$key] = $price;
        }  
        Session::put('final_results', $final_results);
        //------------------------------------------------

        $data[3] = $data[0];
        $tx = $gs->tax;
        if($tx != 0)
        {
            $tax = ($data[0] / 100) * $tx;
            $data[3] = $data[0] + $tax;
        }  

        $data[1] = $cart->items[$itemid]['qty']; 
        $data[2] = $cart->items[$itemid]['price'];
        $data[0] = round($data[0] * $curr->value,2);
        $data[2] = round($data[2] * $curr->value,2);
        $data[3] = round($data[3] * $curr->value,2);
        $data['every_shop_total_price'] = $every_shop_total_price;
        Session::put('every_shop_total_price', $every_shop_total_price);
        if($gs->currency_format == 0){
            $data[0] = $data[0];
            $data[2] = $data[2];
            $data[3] = $data[3];
        }
        else{
            $data[0] = $data[0];
            $data[2] = $data[2];
            $data[3] = $data[3];
        }     
        return response()->json($data);          
    }  

    public function reducebyone()
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) 
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $id = $_GET['id'];
        $itemid = $_GET['itemid'];
        $size_qty = $_GET['size_qty'];
        $size_price = $_GET['size_price'];
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes']);
        if($prod->user_id != 0){
        $gs = Generalsetting::findOrFail(1);
        $prc = $prod->price + $gs->fixed_commission + ($prod->price/100) * $gs->percentage_commission ;
        $prod->price = round($prc,2);
        }

        
            if (!empty($prod->attributes))
            {
                $attrArr = json_decode($prod->attributes, true);
                $count = count($attrArr);
                $j = 0; 
                      if (!empty($attrArr))
                      {
                          foreach ($attrArr as $attrKey => $attrVal)
                          {

                            if (is_array($attrVal) && array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1) {

                                foreach($attrVal['values'] as $optionKey => $optionVal)
                                {
                                    $prod->price += $attrVal['prices'][$optionKey];
                                    break;
                                }

                            }
                          }

                      }

                }

        
        if(!empty($prod->license_qty))
        {
        $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl)
            {
                if($dtl < 1)
                {
                    $lcheck = 0;
                }
                else
                {
                    $lcheck = 1;
                    break;
                }                    
            }
                if($lcheck == 0)
                {
                    return 0;            
                }
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reducing($prod, $itemid,$size_qty,$size_price);
        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];    
        
        Session::put('cart',$cart);
        $data[0] = $cart->totalPrice;

        //-----------------------------------------------
        $final_results = array();
        foreach (Session::get('cart')->items as $product) {
            $vender_id = $product['item']['user_id'];
            $final_results[$vender_id][] = $product;
        }

        $every_shop_total_price = array();
        foreach ($final_results as $key => $result) {
            $price = 0;
            foreach ($result as $item) {
                $price += $item['price'];
            }
            $every_shop_total_price[$key] = $price;
        }  
        Session::put('final_results', $final_results);
        //------------------------------------------------

        $data[3] = $data[0];
        $tx = $gs->tax;
        if($tx != 0)
        {
            $tax = ($data[0] / 100) * $tx;
            $data[3] = $data[0] + $tax;
        }  

        $data[1] = $cart->items[$itemid]['qty']; 
        $data[2] = $cart->items[$itemid]['price'];
        $data[0] = round($data[0] * $curr->value,2);
        $data[2] = round($data[2] * $curr->value,2);
        $data[3] = round($data[3] * $curr->value,2);
        $data['every_shop_total_price'] = $every_shop_total_price;
        Session::put('every_shop_total_price', $every_shop_total_price);
        if($gs->currency_format == 0){
            $data[0] = $data[0];
            $data[2] = $data[2];
            $data[3] = $data[3];
        }
        else{
            $data[0] = $data[0];
            $data[2] = $data[2];
            $data[3] = $data[3];
        }       
        return response()->json($data);        
    } 

    public function upcolor()
    {
         $id = $_GET['id'];
         $color = $_GET['color'];
        $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes']);
         $oldCart = Session::has('cart') ? Session::get('cart') : null;
         $cart = new Cart($oldCart);
         $cart->updateColor($prod,$id,$color);  
         Session::put('cart',$cart);
    } 


    public function removecart($id)
    {
        $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) 
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
            
                //-----------------------------------------------
                $final_results = array();
                foreach (Session::get('cart')->items as $product) {
                    $vender_id = $product['item']['user_id'];
                    $final_results[$vender_id][] = $product;
                }

                $every_shop_total_price = array();
                foreach ($final_results as $key => $result) {
                    $price = 0;
                    foreach ($result as $item) {
                        $price += $item['price'];
                    }
                    $every_shop_total_price[$key] = $price;
                }  
                $data['every_shop_total_price'] = $every_shop_total_price;
                Session::put('every_shop_total_price', $every_shop_total_price);

                Session::put('final_results', $final_results);
                //------------------------------------------------
                
                $data[0] = $cart->totalPrice;
                $data[3] = $data[0];
                    $tx = $gs->tax;
                    if($tx != 0)
                    {
                        $tax = ($data[0] / 100) * $tx;
                        $data[3] = $data[0] + $tax;
                    } 

                if($gs->currency_format == 0){
                    $data[0] = round($data[0] * $curr->value,2);
                    $data[3] = round($data[3] * $curr->value,2);
            
                }
                else{
                    $data[0] = round($data[0] * $curr->value,2);
                    $data[3] = round($data[3] * $curr->value,2);
                }
            
            $data[1] = count($cart->items); 
            return response()->json($data);  
        } else {
            Session::forget('cart');
            //-----------------
            Session::forget('final_results');
            Session::forget('vendor_id');
            Session::forget('every_shop_total_price');
            Session::forget('new_final_results_check');
            //-------------------
            Session::forget('already');
            Session::forget('coupon');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('coupon_percentage');

            $data = 0;
            return response()->json($data); 
        }          
    } 

    public function coupon()
    {
        $gs = Generalsetting::findOrFail(1);
        $code = $_GET['code'];
        $total = (float)preg_replace('/[^0-9\.]/ui','',$_GET['total']);;
        $fnd = Coupon::where('code','=',$code)->get()->count();
        if($fnd < 1)
        {
        return response()->json(0);              
        }
        else{
        $coupon = Coupon::where('code','=',$code)->first();
            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }
        if($coupon->times != null)
        {
            if($coupon->times == "0")
            {
                return response()->json(0);                
            }
        }
        $today = date('Y-m-d');
        $from = date('Y-m-d',strtotime($coupon->start_date));
        $to = date('Y-m-d',strtotime($coupon->end_date));
        if($from <= $today && $to >= $today)
        {
            if($coupon->status == 1)
            {
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $val = Session::has('already') ? Session::get('already') : null;
                if($val == $code)
                {
                    return response()->json(2); 
                }
                $cart = new Cart($oldCart);
                if($coupon->type == 0)
                {
                    Session::put('already', $code);
                    $coupon->price = (int)$coupon->price;
                    $val = $total / 100;
                    $sub = $val * $coupon->price;
                    $total = $total - $sub;
                    $data[0] = round($total,2);
                    if($gs->currency_format == 0){
                        $data[0] = $curr->sign.$data[0];
                    }
                    else{
                        $data[0] = $data[0].$curr->sign;
                    }
                    $data[1] = $code;      
                    $data[2] = round($sub, 2);
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                    Session::put('coupon_total', $data[0]);
                    $data[3] = $coupon->id;
                    $data[4] = $coupon->price."%";
                    $data[5] = 1;

                    Session::put('coupon_percentage', $data[4]);

                    return response()->json($data);   
                }
                else{
                    Session::put('already', $code);
                    $total = $total - round($coupon->price * $curr->value, 2);
                    $data[0] = round($total,2);
                    $data[1] = $code;
                    $data[2] = round($coupon->price * $curr->value, 2);
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                    Session::put('coupon_total', $data[0]);
                    $data[3] = $coupon->id;
                if($gs->currency_format == 0){
                    $data[4] = $curr->sign.$data[2];
                    $data[0] = $curr->sign.$data[0];
                }
                else{
                    $data[4] = $data[2].$curr->sign;
                    $data[0] = $data[0].$curr->sign;
                }
                    

                    Session::put('coupon_percentage', 0);

                    $data[5] = 1;
                    return response()->json($data);              
                }
            }
            else{
                    return response()->json(0);   
            }              
        }
        else{
        return response()->json(0);             
        }
        }         
    } 

    public function couponcheck()
    {
        $gs = Generalsetting::findOrFail(1);
        $code = $_GET['code'];
        $total = $_GET['total'];
        $fnd = Coupon::where('code','=',$code)->get()->count();
        if($fnd < 1)
        {
        return response()->json(0);              
        }
        else{
        $coupon = Coupon::where('code','=',$code)->first();
            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }
        if($coupon->times != null)
        {
            if($coupon->times == "0")
            {
                return response()->json(0);                
            }
        }
        $today = date('Y-m-d');
        $from = date('Y-m-d',strtotime($coupon->start_date));
        $to = date('Y-m-d',strtotime($coupon->end_date));
        if($from <= $today && $to >= $today)
        {
            if($coupon->status == 1)
            {
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $val = Session::has('already') ? Session::get('already') : null;
                if($val == $code)
                {
                    return response()->json(2); 
                }
                $cart = new Cart($oldCart);
                if($coupon->type == 0)
                {
                    Session::put('already', $code);
                    $coupon->price = (int)$coupon->price;
                    $oldCart = Session::get('cart');
                    $cart = new Cart($oldCart);
                    $total = $total - $_GET['shipping_cost'];
                    $val = $total / 100;
                    $sub = $val * $coupon->price;
                    $total = $total - $sub;
                    $total = $total + $_GET['shipping_cost'];
                    $data[0] = round($total,2);
                    $data[1] = $code;      
                    $data[2] = round($sub, 2);
                    if($gs->currency_format == 0){
                        $data[0] = $curr->sign.$data[0];
                    }
                    else{
                        $data[0] = $data[0].$curr->sign;
                    }
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                    Session::put('coupon_total1', $data[0]);
                    Session::forget('coupon_total');
                    $data[0] = round($total,2);
                    $data[1] = $code;      
                    $data[2] = round($sub, 2);
                    $data[3] = $coupon->id;
                    $data[4] = $coupon->price."%";
                    $data[5] = 1;
                    Session::put('coupon_percentage', $data[4]);
                    return response()->json($data);   
                }
                else{
                    Session::put('already', $code);
                    $total = $total - round($coupon->price * $curr->value, 2);
                    $data[0] = round($total,2);
                    $data[1] = $code;
                    $data[2] = round($coupon->price * $curr->value, 2);
                    $data[3] = $coupon->id;
                if($gs->currency_format == 0){
                    $data[4] = 0;
                    $data[0] = $curr->sign.$data[0];
                }
                else{
                    $data[4] = 0;
                    $data[0] = $data[0].$curr->sign;
                }
                    Session::put('coupon', $data[2]);
                    Session::put('coupon_code', $code);
                    Session::put('coupon_id', $coupon->id);
                    Session::put('coupon_total1', $data[0]);
                    Session::forget('coupon_total');
                    $data[0] = round($total,2);
                    $data[1] = $code;
                    $data[2] = round($coupon->price * $curr->value, 2);
                    $data[3] = $coupon->id;                  
                    $data[5] = 1;
                    Session::put('coupon_percentage', $data[4]);
                    return response()->json($data);              
                }
            }
            else{
                    return response()->json(0);   
            }              
        }
        else{
        return response()->json(0);             
        }
        }         
    } 
    
    public function walletcheck()
    {
        $wallet_amount = Auth::user()->balance;
        $total = (double)$_GET['total'];
        if($wallet_amount - $total >= 0){
            $data[0] = $total;
            $data[1]  = $wallet_amount;
            return response()->json($data);
        }else {
            return response()->json(0);
        }
    }


    public function walletcheck1()
    {
        $amount = (double)$_GET['code'];
        $total = (double)$_GET['total'];
        if($amount > 0 && $amount <= $total){
            $total -= $amount;
            $data[0] = $total;
            $data[1]  = $amount;
            return response()->json($data);
        }else {
            return response()->json(0);
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
    
    public function savemessage()
    {
        $message = $_GET['message'];
        $vendor_id = $_GET['vendor_id'];
        Session::put('message_'.$vendor_id, $message);
        return ['success' => true];
    }

}
