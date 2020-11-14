<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyBidController extends Controller
{
    public function active(){
        return view('front-end.user.my-bid.active');
    }
    public function win(){
        return view('front-end.user.my-bid.win');
    }
    public function lose(){
        return view('front-end.user.my-bid.lose');
    }
}
