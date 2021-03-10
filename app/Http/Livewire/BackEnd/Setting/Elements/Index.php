<?php

namespace App\Http\Livewire\BackEnd\Setting\Elements;

use Livewire\Component;
use App\Model\Setting;

class Index extends Component
{
    public $settings_name, $settings_id, $settings_value;

    public function render()
    {
        $data = Setting::where('settings_group','elements')->get();
        return view('livewire.back-end.setting.elements.index', compact('data'));
    }
    
    public function edit($settings_id){
        $data                 = Setting::where('id', $settings_id)->first();
        $this->settings_id    = $settings_id;
        $this->settings_name  = $data->settings_name;
        $this->settings_value = $data->settings_value;
    }

    public function save(){
        
        $this->validate([
            'settings_value' => 'required|numeric',
        ]);

        $data                 = Setting::where('id', $this->settings_id)->first();
        $data->settings_value = $this->settings_value;
        if($data->save()){
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully Updated',
                'message'           => ''.$this->settings_name.' Settings Successfully Updated!. <br><br>',
                'timer'             => 2000,
                'showConfirmButton' => false
            ]);
        }
    }
}
