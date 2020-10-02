<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhilippineRegion extends Model
{
	public function philippine_province(){
        return $this->hasOne('App\Model\PhilippineProvince', 'region_id', 'id');
    }
}
