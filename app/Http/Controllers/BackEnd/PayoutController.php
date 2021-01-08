<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function to_pay(){
        return view('back-end.payout.to-pay');
    }

    public function to_receive(){
        return view('back-end.payout.to-receive');
    }

    public function completed(){
        return view('back-end.payout.completed');
    }
}
