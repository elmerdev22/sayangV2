<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginRedirectController extends Controller
{
    public function index(){
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
}
