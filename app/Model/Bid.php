<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public function user_account(){
        return $this->hasOne('App\Model\UserAccount', 'id', 'user_account_id');
    }
    
}
