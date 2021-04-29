<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\ProductPost;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Utility;
use Session;
use Auth;
use DB;
class MyProductsController extends Controller
{
    public function index(){
        return view('front-end.partner.my-products.index');
    }
    public function add(){
        return view('front-end.partner.my-products.add');
    }
    public function edit($slug){
        $product = Product::where('partner_id', Utility::auth_partner()->id)
            ->where('slug', $slug)
            ->firstOrFail();
        $product_id = $product->id;

        return view('front-end.partner.my-products.edit', compact('product_id'));
    }
    public function start_sale(){
        
        if(Auth::user()->is_blocked){
            abort(401);
        }
        else{
            return view('front-end.partner.my-products.start-sale');
        }
    }

    public function import(Request $request){
        
		$rules = [
            'file' => 'required|mimes:csv,xlsx,xls',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Excel::import(new ProductsImport, $request->file('file'));
        Session::flash('success', 'Your file successfully import in products!');
        return back();
    }
}
