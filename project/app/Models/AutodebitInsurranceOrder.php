<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VendorAmount;

class AutodebitInsurranceOrder extends Model
{
    protected $table = 'autodebit_insurrance_orders'; 

    public static function getPendingOrdersCount($vendor_id) {
        return AutodebitInsurranceOrder::where('vendor_id','=',$vendor_id)->where('status','=',0)->get()->count();
    }
}
