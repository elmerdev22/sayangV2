<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function partner_bank_account(){
        return $this->hasOne('App\Model\PartnerBankAccount', 'bank_id', 'id');
    }

    public function user_account_bank(){
        return $this->hasOne('App\Model\UserAccountBank', 'bank_id', 'id');
    }

    public function admin_bank_account(){
        return $this->hasOne('App\Model\AdminBankAccount', 'bank_id', 'id');
    }

    public function order_payment(){
        return $this->belongsTo('App\Model\OrderPayment', 'bank_id', 'id');
    }
}
