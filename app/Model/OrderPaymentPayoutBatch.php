<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentPayoutBatch extends Model
{
    protected $table = 'order_payment_payout_batches';

    public function order_payment_payout(){
        return $this->hasOne('App\Model\OrderPaymentPayout', 'payout_batch_id', 'id');
    }

    public function order_payment_payouts(){
        return $this->hasMany('App\Model\OrderPaymentPayout', 'payout_batch_id', 'id');
    }
}
