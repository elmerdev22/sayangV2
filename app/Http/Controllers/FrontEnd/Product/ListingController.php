<?php

namespace App\Http\Controllers\FrontEnd\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        
        return view('front-end.product.listing', compact('search'));
    }
}
