<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Auth;
use Session;

class LoginPartner extends Component
{
    public $email, $password, $remember=false;

    public function render(){
        return view('livewire.auth.login-partner');
    }

	public function authenticate(){
        $rules = [
            'email'    => 'required|email',
            'password' => 'required',
        ];

        $this->validate($rules);

        $auth = [
            'email'    => $this->email,
            'password' => $this->password,
            'type'     => ['partner']
        ];

        if(Auth::attempt($auth, $this->remember)){
            return redirect(route('login-redirect.index'));
        }else{
            $this->password = '';
            Session::flash('error', 'Incorrect Credentials.');
        }
    }
}
