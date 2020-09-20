<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class VerificationCheck extends Component
{
    public function render(){
        return view('livewire.auth.verification-check');
    }

    public function update(){
        dd('');
    }
}
