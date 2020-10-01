<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function user_account(){
        return $this->hasOne('App\Model\UserAccount', 'user_id', 'id');
    }
}
