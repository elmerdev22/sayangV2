<?php

namespace App\Http\Livewire\BackEnd\Setting\Notifications;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\WebNotificationSetting;
class Web extends Component
{
    use WithPagination;
    public $notification_name, $selected_id, $title, $message;
    
    public function render()
    {
        $data = WebNotificationSetting::orderBy('settings_name', 'asc')->paginate(8);
        return view('livewire.back-end.setting.notifications.web', compact('data'));
    }

    public function edit($id){
        $data                    = WebNotificationSetting::find($id);
        $this->selected_id       = $id;
        $this->notification_name = $data->settings_name;
        $this->title             = $data->title;
        $this->message           = $data->message;
    }

    public function save(){
        
        $this->validate([
            'title'   => 'required',
            'message' => 'required',
        ]);

        $data          = WebNotificationSetting::find($this->selected_id);
        $data->title = $this->title;
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
