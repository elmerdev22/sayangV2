<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\BusinessInformation;

use Livewire\Component;
use Utility;
class RepresentativeInformation extends Component
{
    protected $listeners = [
        'initialize_representative_information' => '$refresh'
    ];

    public function render(){
        $partner = Utility::auth_partner();
        $account = Utility::auth_user_account();

        return view('livewire.front-end.partner.my-account.profile.business-information.representative-information', compact('partner', 'account'));
    }
}
