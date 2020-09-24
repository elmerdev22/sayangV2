<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QueryUtility;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }
    public function index() {
        return view('admin.views.dashboard');
    }
    public function user() {
        return view('admin.views.accounts.account',['type' => 'user']);
    }
    public function partner() {
        return view('admin.views.accounts.account',['type' => 'partner']);
    }
    public function catalog() {
        return view('admin.views.products.catalog');
    }
    public function profile($type,$key_token) {
        $partner = [];
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
            'users.name',
            'users.email',
            'users.verification_type',
            'users.verified_at',
        ];
        if($type ==='partner'){
            $partner = [
                'partners.partner_no',
                'partners.name as partner_name',
                'partners.address as partner_address',
                'partners.map_address_link as partner_map_address_link',
                'partners.contact_no as partner_contact_no',
                'partners.email as partner_email',
                'partners.dti_registration_no',
                'partners.tin',
                'partners.dti_certificate_file',
                'partners.dti_certificate_file_name',
                'partners.is_posted',
                'partners.key_token as partner_key_token',
                'partners.created_at as partner_created_at',
            ];
            $filter['select'] = array_merge($filter['select'],$partner);
        }
     
        $user = QueryUtility::user_accounts($filter)->first();
        
        return view('admin.views.accounts.profile',compact('user','type'));
    }
}
