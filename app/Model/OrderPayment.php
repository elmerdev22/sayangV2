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

    public function order_payment_log(){
        return $this->hasOne('App\Model\OrderPaymentLog', 'order_payment_id', 'id');
    }

    public function order_payment_payout_item(){
        return $this->hasOne('App\Model\OrderPaymentPayoutItem', 'order_payment_id', 'id');
    }
}
