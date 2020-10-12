<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhilippineCity extends Model
{
    public function getNameAttribute($value){
        return ucwords(strtolower($value));
    }

    public function philippine_barangay(){
        return $this->hasOne('App\Model\PhilippineBarangay', 'city_id', 'id');
    }

    public function philippine_province(){
        return $this->belongsTo('App\Model\PhilippineProvince', 'province_id', 'id');
    }
}
