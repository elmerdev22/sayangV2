<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    public function order(){
        return $this->hasOne('App\Model\Order', 'billing_id', 'id');
    }

    public function user_account(){
        return $this->belongsTo('App\Model\UserAccount', 'user_account_id', 'id');
    }

    public function philippine_barangay(){
        return $this->belongsTo('App\Model\PhilippineBarangay', 'barangay_id', 'id');
    }
}
