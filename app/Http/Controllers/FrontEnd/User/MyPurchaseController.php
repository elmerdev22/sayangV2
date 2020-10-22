<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyPurchaseController extends Controller
{
    // My Purchase
    public function list(){
        return view('front-end.user.my-purchase.list');
    }
    public function track(){
        return view('front-end.user.my-purchase.track');
    }

    // Completed
    public function completed(){
        return view('front-end.user.my-purchase.completed');
    }
    public function completed_details(){
        return view('front-end.user.my-purchase.completed-details');
    }
}
