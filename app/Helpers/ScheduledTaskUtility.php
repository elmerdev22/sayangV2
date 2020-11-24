<?php

namespace App\Helpers;
use App\Model\Bid;
use App\Model\ProductPost;
use App\Model\Notification;
use QueryUtility;
use Utility;
use App\Mail\EmailNotification;
use DB;

class ScheduledTaskUtility{

    public static function send_notification($email_notification_details, $email){
        \Mail::to($email)->send(new EmailNotification($email_notification_details));
    }

    public static function email_notification_details($settings_key, $url_link){

        $data = [
            'subject'  => Utility::email_notification_settings($settings_key)->subject,
            'message'  => Utility::email_notification_settings($settings_key)->message,
            'url_link' => $url_link,
        ];

        return $data;
    }

    public static function notification_check($user_account_id, $product_post_id, $settings_key){
        
        $data = Notification::where('user_account_id', $user_account_id)
                ->where('product_post_id', $product_post_id)
                ->where('type', $settings_key)
                ->count();

        if($data == 0){
            $notif                  = new Notification();
            $notif->user_account_id = $user_account_id;
            $notif->product_post_id = $product_post_id;
            $notif->type            = $settings_key;
            $notif->save();
            $data = true;
        }
        else{
            $data = false;
        }

        return $data;
    }

    public static function product_post_update(){
        set_time_limit(0);

        DB::beginTransaction();

        try{
            $filter = [];
            $filter['select'] = [
                'product_posts.id'
            ];
            $filter['where']['product_posts.status'] = 'active';
            $filter['where_date_end_expired']        = date('Y-m-d H:i:s');

            $data = QueryUtility::product_posts($filter)->get();

            foreach($data as $row){
                $product_post       = ProductPost::find($row->id);
                $available_quantity = $product_post->quantity;
                $current_quantity   = $available_quantity;
                $bids               = Bid::with(['user_account.user','product_post.product.partner.user_account.user'])
                                        ->where('product_post_id', $product_post->id)
                                        ->orderBy('bid', 'desc')
                                        ->get();
                                        
                foreach($bids as $bid){

                    $url_link = env('APP_URL').'/'.'product'.'/'.$bid->product_post->product->slug.'/'.$bid->product_post->key_token;

                    if($available_quantity > 0){
                        if($current_quantity > 0){
                            if($current_quantity >= $bid->quantity){
                                /* 
                                    Notify the bidder that his/her bid was win 
                                    $quantity_to_avail = $bid->quantity;
                                */
                                $notification_check = self::notification_check($bid->user_account_id, $bid->product_post_id, 'bidder_won');
                                
                                if($notification_check){
                                    $email_notification_details = self::email_notification_details('bidder_won', $url_link);
                                    self::send_notification($email_notification_details, $bid->user_account->user->email);
                                }

                            }else{
                                /*  Notify the bidder that his/her bid was win 
                                    but his/her preferred quantity is deficient. 
                                    $quantity_to_avail = $bid->quantity - $current_quantity;
                                */
                                $notification_check = self::notification_check($bid->user_account_id, $bid->product_post_id, 'bidder_won');
                                
                                if($notification_check){
                                    $email_notification_details = self::email_notification_details('bidder_won',$url_link);
                                    self::send_notification($email_notification_details, $bid->user_account->user->email);
                                }
                            }

                            $current_quantity -= $bid->quantity;
                            $bid->status = 'win';
                        }else{
                            /* Notify the bidders that his/her bid was lose */
                            $bid->status = 'lose';

                            $notification_check = self::notification_check($bid->user_account_id, $bid->product_post_id, 'bidder_lose');
                            
                            if($notification_check){
                                $email_notification_details = self::email_notification_details('bidder_lose',$url_link);
                                self::send_notification($email_notification_details, $bid->user_account->user->email);
                            }
                        }
                    }else{
                        /* Notify bidders that the item was sold out. */
                        $bid->status = 'sold_out';
                        
                        $notification_check = self::notification_check($bid->user_account_id, $bid->product_post_id, 'product_post_sold_out');
                            
                        if($notification_check){
                            $email_notification_details = self::email_notification_details('product_post_sold_out',$url_link);
                            self::send_notification($email_notification_details, $bid->user_account->user->email);
                        }
                    }
                    $bid->save();
                }

                $product_post->status = 'done';

                if($product_post->save()){
                    /* Notify the partner owner of this product post that his/her item was ended */

                    $notification_check = self::notification_check($bid->product_post->product->partner->user_account->id, $bid->product_post_id, 'partner_product_post_end');
                            
                    if($notification_check){
                        $email_notification_details = self::email_notification_details('partner_product_post_end',$url_link);
                        self::send_notification($email_notification_details, $bid->product_post->product->partner->user_account->user->email);
                    }
                }

            }

            $success = true;
        }catch(\Exception $e){
            $success = false;
        }

        if($success){
            DB::commit();
            return 'Product posts successfully updated.';
        }else{
            DB::rollback();
            return 'An error occured while updating product posts.';
        }
    }

}