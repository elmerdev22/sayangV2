<?php

namespace App\Http\Livewire\BackEnd\Setting\PrivacyPolicy;


use Livewire\Component;
use App\Model\DescriptionSetting;
use Utility;

class Index extends Component
{
    public $privacy_policy;

    public function mount(){
        $this->privacy_policy = $this->description_settings('privacy_policy');
    }

    public function description_settings($settings_key)
    {
        $data = Utility::description_settings($settings_key);
        return $data ? $data->settings_value : '';
    }

    public function render()
    {
        return view('livewire.back-end.setting.privacy-policy.index');
    }
    
    public function save(){

        $data                 = DescriptionSetting::firstOrNew(['settings_key' => 'privacy_policy']);
        $data->settings_key   = 'privacy_policy';
        $data->settings_name  = 'Privacy Policy';
        $data->settings_value = $this->privacy_policy;
        if($data->save()){
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully Saved',
                'message'           => 'Privacy Policy Successfully saved!. <br><br>',
                'timer'             => 1000,
                'showConfirmButton' => false
            ]);
        }
    }
}