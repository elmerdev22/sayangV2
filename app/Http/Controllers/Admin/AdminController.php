<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QueryUtility;
class AdminController extends Controller
{
    public function index() {
        return view('admin.views.dashboard');
    }
    public function user() {
        return view('admin.views.accounts.account');
    }
    public function partner() {
        return view('admin.views.accounts.account');
    }
    public function catalog() {
        return view('admin.views.products.catalog');
    }
    public function profile($key_token) {
        $filter['where']['user_accounts.key_token'] = $key_token;
        $filter['select'] = [
            'user_accounts.first_name',
            'user_accounts.middle_name',
            'user_accounts.last_name',
            'user_accounts.contact_no',
            'user_accounts.birth_date',
            'user_accounts.gender',
            'user_accounts.building_no',
            'user_accounts.street',
            'user_accounts.zip_code',
            'user_accounts.barangay',
            'user_accounts.photo_provider_link',
            'user_accounts.key_token',
            'cities.name as city',
            'users.name',
            'users.email',
            'users.verification_type',
            'users.verified_at',
        ];
        $user = QueryUtility::user_accounts($filter)->first();
        return view('admin.views.accounts.profile',compact('user'));
    }
}
