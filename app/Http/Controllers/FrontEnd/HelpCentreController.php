<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpCentreController extends Controller
{
    public function index(){
        return view('front-end.help-centre.index');
    }
}
