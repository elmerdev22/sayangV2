<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class UserAccount extends Model
{
	use HasMediaTrait;
	
    public function user(){
        return $this->belongsTo('App\Model\User');
    }

    public function partner(){
        return $this->hasOne('App\Model\Partner', 'user_account_id', 'id');
    }
}
