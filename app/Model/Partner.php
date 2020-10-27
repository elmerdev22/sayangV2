<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Partner extends Model implements HasMedia
{
    use HasMediaTrait;
    
    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function user_account(){
        return $this->belongsTo('App\Model\UserAccount');
    }

    public function philippine_barangay(){
        return $this->belongsTo('App\Model\PhilippineBarangay', 'barangay_id', 'id');
    }

    public function partner_bank_accounts(){
        return $this->hasMany('App\Model\PartnerBankAccount', 'partner_id', 'id');
    }

    public function partner_representative(){
        return $this->hasOne('App\Model\PartnerRepresentative', 'partner_id', 'id');
    }

    public function product(){
        return $this->hasOne('App\Model\Product', 'partner_id', 'id');
    }

    public function registerMediaConversions(Media $media = null){
        $this->addMediaConversion('medium')->height(150)->width(150);
    }
}
