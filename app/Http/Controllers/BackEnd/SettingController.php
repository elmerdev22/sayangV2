<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\HelpCentre;

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

    public function help_centre_edit($id) {
        $data = HelpCentre::where('id', $id)->firstOrFail();
        return view('back-end.setting.help-centre.edit', compact('data'));
    }
    
    public function about() {
        return view('back-end.setting.about.index');
    }

    public function ratings() {
        return view('back-end.setting.ratings.index');
    }

    public function images() {
        return view('back-end.setting.images.index');
    }
}
