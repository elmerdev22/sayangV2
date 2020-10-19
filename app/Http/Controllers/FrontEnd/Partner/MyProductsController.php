<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyProductsController extends Controller
{
    public function index(){
        return view('front-end.partner.my-products.index');
    }
    public function add(){
        return view('front-end.partner.my-products.add');
    }
    public function edit(){
        return view('front-end.partner.my-products.edit');
    }
    public function startSale(){
        return view('front-end.partner.my-products.start-sale');
    }
    public function activities(){
        return view('front-end.partner.my-products.activities.index');
    }
}
