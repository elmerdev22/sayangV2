<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductPost extends Model
{
    public function product(){
        return $this->belongsTo('App\Model\Product', 'product_id', 'id');
    }

    public function cart(){
        return $this->hasOne('App\Model\Cart', 'product_post_id', 'id');
    }
}
