<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Utility;

class MyAccountController extends Controller
{
    public function index(){
        $account = Utility::auth_user_account();

        return view('front-end.user.my-account.index', compact('account'));
    }
}
