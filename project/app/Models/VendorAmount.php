<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorAmount extends Model
{
    public static function getTotalAmount($user_id, $vendor_id) {
        $data = VendorAmount::where('user_id', '=', $user_id)->where('vendor_id','=',$vendor_id)->first();
        $amount = 0;
        if($data) {
            $amount = $data->amount;
        }
        return $amount;
    }

    public static function saveAmount($user_id, $vendor_id, $amount) {
        $data = VendorAmount::where('user_id', '=', $user_id)->where('vendor_id','=',$vendor_id)->first();
        if($data) {
            $data->amount += $amount;
            $data->update();
        } else {
            $data = new VendorAmount();
            $data->user_id = $user_id;
            $data->vendor_id = $vendor_id;
            $data->amount = $amount;
            $data->save();
        }
    }
}
