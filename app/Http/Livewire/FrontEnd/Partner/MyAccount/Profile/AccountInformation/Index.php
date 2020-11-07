<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\AccountInformation;

use Livewire\Component;
use Utility;

class Index extends Component
{
    public $account;

    public function mount(){
        $this->account = Utility::auth_user_account();
    }

    public function render()
    {
        return view('livewire.front-end.partner.my-account.profile.account-information.index');
    }

}
