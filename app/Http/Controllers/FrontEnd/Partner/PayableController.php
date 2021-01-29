<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OrderPaymentPayout;
use Utility;

class PayableController extends Controller
{
    public function information($payout_no){
        $partner = Utility::auth_partner();
        $payout  = OrderPaymentPayout::where(['payout_no' => $payout_no, 'partner_id' => $partner->id])->firstOrFail();
        return view('front-end.partner.payable.information', compact('payout_no', 'payout'));
    }

    public function payable(){
        return view('front-end.partner.payable.payable');
    }

    public function receivable(){
        return view('front-end.partner.payable.receivable');
    }
    
    public function completed(){
        return view('front-end.partner.payable.completed');
    }
}
