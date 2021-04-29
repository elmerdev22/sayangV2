<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\ProductPost;
use Utility;
use Auth;

class ActivitiesController extends Controller
{
    
    public function active(){
        return view('front-end.partner.activities.active.index');
    }

    public function past(){
        return view('front-end.partner.activities.past.index');
    }

    public function cancelled(){
        return view('front-end.partner.activities.cancelled.index');
    }

    public function active_details($slug, $key_token){
        
        $product_post_id = self::get_details($key_token)->id;

        return view('front-end.partner.activities.active.details', compact('product_post_id'));
    }
    public function past_details($slug, $key_token){
        
        $product_post_id = self::get_details($key_token)->id;

        return view('front-end.partner.activities.past.details', compact('product_post_id'));
    }
    public function cancelled_details($slug, $key_token){
        
        $product_post_id = self::get_details($key_token)->id;

        return view('front-end.partner.activities.cancelled.details', compact('product_post_id'));
    }

    public function get_details($key_token){
        $product_post = ProductPost::with(['product'])
            ->whereHas('product', function ($query){
                $query->where('partner_id', Utility::auth_partner()->id);
            })
            ->where('key_token', $key_token)
            ->firstOrFail();

        return $product_post;
    }
}
