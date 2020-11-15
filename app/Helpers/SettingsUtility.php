<?php

namespace App\Helpers;
use App\Model\Setting;
use App\Model\Rating;
use DB;
class SettingsUtility{

    public static function max_tags_per_product(){
        return null; //if null it means unlimited
    }

    public static function settings($key=null){
        
        $group = [
            'bids'          => 'bids',
            'notifications' => 'notifications',
        ];

        $response = [
            //Bids
            'bid_increment_percent' => [
                'group' => $group['bids'],
                'name'  => 'Bid Increment Percentage',
                'value' => 50,
            ],
            'ranking_top_show' => [
                'group' => $group['bids'],
                'name'  => 'Ranking Top Show',
                'value' => 5,
            ],

            //Notifications
            'partner_approved_by_admin_notif' => [
                'group' => $group['notifications'],
                'name'  => 'Application Approved!',
                'value' => 'Your application approved by the admin, you can start now to sell your products. thank you!',
            ],
            //
        ];

        if($key){
            return $response[$key];
        }else{
            return $response;
        }
    }

    public static function ratings($key=null){
        
        $response = [
            //1 star
            '1' => 'Rude Seller',

            //2 star
            2 => 'Seller not responsive',

            //3 star
            3 => 'Responsive seller',

            //4 star
            4 => 'Accomodating seller',

            //5 star
            5 => 'Very Accomodating seller',
            
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
    public static function ratings_set_default(){
        Rating::truncate();
        $success = true;

        DB::beginTransaction();
        try{
            foreach(self::ratings() as $ratings_key => $ratings_value){
                $rating         = new Rating();
                $rating->star   = $ratings_key;
                $rating->rating = $ratings_value;
                $save           = $rating->save();
    
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