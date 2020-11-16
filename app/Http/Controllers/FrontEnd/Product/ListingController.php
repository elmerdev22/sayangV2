<?php

namespace App\Http\Controllers\FrontEnd\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(){
        return view('front-end.product.list');
    }
}
