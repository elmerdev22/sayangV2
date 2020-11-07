<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\BusinessInformation;

use Livewire\Component;
use Utility;
class BusinessInformation extends Component
{
    public $partner, $account;

    public function mount(){
        $this->partner = Utility::auth_partner();
        $this->account = Utility::auth_user_account();
    }

    public function render()
    {
        return view('livewire.front-end.partner.my-account.profile.business-information.business-information');
    }
}
