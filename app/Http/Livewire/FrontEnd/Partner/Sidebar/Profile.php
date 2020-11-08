<?php

namespace App\Http\Livewire\FrontEnd\Partner\Sidebar;

use Livewire\Component;
use Utility;
use UploadUtility;

class Profile extends Component
{
    public $photo, $account;
    protected $listeners = ['updateProfile' => '$refresh'];

    public function render()
    {
        $this->account = Utility::auth_user_account();
        $this->photo   = UploadUtility::account_photo($this->account->key_token , 'profile-picture', 'profile');
    
        return view('livewire.front-end.partner.sidebar.profile');
    }
}
