<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VendorAmount;

class DeliveryCoupon extends Model
{
    public static function getDeliveryCoupon($user_id, $vendor_id) {
        $user = User::findOrFail($user_id);        
        $delivery_coupon = null;

        if($user) {
            $amount = VendorAmount::getTotalAmount($user_id, $vendor_id);
            $coupons = DeliveryCoupon::where('vendor_id', '=', $vendor_id)->orderBy('min_amount', 'DESC')->get();
            foreach($coupons as $item) {                
                if($amount>=$item->min_amount) {
                    if(($item->max_amount>0 && $amount<=$item->max_amount) || $item->max_amount==0) {
                        $delivery_coupon = $item;
                        break;
                    }
                }
            }
        }
        return $delivery_coupon;
    }

}
