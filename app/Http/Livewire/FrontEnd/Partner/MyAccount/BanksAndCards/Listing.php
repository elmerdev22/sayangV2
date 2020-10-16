<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\BanksAndCards;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;
use App\Model\PartnerBankAccount;
use Utility;

class Listing extends Component
{
    public $banks;
    
    public function mount(){
		$account = Utility::auth_user_account();
		$partner = Partner::with(['partner_bank_accounts', 'partner_bank_accounts.bank'])
						->where('user_account_id', $account->id)
						->first();
		if($partner){
			$this->banks = $partner->partner_bank_accounts()->get();
		}
	}

    public function render(){
        return view('livewire.front-end.partner.my-account.banks-and-cards.listing');
    }
}
