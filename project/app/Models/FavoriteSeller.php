<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteSeller extends Model
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

    public function vendor()
    {
        return $this->belongsTo('App\Models\User','user_id')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
