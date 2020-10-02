<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PartnerBankAccount extends Model
{
    public function bank(){
        return $this->belongsTo('App\Model\Bank', 'bank_id', 'id');
    }

    public function partner(){
        return $this->belongsTo('App\Model\Partner', 'partner_id', 'id');
    }
}
