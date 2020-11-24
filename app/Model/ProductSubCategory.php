<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    public function sub_categories(){
        return $this->belongsTo('App\Model\SubCategory', 'sub_category_id', 'id');
    }
}
