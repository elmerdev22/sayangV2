<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderBid extends Model
{
    public function order(){
        return $this->belongsTo('App\Model\Order', 'order_id', 'id');
    }
}
