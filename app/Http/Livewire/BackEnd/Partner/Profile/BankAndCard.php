<?php

namespace App\Http\Livewire\BackEnd\Partner\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;
use App\Model\PartnerBankAccount;

class BankAndCard extends Component
{
	public $banks;

	public function mount($key_token){
		$account = UserAccount::where('key_token', $key_token)->firstOrFail();
		$partner = Partner::with(['partner_bank_accounts', 'partner_bank_accounts.bank'])
						->where('user_account_id', $account->id)
						->first();
		if($partner){
			$this->banks = $partner->partner_bank_accounts()->get();
		}
	}
	
    public function render(){
        return view('livewire.back-end.partner.profile.bank-and-card');
    }
}
