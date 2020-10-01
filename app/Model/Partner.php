<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public function user_account(){
        return $this->belongsTo('App\Model\UserAccount');
    }
}
