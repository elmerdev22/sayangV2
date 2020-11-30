<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyNotificationController extends Controller
{
    public function index(){
        return view('front-end.user.notifications.order-updates');
    }
    
    public function activity(){
        return view('front-end.user.notifications.activity');
    }
}
