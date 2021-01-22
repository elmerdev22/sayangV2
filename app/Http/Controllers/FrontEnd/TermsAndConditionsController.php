<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function index(){
        return view('front-end.terms-and-conditions.index');
    }
    public function partners(){
        return view('front-end.terms-and-conditions.partners');
    }
}
