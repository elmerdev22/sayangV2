<?php

namespace App\Http\Livewire\FrontEnd\Partner\Header;

use Livewire\Component;
use App\Model\Notification as Notifications;
use App\Model\UserAccount;
use UploadUtility;
use Auth;
use QueryUtility;

class Notification extends Component
{
    protected $listeners = ['updateNotificationsPartner' => 'mount'];

    public function mount(){
        $this->auth    = Auth::user();
        $this->account = UserAccount::where('user_id', $this->auth->id)->firstOrFail();
    }

    public function render()
    {
        $data = QueryUtility::notifications($this->account->id);

        return view('livewire.front-end.partner.header.notification', compact('data'));
    }
}
