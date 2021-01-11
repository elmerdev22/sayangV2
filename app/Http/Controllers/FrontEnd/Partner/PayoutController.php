<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function to_pay(){
        return view('front-end.partner.payout.to-pay');
    }

    public function to_receive(){
        return view('front-end.partner.payout.to-receive');
    }

    public function completed(){
        return view('front-end.partner.payout.completed');
    }
}
