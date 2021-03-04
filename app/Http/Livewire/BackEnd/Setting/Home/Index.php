<?php

namespace App\Http\Livewire\BackEnd\Setting\Home;

use Livewire\Component;
use App\Model\DescriptionSetting;

class Index extends Component
{
    public $header, $sub_header;
    
    public function mount(){
        foreach($this->text_data() as $row){
            if($row->settings_key == 'header'){
                $this->header = $row->settings_value;
            }
            else if($row->settings_key == 'sub_header'){
                $this->sub_header = $row->settings_value;
            }
        }
        
    }

    public function text_data(){
        return DescriptionSetting::where('settings_group','advocacy_section')->get();
    }

    public function card_data(){

    }

    public function render()
    {
        $text_data = $this->text_data();
        $card_data = $this->card_data();
        return view('livewire.back-end.setting.home.index', compact('text_data','card_data'));
    }

    public function save_text_data(){
        foreach($this->text_data() as $row){
            
            $data = DescriptionSetting::where('settings_group','advocacy_section')->where('settings_key', $row->settings_key)->first();
            if($row->settings_key == 'header'){
                $data->settings_value = $this->header;
            }
            else if($row->settings_key == 'sub_header'){
                $data->settings_value = $this->sub_header;
            }
            $data->save();
        }
    }
}
