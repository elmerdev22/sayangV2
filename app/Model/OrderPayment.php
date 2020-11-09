<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    public function order(){
        return $this->belongsTo('App\Model\Order', 'order_id', 'id');
    }

    public function bank(){
        return $this->belongsTo('App\Model\Bank', 'bank_id', 'id');
    }
}
