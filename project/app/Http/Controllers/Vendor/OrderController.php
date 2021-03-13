<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use App\Models\VendorOrder;
use App\Models\NewNotification;
use App\Models\Product;
use App\Models\VendorAmount;
use App\Models\Currency;
use App\Models\Transaction;
use App\Classes\Affiliate;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $orders = VendorOrder::where('user_id','=',$user->id)->orderBy('id','desc')->get()->groupBy('order_number');
        return view('vendor.order.index',compact('user','orders'));
    }
    
    public function pending()
    {
        $user = Auth::user();
        $orders = VendorOrder::where('user_id','=',$user->id)->where('status','=','pending')->orderBy('id','desc')->get()->groupBy('order_number');
        return view('vendor.order.pending',compact('user','orders'));
    }


    public function show($slug)
    {
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('vendor.order.details',compact('user','order','cart'));
    }

    public function license(Request $request, $slug)
    {
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $cart->items[$request->license_key]['license'] = $request->license;
        $order->cart = utf8_encode(bzcompress(serialize($cart), 9));
        $order->update();         
        $msg = 'Successfully Changed The License Key.';
        return response()->json($msg);
    }

    public function invoice($slug)
    {
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $delivery_fee = VendorOrder::where('order_number','=',$slug)->where('user_id','=',$user->id)->sum('delivery_fee');
        return view('vendor.order.invoice',compact('user','order','cart', 'delivery_fee'));
    }

    public function printpage($slug)
    {
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('vendor.order.print',compact('user','order','cart'));
    }

    public function status($slug,$status, Request $request)
    {
        $mainorder = VendorOrder::where('order_number','=',$slug)->first();
        if ($mainorder->status == "completed"){
            return redirect()->back()->with('success','This Order is Already Completed');
        }else{
            $user = Auth::user();
            VendorOrder::where('order_number','=',$slug)->where('user_id','=',$user->id)->update(['status' => $status]);
            $order = Order::where('order_number','=',$slug)->first();            
            if($order->status != 'completed' && $status == 'completed') {
                $order->update(['status' => $status]); // Liyin   
                $cash_amount = Affiliate::setCashback($order->user_id, $order);
                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));            
                foreach($cart->items as $product) {
                    $p = Product::findOrFail($product['item']['id']);
                    if(!$p) continue;
                    $a = round($product['item']['price'] * $order->currency_value,2);
                    VendorAmount::saveAmount($order->user_id, $p->user_id, $a);
                }
                $order_amount = $order->payment_amount+$order->wallet_price - $cash_amount;
                $user->balance += $order_amount;
                $user->update();
                $this->newTransaction($user->id, $order_amount, $order->id, $order->order_number);
            }
            $order->update(['status' => $status]); // Liyin            
            $notif = new NewNotification();
            $notif->setOrderNotification($order);
            $pending = $request->pending;
            if(!isset($pending))$pending = 0;
            if($pending)
                return redirect()->route('vendor-order-pending')->with('success','Order Status Updated Successfully');
            else
                return redirect()->route('vendor-order-index')->with('success','Order Status Updated Successfully');
        }
    }

    private function newTransaction($user_id, $amount, $order_id, $order_number) {        
        $sign = Currency::where('is_default','=',1)->first();
        $transaction = new Transaction;
        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
        $transaction->amount = $amount;
        $transaction->user_id = $user_id;
        $transaction->currency_sign = $sign->sign;
        $transaction->currency_code = $sign->name;
        $transaction->currency_value = $sign->value;
        $transaction->method = 'order';
        $transaction->txnid = null;
        $transaction->details = 'Credit by Order <a href="'.route('vendor-order-show', $order_number).'"><b>'.$order_number.'</b></a>';
        $transaction->type = 'plus';
        $transaction->save();
    }

}
