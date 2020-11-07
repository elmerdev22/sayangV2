<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\BusinessInformation;

use Livewire\Component;
use Utility;
class BusinessInformation extends Component
{
    public $partner, $account;
    public $name, $contact_no, $email, $dti_registration_no;

    public function mount(){
        $this->partner = Utility::auth_partner();
        $this->account = Utility::auth_user_account();

        $this->name                = $this->partner->name;
        $this->contact_no          = $this->partner->contact_no;
        $this->email               = $this->partner->email;
        $this->dti_registration_no = $this->partner->dti_registration_no;
    }

    public function render()
    {
        return view('livewire.front-end.partner.my-account.profile.business-information.business-information');
    }
}
