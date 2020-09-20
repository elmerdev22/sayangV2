<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountActivationController extends Controller
{
    public function index(){
        return view('front-end.partner.account-activation.index');
    }
}
