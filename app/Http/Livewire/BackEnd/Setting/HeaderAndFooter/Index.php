<?php

namespace App\Http\Livewire\BackEnd\Setting\HeaderAndFooter;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use App\Model\Setting;
use UploadUtility;
use Utility;
use DB;
class Index extends Component
{
    use WithFileUploads;
    public $settings_group;
    public $logo, $current_logo, $icon, $current_icon;
    public $app_name, $home_title;

    public function mount(){
        $this->settings_group = 'content';

        $this->app_name   = Utility::settings('app_name');
        $this->home_title = Utility::settings('home_title');

    }

    public function render()
    {
        $this->current_logo = UploadUtility::content_photo('logo', false);
        $this->current_icon = UploadUtility::content_photo('icon', false);
        return view('livewire.back-end.setting.header-and-footer.index');
    }

    public function save_content($settings_key){
        $data = Setting::where('settings_key', $settings_key)->first();
        $value = '';
        
        if($settings_key == 'app_name'){
            $value = $this->app_name;
        }
        else if($settings_key == 'home_title'){
            $value = $this->home_title;
        }

        $data->settings_value = $value;

        if($data->save()){
            $this->emit('notif_alert', [
                'timer'          => 5000,
                'confirm_button' => true,
                'position'       => 'center',
                'type'           => 'success',
                'message'        => ''.$data->settings_name.' Successfully Updated!'
            ]);
        }
        else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while Updating data'
            ]);
        }
    }

    public function cancel($type){
        $this->reset([$type]);
    }

    public function update($type){
        
        $response  = ['success' => false, 'message' => ''];
        
        $rules = [
            $type => 'required|mimes:jpeg,png,jpg,gif,svg,ico,icon|max:2048',
        ];

        $this->validate($rules);

        DB::beginTransaction();

        try{

            if($type == 'logo'){
                $response['success'] = $this->save_logo();
            }
            else{
                $response['success'] = $this->save_icon();
            }
        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('notif_alert', [
                'timer'          => 5000,
                'confirm_button' => true,
                'position'       => 'center',
                'type'           => 'success',
                'message'        => ''.ucfirst($type).' Successfully Updated!'
            ]);
            $this->reset([$type]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while Updating data'
            ]);
        }
    }

    public function save_icon(){
        
        $data                 = Setting::firstOrNew(['settings_group' => $this->settings_group ,'settings_key' => 'icon']);
        $data->settings_group = $this->settings_group;
        $data->settings_name  = ucfirst('icon');
        $data->settings_key   = 'icon';
        
        $type      = $this->icon->getRealPath();
        $file_name = $this->icon->getClientOriginalName();
        
        $collection = 'content/icon';
        $data->clearMediaCollection($collection);
        $data->addMedia($type)->usingFileName($file_name)->toMediaCollection($collection);    
        
        if($data->save()){
            return true;
        }
        else{
            return false;
        }
    }

    public function save_logo(){
        
        $data                 = Setting::firstOrNew(['settings_group' => $this->settings_group ,'settings_key' => 'logo']);
        $data->settings_group = $this->settings_group;
        $data->settings_name  = ucfirst('logo');
        $data->settings_key   = 'logo';
        
        $type      = $this->logo->getRealPath();
        $file_name = $this->logo->getClientOriginalName();
        
        $collection = 'content/logo';
        $data->clearMediaCollection($collection);
        $data->addMedia($type)->usingFileName($file_name)->toMediaCollection($collection);    
        
        if($data->save()){
            return true;
        }
        else{
            return false;
        }
    }
}
