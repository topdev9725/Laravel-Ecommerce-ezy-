<?php
namespace App\Classes;

use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\Category;
use App\Models\Product;
use App\Models\NewNotification;
use Illuminate\Support\Facades\DB;
use Session;

class Affiliate
{
    public static function setAffiliateUser($email, $affiliate_id) {                
        $user = DB::table('users')->where('email','=',$email)->first();        
        Session::forget('affilate');
        if(!$user || $user->sup_id>0 || $user->is_vendor!=0) return;
        if(User::where('sup_id','=',$user->id)->get()->count()>0) return;
        if($affiliate_id > 0) {
            $affiliate_user = User::findOrFail($affiliate_id);      
            $gs = Generalsetting::findOrFail(1);                 
            if($gs->is_affilate==1 && $affiliate_user->email != $email) {
                if(!self::checkSupId($affiliate_id, $sub_ids)) {                
                    $affiliate_id = self::getSupId($sub_ids);
                }
                User::findOrFail($user->id)->update(['sup_id' => $affiliate_id]);
            }
        } else {
            self::setAffiliateNewUser($user->id);
        }
    }

    private static function checkSupId($sup_id, &$sub_ids) {
        $sub_ids = [];
        $gs = Generalsetting::findOrFail(1); 
        $sub_users = User::where('sup_id', '=', $sup_id)->get();
        if($sub_users) {
            foreach($sub_users as $user) {
                $sub_ids[] = $user->id;
            }
        }
        return ($sub_users->count() < $gs->affiliate_max_layers);
    }

    private static function getSupId($sup_ids) {
        $sub_ids = []; $sup_id = 0;
        foreach($sup_ids as $id) {
            if(self::checkSupId($id, $tmp_ids)) { 
                $sup_id = $id;
                break;
            } 
            $sub_ids = array_merge($sub_ids, $tmp_ids);            
        }   
        if($sup_id == 0) {
            $sup_id = self::getSupId($sub_ids);
        } 
        return $sup_id;
    }

    private static function setAffiliateNewUser($user_id) {
        $gs = Generalsetting::findOrFail(1); 
        if($gs->is_affilate==0) return;        
        $users = DB::table('users')->select(DB::raw('count(sup_id), sup_id AS id'))
                ->where('sup_id','>',1)
                ->where('id','<>',$user_id)
                ->where('sup_id','<>',$user_id)
                ->where('is_vendor','=',0)
                ->having(DB::raw('count(sup_id)'),'<', $gs->affiliate_max_layers)
                ->groupBy('sup_id')
                ->get();
        $f = true;    
        if(!$users || $users->count()==0) {
            $f = false;
            $query = "SELECT * FROM users AS t1 WHERE t1.id<>".$user_id." AND t1.is_vendor=0 AND (SELECT count(*) FROM users AS t2 WHERE t2.is_vendor=0 AND t2.sup_id=t1.id)<".$gs->affiliate_max_layers;
            $users = DB::select(DB::raw($query));             
            $f = ($users && count($users)>0);
        }        
        if($f) {
            $user = User::findOrFail($user_id);            
            $user->update(['sup_id' => $users[0]->id]);
        }
    }

    private static function checkLastMonthSpent($user_id, $order_date) {
        $cm = date('n', strtotime($order_date));
        $cy = date('Y', strtotime($order_date));
        $s_date = date('Y-n-d H:i:s', mktime(0, 0, 0, $cm, 1, $cy));        
        $orders = Order::where('created_at','>=',$s_date)->where('created_at','<=',$order_date)
                        ->where('status','=','completed')->where('user_id', '=', $user_id)->get();
        $price = 0; $gs = Generalsetting::findOrFail(1);
        if($orders) {
            foreach($orders as $order) {
                $price += $order->pay_amount + $order->wallet_price;
            }
        }
        return ($price >= $gs->affiliate_min_amount);
    }

    public static function setCashback($user_id, $order) {        
        $gs = Generalsetting::findOrFail(1);
        $order_date = $order->created_at;
        if($gs->is_affilate == 0 || !self::checkLastMonthSpent($user_id, $order_date)){
            return false;
        }
        $cur_year = date('Y'); $cur_month = date('n');
        $order_year = date('Y', strtotime($order_date)); $order_month = date('n', strtotime($order_date));
        $cm = date('n', strtotime($order_date));
        $cy = date('Y', strtotime($order_date));
        $s_date = date('Y-n-d H:i:s', mktime(0, 0, 0, $cm, 1, $cy));  
        $is_cur_month = $cur_month == $order_month && $cur_year == $order_year;
        
        $id = $user_id; $user_ids = [];
        for($i=0;$i<$gs->affiliate_members;$i++) {
            $user = User::findOrFail($id);            
            if($user) {                
                $user_ids[] = $user->id;
                if($user->sup_id>0){
                    $id = $user->sup_id;
                } else {
                    break;
                }
            } else {
                break;
            }
        }        
        $n = sizeof($user_ids);
        $check_affiliate = Order::where('created_at','>=',$s_date)->where('created_at','<=',$order_date)
                        ->where('status','=','completed')->where('user_id', '=', $user_id)->where('check_affiliate','=',1)->get()->count();
        if($check_affiliate>0) {
            return self::_checkOrderCashback($user_id, $user_ids, [$order], $is_cur_month);
        } else {
            $orders = Order::where('created_at','>=',$s_date)->where('created_at','<=',$order_date)
                    ->where('status','=','completed')->where('user_id', '=', $user_id)->where('check_affiliate','=',0)->get();
            return self::_checkOrderCashback($user_id, $user_ids, $orders, $is_cur_month);
        }        
    }

    private static function _checkOrderCashback($owner, $user_ids, $orders, $is_cur_month) {
        $amount = 0; $n = sizeof($user_ids); $order_id = 0; $order_number = '';
        $gs = Generalsetting::findOrFail(1);
        foreach($orders as $order) {
            $order_id = $order->id;
            $order_number = $order->order_number;
            $cart = unserialize(bzdecompress(utf8_decode($order->cart)));            
            foreach($cart->items as $product) {
                $p = Product::findOrFail($product['item']['id']);
                if(!$p) continue;
                $category = Category::findOrFail($p->category_id);
                if(!$category) continue;
                $amount += $product['price'] * ($gs->affiliate_rate/100) * ($category->charging_fee/100) / $n;
            }
            $order->check_affiliate = 1;
            $order->update();
        }
        $from = User::findOrFail($owner);
        foreach($user_ids as $id) {
            $user = User::findOrFail($id);
            if($user) {
                if($is_cur_month)
                    $user->affilate_income += $amount;
                else
                    $user->balance += $amount;
                $user->update();                
                self::newTransaction($id, $amount, $owner, $order_id, $order_number);

                $notif = new NewNotification();                
                $notif->setCashbackNotification($user->id, $from->name, $amount);

            }
        }
        return $amount;
    }

    private static function newTransaction($user_id, $amount, $from_id, $order_id, $order_number) {
        $from_user = User::findOrFail($from_id);
        $sign = Currency::where('is_default','=',1)->first();
        $transaction = new Transaction;
        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
        $transaction->amount = $amount;
        $transaction->user_id = $user_id;
        $transaction->currency_sign = $sign->sign;
        $transaction->currency_code = $sign->name;
        $transaction->currency_value = $sign->value;
        $transaction->method = 'cashback';
        $transaction->txnid = null;
        $transaction->details = 'Cashback from '.$from_user->name. ' by Order <a href="'.route('user-order', $order_number).'"><b>'.$order_number.'</b></a>';
        $transaction->type = 'plus';
        $transaction->save();
    }
}
?>