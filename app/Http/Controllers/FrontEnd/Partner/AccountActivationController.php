<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Partner;
use App\Model\PartnerBankAccount;
use App\Model\PartnerRepresentative;
use Utility;

class AccountActivationController extends Controller
{
    public function index(){
        $account = Utility::auth_user_account();
        $step_to = 1;
        $partner = Partner::where('user_account_id', $account->id)->first();

        if($partner){
            $representative = PartnerRepresentative::where('partner_id', $partner->id)->count();
            $bank_account   = PartnerBankAccount::where('partner_id', $partner->id)->count();

            if($partner->status == 'done'){
                $step_to = 5;
            }else if($bank_account > 0){
                $step_to = 4;
            }else if($representative > 0){
                $step_to = 3;
            }
        }


        return view('front-end.partner.account-activation.index', compact('step_to'));
    }
}
