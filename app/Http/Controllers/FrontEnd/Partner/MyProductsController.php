<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyProductsController extends Controller
{
    public function index(){
        return view('front-end.partner.my-products.listing.index');
    }

    public function menu(){
        return view('front-end.partner.my-products.menu.index');
    }
    public function addMenu(){
        return view('front-end.partner.my-products.menu.add');
    }
    public function editMenu(){
        return view('front-end.partner.my-products.menu.edit');
    }
}
