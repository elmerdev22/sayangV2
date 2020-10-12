<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserAccountAddress extends Model
{
    public function getFullNameAttribute($value){
        return ucwords($value);
    }

    public function user_account(){
        return $this->belongsTo('App\Model\UserAccount', 'user_account_id', 'id');
    }

    public function philippine_barangay(){
        return $this->belongsTo('App\Model\PhilippineBarangay', 'barangay_id', 'id');
    }
}
