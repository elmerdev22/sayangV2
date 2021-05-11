<?php

namespace App\Http\Livewire\BackEnd\Setting\HeaderAndFooter\SocialMedia;

use Livewire\Component;
use App\Model\SocialMediaSetting;

class Index extends Component
{
    public $action, $name, $url, $icon, $selected_id;

    public function data(){
        return SocialMediaSetting::paginate(10);
    }

    public function render(){
        $data = $this->data();
        return view('livewire.back-end.setting.header-and-footer.social-media.index', compact('data'));
    }

    public function save(){
        $this->validate([
            'name' => 'required',
            'url'  => 'required|url',
            'icon' => 'required',
        ]);

        $data       = SocialMediaSetting::firstOrNew(['id' => $this->selected_id]);
        $data->name = $this->name;
        $data->url  = $this->url;
        $data->icon = $this->icon;
        if($data->save()){
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Successfully Saved!'
            ]);
            $this->reset();
        }
    }

    public function edit($id){
        $data              = SocialMediaSetting::whereId($id)->first();
        $this->name        = $data->name;
        $this->icon        = $data->icon;
        $this->url         = $data->url;
        $this->selected_id = $id;

    }

    public function delete($id){
        $data              = SocialMediaSetting::whereId($id)->first();
        if($data->delete()){
            $this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Deleted!'
            ]);    
        }
    }

    public function display($id){
        $data             = SocialMediaSetting::whereId($id)->first();
        $data->status = $data->status ? false : true;
        $data->save();
        
        $this->emit('notif_alert', [
            'timer'    => 1500,
            'position' => 'center',
            'type'     => 'success',
            'message'  => 'Successfully Saved!'
        ]);    
    }

    public function reset_data(){
        $this->reset();
    }
}
