<?php

namespace App\Http\Controllers\FrontEnd\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request, $category = null, $sub_category = null){
        $search = $request->search;
        
        $data = [
            'search'       => $search,
            'category'     => $category,
            'sub_category' => $sub_category,
        ];
        
        return view('front-end.product.listing', compact('data'));
    }
}
