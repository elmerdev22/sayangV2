<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminBankAccount extends Model
{
    public function bank(){
        return $this->belongsTo('App\Model\Bank', 'bank_id', 'id');
    }
}
