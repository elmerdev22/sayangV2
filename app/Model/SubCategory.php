<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class SubCategory extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category(){
        return $this->belongsTo('App\Model\Category', 'category_id', 'id');
    }

    public function product_sub_categories(){
        return $this->hasMany('App\Model\ProductSubCategory', 'sub_category_id', 'id');
    }
}
