<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhilippineProvince extends Model
{
	public function philippine_city(){
        return $this->hasOne('App\Model\PhilippineCity', 'province_id', 'id');
    }

    public function philippine_region(){
        return $this->belongsTo('App\Model\PhilippineRegion', 'region_id', 'id');
    }
}
