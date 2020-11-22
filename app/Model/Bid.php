<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public function user_account(){
        return $this->hasOne('App\Model\UserAccount', 'id', 'user_account_id');
    }

    public function product_post(){
        return $this->hasOne('App\Model\ProductPost', 'id', 'product_post_id');
    }
    
}
