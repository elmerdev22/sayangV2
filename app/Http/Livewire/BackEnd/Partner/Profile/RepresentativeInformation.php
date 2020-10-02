<?php

namespace App\Http\Livewire\BackEnd\Partner\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;

class RepresentativeInformation extends Component
{
	public $account, $representative;

	public function mount($key_token){
		$account 	   = UserAccount::where('key_token', $key_token)->firstOrFail();
		$this->account = $account;
		$partner 	   = Partner::with(['partner_representative'])
				->where('user_account_id', $account->id)
				->first();
		
		if($partner){
			$this->representative = $partner->partner_representative;
		}
	}
	
    public function render(){
        return view('livewire.back-end.partner.profile.representative-information');
    }
}
