<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function product_post(){
        return $this->belongsTo('App\Model\ProductPost', 'product_post_id', 'id');
    }
}
