<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Utility;

class MyAccountController extends Controller
{
    public function index(){
        $partner = Utility::auth_partner();
        $account = Utility::auth_user_account();

        return view('front-end.partner.my-account.index', compact('partner', 'account'));
    }
}
