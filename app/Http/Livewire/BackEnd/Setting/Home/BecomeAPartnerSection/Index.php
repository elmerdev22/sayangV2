<?php

namespace App\Http\Livewire\BackEnd\Setting\Home\BecomeAPartnerSection;

use Livewire\Component;
use App\Model\ImageSetting;
use Livewire\WithFileUploads;
use UploadUtility;
class Index extends Component
{
    use WithFileUploads;

    public $header, $sub_header, $photo, $photo_url;

    public function data(){
        return ImageSetting::where('settings_group', 'become_a_partner_section')->where('settings_key','become_a_partner')->first();
    }

    public function mount(){
        $data             = $this->data();
        $this->header     = $data->settings_name;
        $this->sub_header = $data->description;
        $this->photo_url  = UploadUtility::image_setting($data->id, 'become-a-partner');
    }

    public function render()
    {
        return view('livewire.back-end.setting.home.become-a-partner-section.index');
    }

    public function save(){
        
        $rules = [
            'header'     => 'required',
            'sub_header' => 'required',
        ];

        $this->validate($rules);

        $data = $this->data();
        
        if($this->photo){
            $photo      = $this->photo->getRealPath();
            $file_name  = $this->photo->getClientOriginalName();
            
            $collection = 'content/become-a-partner';
            $data->clearMediaCollection($collection);
            $data->addMedia($photo)->usingFileName($file_name)->toMediaCollection($collection);    
        }

        $data->settings_name = $this->header;
        $data->description   = $this->sub_header;
        if($data->save()){
            $this->reset(['photo']);
            $this->mount();
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