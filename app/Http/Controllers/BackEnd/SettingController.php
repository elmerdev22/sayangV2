<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function bid() {
        return view('back-end.setting.bid.index');
    }

    public function header_and_footer() {
        return view('back-end.setting.header-and-footer.index');
    }
    
    public function notifications() {
        return view('back-end.setting.notifications.index');
    }
    
    public function help_centre() {
        return view('back-end.setting.help-centre.index');
    }
    
    public function about() {
        return view('back-end.setting.about.index');
    }
}
