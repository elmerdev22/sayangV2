<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use Utility;
use Auth;

class MyAccountController extends Controller
{
    public function index(){
        $account  = Utility::auth_user_account();
        $elements = Utility::rescued_elements_computation('user');
        
        return view('front-end.user.my-account.index', compact('account','elements'));
    }

    public function addresses(){
        return view('front-end.user.my-account.addresses');
    }

    public function banks_and_cards(){
        $enabled_bank_account      = false;
        $enabled_debit_credit_card = true;
        return view('front-end.user.my-account.banks-and-cards', compact('enabled_bank_account', 'enabled_debit_credit_card'));
    }

    public function change_password(){
        if(Auth::user()->provider == 'default'){
            return view('front-end.user.my-account.change-password');
        }
        else{
            abort(404);
        }
    }

}
