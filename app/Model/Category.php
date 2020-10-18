<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
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

    public function sub_category(){
        return $this->hasMany('App\Model\SubCategory', 'category_id', 'id');
    }
    
    public function registerMediaConversions(Media $media = null){ 
        $this->addMediaConversion('thumb')->height(150)->width(150);
    }
}
