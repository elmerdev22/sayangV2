<?php

namespace App\Http\Livewire\BackEnd\User\Profile;

use Livewire\Component;
use App\Model\UserAccount;

class AccountInformation extends Component
{
	public $data;

	public function mount($key_token){
		$this->data = UserAccount::with(['user'])
					->where('key_token', $key_token)
					->firstOrFail();
	}

    public function render(){
        return view('livewire.back-end.user.profile.account-information');
    }
}
