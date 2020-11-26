<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentLog extends Model
{
    public function order_payment(){
        return $this->belongsTo('App\Model\OrderPayment', 'order_payment_id', 'id');
    }
}
