<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model
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

    public function tags(){
        return $this->hasMany('App\Model\Tag', 'category_id', 'id');
    }
}
