<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use UploadUtility;

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

    public function bid(){
        return $this->belongsTo('App\Model\Bid');
    }

    public function partner(){
        return $this->hasOne('App\Model\Partner', 'user_account_id', 'id');
    }
    
    public function user_account_addresses(){
        return $this->hasMany('App\Model\UserAccountAddress', 'user_account_id', 'id');
    }

    public function user_account_banks(){
        return $this->hasMany('App\Model\UserAccountBank', 'user_account_id', 'id');
    }

    public function user_account_bank(){
        return $this->hasOne('App\Model\UserAccountBank', 'user_account_id', 'id');
    }

    public function billing(){
        return $this->belongsTo('App\Model\Billing', 'user_account_id', 'id');
    }

    public function notification(){
        return $this->belongsTo('App\Model\Notification', 'user_account_id', 'id');
    }

    public function registerMediaConversions(Media $media = null){
        $height = UploadUtility::conversion_dimension('height');
        $width  = UploadUtility::conversion_dimension('width');

        $this->addMediaConversion('thumb')->height($height)->width($width);
    }
}
