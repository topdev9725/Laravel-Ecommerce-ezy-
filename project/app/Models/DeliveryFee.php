<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Province;
use App\Models\User;

class DeliveryFee extends Model
{
    public static function getDeliveryFee($vendor_id, $state) {
        $delivery_fee = null;
        $province = Province::where('province_name', '=', $state)->first();
        if($province) {
            $delivery_fee = DeliveryFee::where('vendor_id', '=', $vendor_id)->whereRaw("JSON_CONTAINS(province_ids,".$province->id.",'$')=1")->first();
        }
        return $delivery_fee;
    }

}
