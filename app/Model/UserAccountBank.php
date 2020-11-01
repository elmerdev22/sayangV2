<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAccountBank extends Model
{
    public function bank(){
        return $this->belongsTo('App\Model\Bank', 'bank_id', 'id');
    }

    public function user_account(){
        return $this->belongsTo('App\Model\UserAccount', 'user_account_id', 'id');
    }

    public function user_accounts(){
        return $this->belongsTo('App\Model\UserAccount', 'user_account_id', 'id');
    }
}
