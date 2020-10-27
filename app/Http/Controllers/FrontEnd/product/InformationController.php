<?php

namespace App\Http\Controllers\FrontEnd\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QueryUtility;
use Session;

class InformationController extends Controller
{
    public function index($slug, $key_token){
        // Key token from product posts table & slug from products table
        $filter = [];
        $filter['select'] = ['product_posts.product_id',];
        $filter['where']['product_posts.status'] = 'active';
        $filter['where']['products.slug'] = $slug;
        $filter['where']['product_posts.key_token'] = $key_token;
        $date_time = date('Y-m-d H:i:s');

        $filter['date_range_two_field'][] = [
            'field_from' => 'product_posts.date_start',
            'field_to'   => 'product_posts.date_end',
            'date'       => $date_time
        ];

        $product = QueryUtility::product_posts($filter)->first();
        
        if(!$product){
            abort(404);
        }

        $product_id  = $product->product_id;
        $product_url = route('front-end.product.information.index', [
            'slug'      => $slug,
            'key_token' => $key_token
        ]);

    	return view('front-end.product.information', compact('product_id', 'product_url'));
    }

    public function redirect($slug, $key_token, $type){
        $url = route('front-end.product.information.index', [
            'slug'      => $slug,
            'key_token' => $key_token
        ]);

        if($type == 'place_bid'){
            Session::flash('product_information_redirect', ['type' => 'place_bid']);
        }

        return redirect($url)->send();
    }
}
