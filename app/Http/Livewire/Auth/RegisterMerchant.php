<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Rules\MobileNo;
use App\Model\User;
use App\Model\UserAccount;
use Utility;
use Auth;
use Hash;
use DB;

class RegisterMerchant extends Component
{
    public $first_name, $last_name, $email, $contact_no, $password, $confirm_password, $agree=true;

    public function render(){
        return view('livewire.auth.register-merchant');
    }

    public function store(){
        $rules = [
			'first_name'       => 'required|max:150',
			'last_name'        => 'required|max:150',
			'email'            => 'required|email|unique:users',
			'contact_no'       => ['required', 'unique:user_accounts', new MobileNo],
			'password'         => 'required|required_with:confirm_password|same:confirm_password|min:8',
			'confirm_password' => 'required|min:8'
        ];
        $messages = [];
        $this->validate($rules, $messages);

        
    }
}
