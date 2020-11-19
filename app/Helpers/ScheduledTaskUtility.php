<?php

namespace App\Helpers;
use App\Model\Bid;
use App\Model\ProductPost;
use QueryUtility;
use DB;

class ScheduledTaskUtility{

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
                $bids               = Bind::where('product_post_id', $product_post->id)->orderBy('bid', 'desc')->get();
                    
                foreach($bids as $bid){
                    if($available_quantity > 0){
                        if($current_quantity > 0){
                            if($current_quantity >= $bid->quantity){
                                /* 
                                    Notify the bidder that his/her bid was win 
                                    $quantity_to_avail = $bid->quantity;
                                */
                            }else{
                                /*  Notify the bidder that his/her bid was win 
                                    but his/her preferred quantity is deficient. 
                                    $quantity_to_avail = $bid->quantity - $current_quantity;
                                */
                            }

                            $current_quantity -= $bid->quantity;
                            $bid->status = 'win';
                        }else{
                            /* Notify the bidders that his/her bid was lose */
                            $bid->status = 'lose';
                        }
                    }else{
                        /* Notify bidders that the item was sold out. */
                        $bid->status = 'sold_out';
                    }
                    $bid->save();
                }

                $product_post->status = 'done';

                if($product_post->save()){
                    /* Notify the partner owner of this product post that his/her item was ended */
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