<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorOrder extends Model
{
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
    
    public static function getPendingOrdersCount($vendor_id) {
        return VendorOrder::where('user_id','=',$vendor_id)->where('status','=','pending')->get()->groupBy('order_number')->count();
    }
}
