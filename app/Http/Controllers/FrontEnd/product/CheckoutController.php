<?php

namespace App\Http\Controllers\FrontEnd\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
    	return view('front-end.product.checkout');
    }
}
