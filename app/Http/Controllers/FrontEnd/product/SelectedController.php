<?php

namespace App\Http\Controllers\FrontEnd\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SelectedController extends Controller
{
    public function index(){
    	return view('front-end.product.selected');
    }
}
