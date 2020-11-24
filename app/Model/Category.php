<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use UploadUtility;

class Category extends Model implements HasMedia
{
	use HasMediaTrait;
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function sub_categories(){
        return $this->hasMany('App\Model\SubCategory', 'category_id', 'id');
    }
    
    public function registerMediaConversions(Media $media = null){
        $height = UploadUtility::conversion_dimension('height');
        $width  = UploadUtility::conversion_dimension('width');

        $this->addMediaConversion('thumb')->height($height)->width($width);
    }
}
