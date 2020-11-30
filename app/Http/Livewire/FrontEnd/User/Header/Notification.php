<?php

namespace App\Http\Livewire\FrontEnd\User\Header;

use Livewire\Component;
use App\Model\Notification as Notifications;
use App\Model\UserAccount;
use UploadUtility;
use Auth;
use QueryUtility;
class Notification extends Component
{
    public $account, $auth;
    
    protected $listeners = ['updateNotifications' => '$refresh'];

    public function render()
    {   
        $this->auth    = Auth::user();
        $this->account = UserAccount::where('user_id', $this->auth->id)->firstOrFail();

        $data = QueryUtility::notifications($this->account->id);
                
        return view('livewire.front-end.user.header.notification', compact('data'));
    }

    public function click($id){
        $data          = Notifications::where('id', $id)->first();
        $data->is_read = 1;
        $data->save();
    }
}
