<?php

namespace App\Helpers;
use App\Model\Setting;
use DB;
class SettingsUtility{

    public static function max_tags_per_product(){
        return null; //if null it means unlimited
    }

    public static function settings($key=null){
        $response = [
            //Bids
            'minimum_bid' => [
                'group' => 'bids',
                'name'  => 'Minimum Bid',
                'value' => 50,
            ],

            //Notifications

            //
        ];

        if($key){
            return $response[$key];
        }else{
            return $response;
        }
    }

    public static function settings_set_default(){
        Setting::truncate();
        $success = true;

        DB::beginTransaction();
        try{
            foreach(self::settings() as $settings_key => $settings_value){
                $settings                 = new Setting();
                $settings->settings_key   = $settings_key;
                $settings->settings_value = $settings_value['value'];
                $settings->settings_group = $settings_value['group'];
                $settings->settings_name  = $settings_value['name'];
                $save                     = $settings->save();
    
                if(!$save){
                    $success = false;
                    break;
                }
            }
        }catch(\Exception $e){
            $success = false;
        }

        if($success){
            DB::commit();
            return $success;
        }else{
            DB::rollback();
            return $success;
        }
    }
}