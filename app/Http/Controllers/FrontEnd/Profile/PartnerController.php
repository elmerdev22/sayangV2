<?php

namespace App\Http\Controllers\FrontEnd\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Partner;

class PartnerController extends Controller
{
    public function index($slug){
        return view('front-end.profile.partner');
    }
}
