<?php

namespace App\Http\Livewire\BackEnd\Partner\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;
use App\Model\PartnerBankAccount;
use Utility;

class OperatingHours extends Component
{
    public $account, $days;
	public function mount($key_token){
        $this->days    = Utility::days();
        $this->account = UserAccount::where('key_token', $key_token)->firstOrFail();
	}

    public function data(){
        $data = Partner::with(['operating_hours'])
                ->where('user_account_id', $this->account->id)
                ->first();

        return $data;
    }

    public function render()
    {
        $data = $this->data();
        return view('livewire.back-end.partner.profile.operating-hours', compact('data'));
    }
}
