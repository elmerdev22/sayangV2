<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyProductsController extends Controller
{
    public function index(){
        return view('front-end.partner.my-products.listing.index');
    }
    public function addProduct(){
        return view('front-end.partner.my-products.listing.add');
    }
    public function editProduct(){
        return view('front-end.partner.my-products.listing.edit');
    }
    public function startSale(){
        return view('front-end.partner.my-products.listing.start-sale');
    }
    public function activities(){
        return view('front-end.partner.my-products.activities.index');
    }
}
