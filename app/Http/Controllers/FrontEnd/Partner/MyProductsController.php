<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;

class MyProductsController extends Controller
{
    public function index(){
        return view('front-end.partner.my-products.index');
    }
    public function add(){
        return view('front-end.partner.my-products.add');
    }
    public function edit($slug){
        $product    = Product::where('slug', $slug)->firstOrFail();
        $product_id = $product->id;

        return view('front-end.partner.my-products.edit', compact('product_id'));
    }
    public function startSale(){
        return view('front-end.partner.my-products.start-sale');
    }
    public function activities(){
        return view('front-end.partner.my-products.activities.index');
    }
}
