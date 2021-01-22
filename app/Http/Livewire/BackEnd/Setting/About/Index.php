<?php

namespace App\Http\Livewire\BackEnd\Setting\About;

use Livewire\Component;
use App\Model\DescriptionSetting;
use Utility;

class Index extends Component
{
    public $about, $for_users;

    public function mount(){
        $this->about = $this->description_settings('about_us');
    }

    public function description_settings($settings_key)
    {
        $data = Utility::description_settings($settings_key);
        return $data ? $data->settings_value : '';
    }

    public function render()
    {
        return view('livewire.back-end.setting.about.index');
    }
    
    public function save(){

        $data                 = DescriptionSetting::firstOrNew(['settings_key' => 'about_us']);
        $data->settings_key   = 'about_us';
        $data->settings_name  = 'About Us';
        $data->settings_value = $this->about;
        if($data->save()){
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully Saved',
                'message'           => 'About Us Successfully saved!. <br><br>',
                'timer'             => 1000,
                'showConfirmButton' => false
            ]);
        }
    }
}
