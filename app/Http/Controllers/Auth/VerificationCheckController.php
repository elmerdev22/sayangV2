<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class VerificationCheckController extends Controller
{
    public function index(){
        if(Auth::user()->verified_at){
            return redirect(route('login-redirect.index'));
        }
        return view('auth.verification-check');
    }
}
