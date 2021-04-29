<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OperatingHour extends Model
{
    protected $fillable = ['partner_id'];
    
    public function partners(){
        return $this->belongsTo('App\Model\Partner', 'partner_id', 'id');
    }
}
