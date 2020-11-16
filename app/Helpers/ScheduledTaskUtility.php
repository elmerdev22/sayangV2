<?php

namespace App\Helpers;
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
                $product_post         = ProductPost::find($row->id);
                $product_post->status = 'done';
                $product_post->save();
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