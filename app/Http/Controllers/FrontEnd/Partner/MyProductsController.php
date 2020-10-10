<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyProductsController extends Controller
{
    public function index(){
        return view('front-end.partner.my-products.index');
    }

    public function menu(){
        return view('front-end.partner.my-products.menu');
    }
    public function addMenu(){
        return view('front-end.partner.my-products.add-menu');
    }
}
