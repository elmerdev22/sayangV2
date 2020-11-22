<?php

namespace App\Http\Livewire\BackEnd\Setting\Notifications;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\EmailNotificationSetting;

class Email extends Component
{
    use WithPagination;
    public $notification_name, $selected_id, $subject, $message;
    
    public function render()
    {
        $data = EmailNotificationSetting::orderBy('settings_name', 'asc')->paginate(8);
        return view('livewire.back-end.setting.notifications.email', compact('data'));
    }

    public function edit($id){
        $data                    = EmailNotificationSetting::find($id);
        $this->selected_id       = $id;
        $this->notification_name = $data->settings_name;
        $this->subject           = $data->subject;
        $this->message           = $data->message;
    }

    public function save(){
        
        $this->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data          = EmailNotificationSetting::find($this->selected_id);
        $data->subject = $this->subject;
        $data->message = $this->message;
        if($data->save()){
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully updated!',
                'message'           => ''.$this->notification_name.' Successfully updated!. <br><br>',
                'timer'             => 1500,
                'showConfirmButton' => false
            ]);
        }

    }
}
