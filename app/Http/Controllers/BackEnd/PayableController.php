<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayableController extends Controller
{
    public function information($payout_no){
        return view('back-end.payable.information', compact('payout_no'));
    }

    public function to_pay(){
        return view('back-end.payable.to-pay');
    }

    public function to_receive(){
        return view('back-end.payable.to-receive');
    }
    
    public function completed(){
        return view('back-end.payable.completed');
    }
    public function completed_view(){
        return view('back-end.payable.completed-view');
    }
}
