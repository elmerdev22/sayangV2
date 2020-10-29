<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use UploadUtility;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;

    public function partner(){
        return $this->belongsTo('App\Model\Partner', 'partner_id', 'id');
    }

    public function product_post(){
        return $this->hasOne('App\Model\ProductPost', 'product_id', 'id');
    }

    public function registerMediaConversions(Media $media = null){
        $height = UploadUtility::conversion_dimension('height');
        $width  = UploadUtility::conversion_dimension('width');

        $this->addMediaConversion('thumb')->height($height)->width($width);
    }

}
