<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhilippineBarangay extends Model
{
	public function partner(){
        return $this->hasOne('App\Model\Partner', 'barangay_id', 'id');
    }

    public function philippine_city(){
        return $this->belongsTo('App\Model\PhilippineCity', 'city_id', 'id');
    }
}
