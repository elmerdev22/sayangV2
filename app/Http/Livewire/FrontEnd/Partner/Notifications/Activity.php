<?php

namespace App\Http\Livewire\FrontEnd\Partner\Notifications;

use Livewire\Component;
use App\Model\Notification;
use Livewire\WithPagination;
use App\Model\UserAccount;
use UploadUtility;
use Auth;
use QueryUtility;

class Activity extends Component
{
    use WithPagination;
    public $account, $auth;
    
    public function mount(){
        $this->auth    = Auth::user();
        $this->account = UserAccount::where('user_id', $this->auth->id)->firstOrFail();
    }

    public function render()
    {   
        $data = QueryUtility::notifications($this->account->id, 'activity');
        
        return view('livewire.front-end.partner.notifications.activity', compact('data'));
    }
    
    public function click($id){
        $data          = Notification::where('id', $id)->first();
        $data->is_read = 1;
        $data->save();
        $this->emit('updateNotificationsPartner');
    }

    public function read_all(){

        Notification::where('user_account_id', $this->account->id)->where('notification_type', 'activity')
                    ->update([
                        'is_read' => 1
                    ]);
        $this->emit('updateNotificationsPartner');

    }
}
