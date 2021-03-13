<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['attributable_id', 'attributable_type', 'name', 'input_name', 'price_status', 'details_status'];

    public function attributable() {
      return $this->morphTo();
    }

    public function attribute_options() {
      return $this->hasMany('App\Models\AttributeOption');
    }
}
