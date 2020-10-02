<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PartnerRepresentative extends Model
{
    public function partner(){
        return $this->belongsTo('App\Model\Partner', 'partner_id', 'id');
    }
}
