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
        $cart = Utility::cart(Utility::auth_user_account()->id, true);

        if($cart['total_items'] <= 0){
            Session::flash('check_out_item_alert', true);
            return redirect(route('front-end.user.my-cart.index'))->send();
        }

        return view('front-end.user.check-out.index');
    }
}
