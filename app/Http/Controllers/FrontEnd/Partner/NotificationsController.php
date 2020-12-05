<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    
    public function index(){
        return view('front-end.partner.notifications.order-updates');
    }
    public function activity(){
        return view('front-end.partner.notifications.activity');
    }
}
