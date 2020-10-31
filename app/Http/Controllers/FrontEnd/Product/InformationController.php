<?php

namespace App\Http\Controllers\FrontEnd\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QueryUtility;
use Utility;
use Session;

class InformationController extends Controller
{
    public function index($slug, $key_token){
        // Key token from product posts table & slug from products table
        $filter = [];
        $filter['select'] = [
            'products.*',
            'product_posts.id as product_post_id',
            'product_posts.product_id',
        ];
        $filter['where']['products.slug'] = $slug;
        $filter['where']['product_posts.key_token'] = $key_token;

        $product     = QueryUtility::product_posts($filter)->first();
        $post_status = Utility::product_post_status($product->product_post_id);

        /* if(
            $post_status == 'not_found' || 
            $post_status == 'done' || 
            $post_status == 'pending' || 
            $post_status == 'ended' || 
            $post_status == 'cancelled'
            )
        */
        if($post_status != 'active'){
            abort(404);
        }

        $trigger_place_bid = false;
        if(Session::has('product_purchase_type')){
            $trigger_place_bid = true;
        }

    	return view('front-end.product.information', compact('product', 'trigger_place_bid'));
    }

    public function redirect($slug, $key_token, $type){
        $url = route('front-end.product.information.index', [
            'slug'      => $slug,
            'key_token' => $key_token
        ]);

        if($type == 'place_bid'){
            Session::flash('product_purchase_type', 'place_bid');
        }

        return redirect($url)->send();
    }

    public function login_redirect($slug, $key_token, $type){
        $url = route('front-end.product.information.redirect', [
            'slug'      => $slug,
            'key_token' => $key_token,
            'type'      => $type
        ]);

        Session::put('user_login_redirect', $url);

        return redirect(route('login'))->send();
    }
}


