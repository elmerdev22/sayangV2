<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('back-end.user.index');
    }

    public function profile($key_token) {
        return view('back-end.user.profile');
    }
}
