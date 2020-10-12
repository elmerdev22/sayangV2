<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Media\Media;

class PartnerRepresentative extends Model
{
    use HasMediaTrait;
    
    public function getDesignationAttribute($value){
        return ucwords($value);
    }

    public function getFirstNameAttribute($value){
        return ucwords($value);
    }

    public function getLastNameAttribute($value){
        return ucwords($value);
    }
	
    public function partner(){
        return $this->belongsTo('App\Model\Partner', 'partner_id', 'id');
    }

    public function registerMediaConversions(Media $media = null){
        $this->addMediaConversion('medium')->height(150)->width(150);
    }
}
