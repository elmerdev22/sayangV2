<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhilippineBarangay extends Model
{
    public function getNameAttribute($value){
        return ucwords(strtolower($value));
    }
    
	public function partner(){
        return $this->hasOne('App\Model\Partner', 'barangay_id', 'id');
    }

    public function user_account_address(){
        return $this->hasOne('App\Model\UserAccountAddress', 'barangay_id', 'id');
    }

    public function billing(){
        return $this->hasOne('App\Model\Billing', 'barangay_id', 'id');
    }

    public function philippine_city(){
        return $this->belongsTo('App\Model\PhilippineCity', 'city_id', 'id');
    }
}
