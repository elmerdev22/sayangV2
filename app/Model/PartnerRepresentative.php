<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class PartnerRepresentative extends Model
{
	use HasMediaTrait;
	
    public function partner(){
        return $this->belongsTo('App\Model\Partner', 'partner_id', 'id');
    }
}
