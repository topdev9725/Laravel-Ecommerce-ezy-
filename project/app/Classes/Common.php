<?php
namespace App\Classes;

use App\Models\Currency;
use Session;

class Common
{
    public static function formatPrice($price, $currency_code='', $decimal=2) {
        if($currency_code == '') {
            $curr = Currency::where('is_default','=',1)->first();
        } else {
            $curr = Currency::where('name','=', $currency_code)->first();
        }
        return $curr->sign.' '.number_format($price, $decimal);
    }
}
?>