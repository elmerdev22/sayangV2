<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayableController extends Controller
{
    public function information($payout_no){
        return view('back-end.payable.information', compact('payout_no'));
    }

    public function payable(){
        return view('back-end.payable.payable');
    }

    public function receivable(){
        return view('back-end.payable.receivable');
    }
    
    public function completed(){
        return view('back-end.payable.completed');
    }
    public function completed_information($partner_slug){
        return view('back-end.payable.completed-information');
    }
}
