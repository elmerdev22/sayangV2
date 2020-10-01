<?php

namespace App\Http\Livewire\BackEnd\Partner\Profile;

use Livewire\Component;
use App\Model\UserAccount;

class BankAndCard extends Component
{
	public $account;

	public function mount($key_token){
		$this->account = UserAccount::where('key_token', $key_token)->firstOrFail();
	}
	
    public function render(){
        return view('livewire.back-end.partner.profile.bank-and-card');
    }
}
