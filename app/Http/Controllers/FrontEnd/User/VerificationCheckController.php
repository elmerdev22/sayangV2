<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class VerificationCheckController extends Controller
{
    public function index(){
        if(Auth::user()->verified_at){
            return redirect(route('front-end.user.my-account.index'));
        }
        return view('front-end.user.verification-check.index');
    }
}
