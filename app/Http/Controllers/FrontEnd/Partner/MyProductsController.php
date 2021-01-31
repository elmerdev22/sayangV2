<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\ProductPost;
use Utility;
use Auth;
class MyProductsController extends Controller
{
    public function index(){
        return view('front-end.partner.my-products.index');
    }
    public function add(){
        return view('front-end.partner.my-products.add');
    }
    public function edit($slug){
        $product = Product::where('partner_id', Utility::auth_partner()->id)
            ->where('slug', $slug)
            ->firstOrFail();
        $product_id = $product->id;

        return view('front-end.partner.my-products.edit', compact('product_id'));
    }
    public function start_sale(){
        
        if(Auth::user()->is_blocked){
            abort(401);
        }
        else{
            return view('front-end.partner.my-products.start-sale');
        }
    }

    // Activities
    public function activities(){
        return view('front-end.partner.my-products.activities.index');
    }

    public function active($slug, $key_token){
        $product_post = ProductPost::with(['product'])
                ->whereHas('product', function ($query){
                    $query->where('partner_id', Utility::auth_partner()->id);
                })
                ->where('key_token', $key_token)
                ->firstOrFail();
        $product_post_id = $product_post->id;

        return view('front-end.partner.my-products.activities.active.details', compact('product_post_id'));
    }
    public function past($slug, $key_token){
        $product_post = ProductPost::with(['product'])
                ->whereHas('product', function ($query){
                    $query->where('partner_id', Utility::auth_partner()->id);
                })
                ->where('key_token', $key_token)
                ->firstOrFail();
        $product_post_id = $product_post->id;

        return view('front-end.partner.my-products.activities.past.details', compact('product_post_id'));
    }
    public function cancelled($slug, $key_token){
        $product_post = ProductPost::with(['product'])
                ->whereHas('product', function ($query){
                    $query->where('partner_id', Utility::auth_partner()->id);
                })
                ->where('key_token', $key_token)
                ->firstOrFail();
        $product_post_id = $product_post->id;

        return view('front-end.partner.my-products.activities.cancelled.details', compact('product_post_id'));
    }
}
