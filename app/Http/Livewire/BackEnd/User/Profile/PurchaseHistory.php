<?php

namespace App\Http\Livewire\BackEnd\User\Profile;

use Livewire\Component;
use App\Model\UserAccount;

class PurchaseHistory extends Component
{
	public $account;

	public function mount($key_token){
		$this->account = UserAccount::where('key_token', $key_token)->firstOrFail();
	}
    public function render(){
        return view('livewire.back-end.user.profile.purchase-history');
    }
}
