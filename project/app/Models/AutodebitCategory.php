<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutodebitCategory extends Model
{
    protected $fillable = ['name','slug','photo','is_featured','image'];
    protected $table = 'autodebit_categories'; 
}
