<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentPayoutItem extends Model
{
    public function order_payment(){
        return $this->belongsTo('App\Model\OrderPayment', 'order_payment_id', 'id');
    }

    public function order_payment_payout(){
        return $this->belongsTo('App\Model\OrderPaymentPayout', 'order_payment_payout_id', 'id');
    }

    public function order_payment_payouts(){
        return $this->belongsTo('App\Model\OrderPaymentPayout', 'order_payment_payout_id', 'id');
    }
}
