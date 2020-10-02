<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function partner_bank_account(){
        return $this->hasOne('App\Model\PartnerBankAccount', 'bank_id', 'id');
    }
}
