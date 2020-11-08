<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    public function index($redirect){
        
        Auth::logout();
                
        if($redirect == 'partner_login'){
            return redirect()->route('partner.login');
        }
        else if($redirect == 'admin_login'){
            return redirect()->route('admin.login');
        }
        else{
            return redirect()->url('/login');
        }
    }
}
