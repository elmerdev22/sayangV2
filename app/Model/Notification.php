<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function user_account(){
        return $this->hasOne('App\Model\UserAccount', 'id', 'user_account_id');
    }

    public function product_post(){
        return $this->hasOne('App\Model\ProductPost', 'id', 'product_post_id');
    }

    public function web_notification_settings(){
        return $this->hasOne('App\Model\WebNotificationSetting', 'settings_key', 'type');
    }
}
