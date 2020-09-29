<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index() {
        return view('back-end.partner.index');
    }

    public function profile($key_token) {
        return view('back-end.partner.profile');
    }
}
