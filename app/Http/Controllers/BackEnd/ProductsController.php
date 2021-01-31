<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QueryUtility;
class ProductsController extends Controller
{
    
    public function index(){
        return view('back-end.products.index');
    }
    public function details($token){
        
        $filter = [];
		$filter['select'] = [
            'products.name as product_name', 
            'users.id as user_id',
			'product_posts.id as product_post_id',
        ];
    
        $filter['where']['product_posts.key_token'] = $token;

        $data = QueryUtility::product_posts($filter)->first();
        return view('back-end.products.details', compact('data'));
    }
}
