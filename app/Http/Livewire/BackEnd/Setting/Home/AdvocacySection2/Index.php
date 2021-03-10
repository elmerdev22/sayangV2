<?php

namespace App\Http\Livewire\BackEnd\Setting\Home\AdvocacySection2;

use Livewire\Component;
use App\Model\ImageSetting;

class Index extends Component
{
    public $header, $sub_header;

    public function data(){
        return ImageSetting::where('settings_group', 'advocacy_section_2')->where('settings_key','title_1')->first();
    }

    public function mount(){
        $data             = $this->data();
        $this->header     = $data->settings_name;
        $this->sub_header = $data->description;
    }

    public function render()
    {
        return view('livewire.back-end.setting.home.advocacy-section2.index');
    }

    public function save(){
        $data                = $this->data();
        $data->settings_name = $this->header;
        $data->description   = $this->sub_header;
        if($data->save()){
            $this->emit('alert', [
                'title'   => 'Successfully Saved!',
                'type'    => 'success',
                'message' => 'Successfully Saved!'
            ]);
        }
        else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while Saving'
            ]);
        }
    }
}
