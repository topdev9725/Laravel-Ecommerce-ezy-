<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUserConversation extends Model
{
	public function user()
	{
	    return $this->belongsTo('App\Models\User')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
	}

	public function admin()
	{
	    return $this->belongsTo('App\Models\Admin')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
	}

	public function messages()
	{
	    return $this->hasMany('App\Models\AdminUserMessage','conversation_id');
	}

	public function notifications()
	{
	    return $this->hasMany('App\Models\UserNotification','conversation1_id');
	}
}
