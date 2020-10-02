<?php

namespace App\Http\Livewire\BackEnd\Partner\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;

class PartnerInformation extends Component
{
	public $account, $partner;

	public function mount($key_token){
		$account 	   = UserAccount::where('key_token', $key_token)->firstOrFail();
		$this->account = $account;
		$this->partner = Partner::with([
				'philippine_barangay', 
				'philippine_barangay.philippine_city', 
				'philippine_barangay.philippine_city.philippine_province',
				'philippine_barangay.philippine_city.philippine_province.philippine_region',
			])
			->where('user_account_id', $account->id)
			->first();
	}
	
    public function render(){
        return view('livewire.back-end.partner.profile.partner-information');
    }
}
