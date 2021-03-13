<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['subtitle_text','subtitle_size','subtitle_color','subtitle_anime','title_text','title_size','title_color','title_anime','details_text','details_size','details_color','details_anime','photo','position','link'];
    public $timestamps = false;
}
