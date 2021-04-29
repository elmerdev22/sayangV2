<?php

namespace App\Http\Livewire\BackEnd\Setting\Home\AdvocacySection;

use Livewire\Component;
use App\Model\DescriptionSetting;
use Livewire\WithFileUploads;
use App\Model\ImageSetting;
use UploadUtility;

class Index extends Component
{
    use WithFileUploads;

    public $header, $sub_header;
    public $selected_id, $title, $description, $redirect, $photo, $photo_url;
    
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
        return ImageSetting::where('settings_group','advocacy_section')->get();
    }

    public function edit_card($id){
        $data              = ImageSetting::where('id', $id)->first();
        $this->selected_id = $id;
        $this->title       = $data->settings_name;
        $this->description = $data->description;
        $this->redirect    = $data->redirect;
        $this->photo_url   = UploadUtility::image_setting($id, 'advocacy-section');
        $this->emit('show_modal');
    }

    public function save_card(){
        $rules = [
            'title'       => 'required',
            'description' => 'required|max:220',
        ];

        $this->validate($rules);

        $data                = ImageSetting::where('id', $this->selected_id)->first();
        $data->settings_name = $this->title;
        $data->description   = $this->description;
        $data->redirect      = $this->redirect;

        if($this->photo){

            $photo      = $this->photo->getRealPath();
            $file_name  = $this->photo->getClientOriginalName();
            
            $collection = 'content/advocacy-section';
            $data->clearMediaCollection($collection);
            $data->addMedia($photo)->usingFileName($file_name)->toMediaCollection($collection);    
        }

        if($data->save()){
            $this->reset(['photo']);
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

    public function render()
    {
        $text_data = $this->text_data();
        $card_data = $this->card_data();
        return view('livewire.back-end.setting.home.advocacy-section.index', compact('text_data','card_data'));
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
            $this->emit('alert', [
                'title'   => 'Successfully Saved!',
                'type'    => 'success',
                'message' => 'Successfully Saved!'
            ]);
        }
    }
}
