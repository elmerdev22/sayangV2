<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserAccount;

class UserController extends Controller
{
    public function index() {
        return view('back-end.user.index');
    }

    public function profile($key_token) {

    	$data = UserAccount::with(['user'])
				->whereHas('user', function($query){
		       		$query->where('type', 'user');
				})
				->where('user_accounts.key_token', $key_token)
    			->firstOrFail();
    			
        return view('back-end.user.profile', compact('data'));
    }
}
