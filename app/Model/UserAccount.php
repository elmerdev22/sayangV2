<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class UserAccount extends Model implements HasMedia
{
	use HasMediaTrait;
    
    public function getFirstNameAttribute($value){
        return ucwords($value);
    }

    public function getMiddleNameAttribute($value){
        return ucwords($value);
    }

    public function getLastNameAttribute($value){
        return ucwords($value);
    }

    public function user(){
        return $this->belongsTo('App\Model\User');
    }

    public function partner(){
        return $this->hasOne('App\Model\Partner', 'user_account_id', 'id');
    }
    
    public function user_account_addresses(){
        return $this->hasMany('App\Model\UserAccountAddress', 'user_account_id', 'id');
    }

    public function registerMediaConversions(Media $media = null){ 
        $this->addMediaConversion('thumb')->height(150)->width(150);
    }
}
