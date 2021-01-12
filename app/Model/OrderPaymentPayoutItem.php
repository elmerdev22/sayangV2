<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentPayoutItem extends Model
{
    public function order_payment(){
        return $this->hasOne('App\Model\OrderPayment', 'order_payment_id', 'id');
    }

    public function order_payment_payout(){
        return $this->hasOne('App\Model\OrderPaymentPayout', 'order_payment_payout_item_id', 'id');
    }

    public function order_payment_payouts(){
        return $this->hasMany('App\Model\OrderPaymentPayout', 'order_payment_payout_item_id', 'id');
    }
}
