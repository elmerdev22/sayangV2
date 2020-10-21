<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyPurchaseController extends Controller
{
    // My Purchase
    public function orders(){
        return view('front-end.user.my-purchase.orders');
    }
    public function track(){
        return view('front-end.user.my-purchase.track');
    }
}
