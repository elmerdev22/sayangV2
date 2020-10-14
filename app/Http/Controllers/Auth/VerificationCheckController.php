<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Auth;
use Session;
use Utility;

class VerificationCheckController extends Controller
{
    public function index(){
        if(Auth::user()->verified_at){
            return redirect(route('login-redirect.index'));
        }

        $user              = User::find(Auth::user()->id);
        $request_new_email = true;

        if($user->email){
            $is_expired = Utility::is_date_time_expired($user->verification_expired_at);

            if($is_expired === true || $user->verification_code == null || Session::has('email_changed')){
                $user->verification_code       = rand(100000, 999999);
                $user->verification_expired_at = Utility::generate_verification_expiration();
                if($user->save()){
                    Utility::mail_verification_code($user);
                }
            }
            
            $request_new_email = false;
        }

        return view('auth.verification-check', compact('request_new_email'));
    }
}
