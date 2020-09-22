<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Model\User;
use Session;
use Utility;
use Auth;

class ChangeEmail extends Component
{
    public $email;
    
    public function render(){
        return view('livewire.auth.change-email');
    }

    public function update(){
        $rules = [
            'email' => 'required|unique:users'
        ];

        $this->validate($rules);
        $user        = User::find(Auth::user()->id);
        $user->email = $this->email;
        $user->name  = Utility::generate_username_from_email($this->email);
        $user->save();
        
        Session::flash('email_changed', true);
        
        $this->emit('alert_link', [
            'type'     => 'success',
            'title'    => 'Successfully Changed',
            'message'  => 'Verification code successfully sent.',
        ]);
    }
}
