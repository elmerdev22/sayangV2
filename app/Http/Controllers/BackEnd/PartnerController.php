<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserAccount;
use App\Model\Partner;

class PartnerController extends Controller
{
    public function index() {
        return view('back-end.partner.index');
    }

    public function profile($key_token) {
    	$data = UserAccount::with(['user', 'partner'])
				->whereHas('user', function($query){
                    $query->where('type', 'partner');
                })
				->where('key_token', $key_token)
    			->firstOrFail();

        return view('back-end.partner.profile', compact('data'));
    }
}
