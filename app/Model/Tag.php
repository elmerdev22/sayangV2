<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function product_tag(){
        return $this->hasOne('App\Model\ProductTag', 'tag_id', 'id');
    }
}
