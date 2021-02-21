<?php

namespace App\Helpers;
use App\Model\Setting;
use App\Model\Rating;
use App\Model\EmailNotificationSetting;
use App\Model\WebNotificationSetting;
use DB;
class SettingsUtility{

    public static function max_tags_per_product(){
        return null; //if null it means unlimited
    }

    public static function settings_value($settings_key){
        $setting = Setting::where('settings_key', $settings_key)->first();
        return $setting->settings_value;
    }

    public static function settings($key=null){
        
        $group = [
            'bids'              => 'bids',
            'content'           => 'content',
            'web_notifications' => 'web_notifications',
        ];

        $response = [
            //Bids
            'bid_increment_percent' => [
                'group' => $group['bids'],
                'name'  => 'Bid Increment Percentage (%)',
                'value' => 5,
            ],
            'ranking_top_show' => [
                'group' => $group['bids'],
                'name'  => 'Ranking Top Show',
                'value' => 5,
            ],
            'minimum_hours_in_auction' => [
                'group' => $group['bids'],
                'name'  => 'Minimum hours auction (hours)',
                'value' => 3,
            ],
            'maximum_hours_in_auction' => [
                'group' => $group['bids'],
                'name'  => 'Maximum hours auction (hours)',
                'value' => 168,
            ],
            'popcorn_bidding_last_minutes' => [
                'group' => $group['bids'],
                'name'  => 'Popcorn bidding last minutes (minutes)',
                'value' => 3,
            ],
            'popcorn_bidding_last_minutes_repeat' => [
                'group' => $group['bids'],
                'name'  => 'Popcorn bidding last minutes repeat',
                'value' => 3,
            ],
            'popcorn_bidding_additional_minutes' => [
                'group' => $group['bids'],
                'name'  => 'Popcorn bidding additional minutes (minutes)',
                'value' => 3,
            ],
            'winning_bid_expiration' => [
                'group' => $group['bids'],
                'name'  => 'Winning Bid Expiration (Hour)',
                'value' => 5,
            ],

            // Content Logo and Footer
            'logo' => [
                'group' => $group['content'],
                'name'  => 'Logo',
                'value' => null,
            ],
            'icon' => [
                'group' => $group['content'],
                'name'  => 'Icon',
                'value' => null,
            ],
            'app_name' => [
                'group' => $group['content'],
                'name'  => 'App Name',
                'value' => 'Sayang! PH',
            ],
            'home_title' => [
                'group' => $group['content'],
                'name'  => 'Home Title',
                'value' => 'Auctions for Every Juan!',
            ],

        ];

        if($key){
            return $response[$key];
        }else{
            return $response;
        }
    }

    public static function email_notification_settings($key=null){
        
        $response = [
            // Partner Application Approved by admin
            'application_approved_by_admin' => [
                'name'    => 'Partner application approved by admin',
                'subject' => 'Application Approved!',
                'message' => 'Congratulations your application approved!',
            ],
            // Partner Notify if product post is end
            'partner_product_post_end' => [
                'name'    => 'Partner product post is ended',
                'subject' => 'Product is ended!',
                'message' => 'your product is ended click the button below to proceed!',
            ],
            // Bidder win
            'bidder_won' => [
                'name'    => 'Bidder win',
                'subject' => 'your bid is won!',
                'message' => 'congratulation your bid is won!',
            ],
            // Bidder lose
            'bidder_lose' => [
                'name'    => 'Bidder lose',
                'subject' => 'your bid is lose!',
                'message' => 'try again, your bid is lose!',
            ],
            // Product post sold out
            'product_post_sold_out' => [
                'name'    => 'Product sold out',
                'subject' => 'Product sold out!',
                'message' => 'product sold, click the button below for more details',
            ],

        ];

        if($key){
            return $response[$key];
        }else{
            return $response;
        }
    }

    public static function web_notification_settings($key=null){
    
        $response = [
            // Partner Application Approved by admin
            'application_approved_by_admin' => [
                'name'    => 'Partner application approved by admin',
                'title'   => 'Application Approved!',
                'message' => 'Your application approved by the admin, you can start now to sell your products. thank you!',
            ],
            // Partner Notify if product post is end
            'partner_product_post_end' => [
                'name'    => 'Partner product post is ended',
                'title'   => 'Product is ended!',
                'message' => 'your product is ended click herefor more details.',
            ],
            // Partner Notify if product post is cancelled by admin
            'partner_product_post_cancelled' => [
                'name'    => 'Partner product post is cancelled by admin',
                'title'   => 'Product is cancelled!',
                'message' => 'your product is cancelled click herefor more details.',
            ],
            // Bidder win
            'bidder_won' => [
                'name'    => 'Bidder win',
                'title'   => 'your bid is won!',
                'message' => 'Your bid is won click here to more details',
            ],
            // Bidder lose
            'bidder_lose' => [
                'name'    => 'Bidder lose',
                'title'   => 'your bid is lose!',
                'message' => 'Your bid is lose click here to more details',
            ],
            // Product post sold out
            'product_post_sold_out' => [
                'name'    => 'Product sold out',
                'title'   => 'Product sold out!',
                'message' => 'product sold, click the here for more details',
            ],
            // New Cash on Delivery Request
            'new_cop_request' => [
                'name'    => 'New Cash on Pickup Request',
                'title'   => 'COP Request!',
                'message' => 'New Cash on Pickup Request, click the here for more details',
            ],
            // New PRoduct Sold
            'new_product_sold' => [
                'name'    => 'New Product Sold',
                'title'   => 'New Product Sold!',
                'message' => 'New Product Sold, click the here for more details',
            ],
            // Cancelled cop request
            'cancelled_cop_request' => [
                'name'    => 'Cancelled Cash on Pickup Request',
                'title'   => 'COP request cancelled!',
                'message' => 'COP request cancelled!, click the here for more details',
            ],
            // Confirm cop request
            'confirmed_cop_request' => [
                'name'    => 'Confirmed Cash on Pickup Request',
                'title'   => 'COP request Confirmed!',
                'message' => 'COP request Confirmed!, click the here for more details',
            ],
            // Order Completed
            'order_completed' => [
                'name'    => 'Order Completed',
                'title'   => 'Order Completed!',
                'message' => 'Order Completed!, click the here for more details',
            ],
            // Partner New Product Post
            'partner_new_product_post' => [
                'name'    => 'Partner New Post Product',
                'title'   => 'New Post Product!',
                'message' => 'New Post Product , click the here for more details',
            ],

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

    public static function email_notication_settings_set_default(){
        EmailNotificationSetting::truncate();
        $success = true;

        DB::beginTransaction();
        try{
            foreach(self::email_notification_settings() as $settings_key => $settings_value){
                $settings                = new EmailNotificationSetting();
                $settings->settings_key  = $settings_key;
                $settings->settings_name = $settings_value['name'];
                $settings->subject       = $settings_value['subject'];
                $settings->message       = $settings_value['message'];
                $save                    = $settings->save();
    
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

    public static function web_notication_settings_set_default(){
        WebNotificationSetting::truncate();
        $success = true;

        DB::beginTransaction();
        try{
            foreach(self::web_notification_settings() as $settings_key => $settings_value){
                $settings                = new WebNotificationSetting();
                $settings->settings_key  = $settings_key;
                $settings->settings_name = $settings_value['name'];
                $settings->title         = $settings_value['title'];
                $settings->message       = $settings_value['message'];
                $save                    = $settings->save();
    
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