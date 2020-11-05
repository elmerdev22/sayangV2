<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;
use Utility;
use Session;

class CheckOutController extends Controller
{

    public function index(){
        $carts = Cart::with(['product_post', 'product_post.product'])
            ->where('user_account_id', Utility::auth_user_account()->id)
            ->where('is_checkout', true)
            ->get();

        $total_items = 0;
        foreach($carts as $row){
            $post_status = Utility::product_post_status($row->product_post_id);
            if($post_status == 'active'){
                $total_items++;
            }
        }

        if($total_items <= 0){
            Session::flash('check_out_item_alert', true);
            return redirect(route('front-end.user.my-cart.index'))->send();
        }

        return view('front-end.user.check-out.index');
    }
}
