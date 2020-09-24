<?php

namespace App\Http\Livewire\Admin\Views\Auth;

use Livewire\Component;
use Auth;
class Login extends Component
{
    public $email, $password, $remember=false;

    public function render()
    {
        return view('livewire.admin.views.auth.login');
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
            'type'     => 'admin'
        ];

        if(Auth::attempt($auth, $this->remember)){
            return redirect(route('login-redirect.index'));
        }else{
            $this->password = '';
            Session::flash('error', 'Incorrect Credentials.');
        }
    }
}
