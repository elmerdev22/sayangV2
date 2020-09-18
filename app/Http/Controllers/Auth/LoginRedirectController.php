<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Utility;
use Auth;

class LoginRedirectController extends Controller
{
    public function index(){
        if(Session::has('login_using_id')){
            Auth::loginUsingId(Session::get('login_using_id'));
        }

        if(Auth::check()){
            $user = Auth::user();
            if($user->type == 'admin'){
                dd('redirect to admin dashboard');
            }else if($user->type == 'user'){
                return redirect(route('front-end.user.my-account.index'));
            }else if($user->type == 'partner'){
                dd('redirect to partner & merchant dashboard');
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function socialite($provider, $type){
        if(!in_array($provider, Utility::socialite_providers())){
            Session::flash('login_provider_alert', 'Invalid Login Provider.');
            return redirect()->back()->send();
        }

        if($type == 'user' || $type == 'partner'){
            Session::put('login_socialite_type', $type);
            return redirect(route('login.redirectToProvider', ['provider' => $provider]))->send();
        }else{
            return redirect()->back()->send();
        }

    }
}
