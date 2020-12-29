<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bid;
use Utility;
class HomeController extends Controller
{
    public function index(){
        return view('front-end.home.index');
    }

    public function all_most_popular(){
        return view('front-end.home.all-most-popular.index');
    }

    public function all_recently_added(){
        return view('front-end.home.all-recently-added.index');
    }

    public function all_ending_soon(){
        return view('front-end.home.all-ending-soon.index');
    }
}
