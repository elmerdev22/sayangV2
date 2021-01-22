<?php

namespace App\Http\Livewire\BackEnd\Setting\TermsAndConditions;

use Livewire\Component;
use App\Model\DescriptionSetting;
use Utility;

class Index extends Component
{
    public $for_partners, $for_users;

    public function mount(){
        $this->for_partners = $this->description_settings('terms_and_conditions_partners');
        $this->for_users    = $this->description_settings('terms_and_conditions_users');
    }

    public function description_settings($settings_key)
    {
        $data = Utility::description_settings($settings_key);
        return $data ? $data->settings_value : '';
    }

    public function render()
    {
        return view('livewire.back-end.setting.terms-and-conditions.index');
    }
    
    public function save_for_partners(){

        $data                 = DescriptionSetting::firstOrNew(['settings_key' => 'terms_and_conditions_partners']);
        $data->settings_key   = 'terms_and_conditions_partners';
        $data->settings_name  = 'Terms and Conditions for Partners';
        $data->settings_value = $this->for_partners;
        if($data->save()){
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully Saved',
                'message'           => 'Terms and Conditions for Partners Successfully saved!. <br><br>',
                'timer'             => 1000,
                'showConfirmButton' => false
            ]);
        }
    }
    public function save_for_users(){
        
        $data                 = DescriptionSetting::firstOrNew(['settings_key' => 'terms_and_conditions_users']);
        $data->settings_key   = 'terms_and_conditions_users';
        $data->settings_name  = 'Terms and Conditions for Users';
        $data->settings_value = $this->for_users;
        if($data->save()){
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully Saved',
                'message'           => 'Terms and Conditions for Users Successfully saved!. <br><br>',
                'timer'             => 1000,
                'showConfirmButton' => false
            ]);
        }
    }
}
