<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function billing(){
        return $this->belongsTo('App\Model\Billing', 'billing_id', 'id');
    }

    public function order_payment(){
        return $this->hasOne('App\Model\OrderPayment', 'order_id', 'id');
    }
}
