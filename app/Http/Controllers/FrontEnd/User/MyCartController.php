<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyCartController extends Controller
{
    public function index(){
        return view('front-end.user.my-cart.index');
    }
}
