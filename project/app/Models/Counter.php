<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = ['referral', 'total_count', 'todays_count', 'today'];

    public $timestamps = false;
}
