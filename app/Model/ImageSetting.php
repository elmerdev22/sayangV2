<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use UploadUtility;

class ImageSetting extends Model implements HasMedia
{
    
    use HasMediaTrait;
    
    protected $fillable = [
        'settings_group'
    ];

    public function registerMediaConversions(Media $media = null){
        $height = 2400;
        $width  = 1600;
        
        $this->addMediaConversion('thumb')->height($height)->width($width);
    }
}
