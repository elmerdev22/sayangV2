<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    public function tag(){
        return $this->belongsTo('App\Model\Tag', 'tag_id', 'id');
    }
}
