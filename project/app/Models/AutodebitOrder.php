<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VendorAmount;

class AutodebitOrder extends Model
{
    public static function getPendingOrdersCount($vendor_id) {
        return AutodebitOrder::where('vendor_id','=',$vendor_id)->where('status','=',0)->get()->count();
    }

}
