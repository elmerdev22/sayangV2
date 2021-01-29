<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OrderPaymentPayout;
use App\Model\Partner;

class PayableController extends Controller
{
    public function information($payout_no){
        $payout = OrderPaymentPayout::where('payout_no', $payout_no)->firstOrFail();
        return view('back-end.payable.information', compact('payout_no', 'payout'));
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
        $partner = Partner::with(['user_account'])
            ->where('slug', $partner_slug)
            ->firstOrFail();
        return view('back-end.payable.completed-information', compact('partner'));
    }
}
