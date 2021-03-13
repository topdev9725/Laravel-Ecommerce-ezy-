<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedLink extends Model
{
    protected $fillable = ['name','link','photo'];

    public $timestamps = false;
}