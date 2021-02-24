<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Utility;
use App\Model\Partner;
use App\Model\OperatingHour;
class MyAccountController extends Controller
{
    public function index(){
        $partner = Utility::auth_partner();
        $account = Utility::auth_user_account();
        
        $partner_op = Partner::with(['operating_hours'])->where('id', $partner->id)->first();

        if($partner_op->operating_hours->count() <= 0){
            for($x = 1; $x <= 7; $x++){
                $data             = OperatingHour::firstOrNew(['partner_id' => $partner->id, 'day' => $x]);
                $data->day        = $x;
                $data->partner_id = $partner->id;
                $data->save();
            }
        }

        return view('front-end.partner.my-account.index', compact('partner', 'account'));
    }

    public function bank_and_cards(){
        return view('front-end.partner.my-account.banks-and-cards');
    }
}
