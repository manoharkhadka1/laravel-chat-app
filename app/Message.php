<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = ['message','file_path','file_name','type'];

    public function user() 
    {
    	return $this->belongsTo('App\User');
    }

    public function receivers() {
        return $this->hasMany('App\Receiver');
    }
}
