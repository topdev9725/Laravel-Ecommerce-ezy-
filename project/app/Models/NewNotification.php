<?php

namespace App\Models;

use App\Classes\Common;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AutodebitOrder;
use App\Models\Product;
use App\Models\Category;

class NewNotification extends Model
{
    public static function getNewNotifs($id, $is_read=-1)
    {
        $user = User::findOrFail($id);
        if($is_read==-1) {
            $query = NewNotification::where('user_id','=',$id);
        } else {
            $query = NewNotification::where('user_id','=',$id)->where('is_read','=',$is_read);
        }
        if($user->is_vendor==0) {
            $global_query = "user_id=0 AND (deleted_user_ids IS NULL OR JSON_CONTAINS(deleted_user_ids,".$id.",'$')=0)";
            if($is_read==0) {
                $global_query .= " ANd JSON_CONTAINS(read_user_ids,".$id.",'$')=0";
            } else if($is_read==1) {
                $global_query .= "JSON_CONTAINS(read_user_ids,".$id.",'$')=1";
            }
            $result = $query->orWhereRaw($global_query)->orderBy('created_at' ,'DESC')->get();
        } else {
            $result = $query->orderBy('created_at' ,'DESC')->get();
        }
        return $result;
    }

    public function setDiscountNotification($product) {
        $category_id = Product::where('id', '=', $product->id)->first()->category_id;
        $store_type = Category::where('id', '=', $category_id)->first()->store_type;
        
        $p = number_format(($product->previous_price - $product->price)/$product->previous_price * 100);
        $link = route('front.product1', $product->slug).'?store_type='.$store_type;  
        $message = 'Product <a href="'.$link.'"><b>'.$product->name.'</b></a> is discount at '.$p.'%';        
        $this->user_id = 0;
        $this->read_user_ids = "[]";
        $this->deleted_user_ids = "[]";
        $this->message = $message;
        $this->save();
    }

    public function setStockPromotionNotification($product) {
        $category_id = Product::where('id', '=', $product->id)->first()->category_id;
        $store_type = Category::where('id', '=', $category_id)->first()->store_type;
        $link = route('front.product1', $product->slug).'?store_type='.$store_type;                
        $message = 'Stock Promotion of Product <a href="'.$link.'"><b>'.$product->name.'</b></a>';
        $this->user_id = 0;
        $this->read_user_ids = "[]";
        $this->deleted_user_ids = "[]";
        $this->message = $message;
        $this->save();
    }

    public function setOrderNotification($order) {
        $link = route('user-order',$order->id);
        $message = 'Your order <a href="'.$link.'"><b>'.$order->order_number.'</b></a> is '.$order->status;
        $this->user_id = $order->user_id;
        $this->message = $message;
        $this->save();
    }

    public function setAutodebitOrderNotification($order) {
        $status = ['Pending', 'Approved', 'Declined', 'Canceled'];
        $message = 'Your Autodebit Order <b>'.$order->id.'</b> is '.$status[$order->status];
        $this->user_id = $order->user_id;
        $this->message = $message;
        $this->save();
    }

    public function setScanPayNotification($user, $vendor, $amount) {
        $message = 'Your merchant received '.$amount.'from'.$user->name.'by scan and pay';
        $this->user_id = $vendor->id;
        $this->message = $message;
        $this->save();
    }

    public function sendautodebitcancelrequest($vendor_id, $user_id) {
        $user = User::where('id', $user_id)->first();
        $order = AutodebitOrder::where('user_id', $user_id)->where('vendor_id', $vendor_id)->first();
        $message = $user->name.' requests order'.$order->id.' cancel';
        $this->user_id = $vendor_id;
        $this->message = $message;
        $this->save();
    }

    public function setDepositNotification($deposit) {
        $link = route('user-deposit-index');
        $message = 'Your '.strtoupper($deposit->method).' Deposit <a href="'.$link.'"><b>'.$deposit->txnid.'</b> has been completed and '.Common::formatPrice($deposit->amount).' has been added to your balance';
        $this->user_id = $deposit->user_id;
        $this->message = $message;
        $this->save();
    }
    
    public function setCashbackNotification($user_id, $from_name, $amount) {        
        $message = 'You got Cashback '.Common::formatPrice($amount).' from '.$from_name;
        $this->user_id = $user_id;
        $this->message = $message;
        $this->save();
    }

    public function setAutodebitNotification($user_id, $vendor_id, $cost, $status) { 
        if($status == 0) {
            $message = 'Your autodebit membership expired';
            $this->user_id = $user_id;
        } elseif($status == 1) {
            $message = 'You did not pay autodebit membership plan because of insufficient balance so your autodebit membership canceled ';
            $this->user_id = $user_id;
        } elseif($status == 2) {
            $vendor = User::where('id', $vendor_id)->first();
            $message = 'You paid autodebit membership cost RM'.$cost.' to '.$vendor->shop_name;
            $this->user_id = $user_id;
        } elseif($status == 3) {
            $user = User::where('id', $user_id)->first();
            $message = 'You got autodebit membership cost RM'.$cost.' from '.$user->name;
            $this->user_id = $vendor_id;
        }
        
        $this->message = $message;
        $this->save();
    }

}
