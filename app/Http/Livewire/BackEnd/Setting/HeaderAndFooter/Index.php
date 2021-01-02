<?php

namespace App\Http\Livewire\BackEnd\Setting\HeaderAndFooter;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use UploadUtility;
use App\Model\Setting;
use DB;
class Index extends Component
{
    use WithFileUploads;
    public $settings_group;
    public $logo, $current_logo, $icon, $current_icon;

    public function mount(){
        $this->settings_group = 'content';
    }

    public function render()
    {
        $this->current_logo = UploadUtility::content_photo('logo');
        $this->current_icon = UploadUtility::content_photo('icon');
        return view('livewire.back-end.setting.header-and-footer.index');
    }

    public function cancel($type){
        $this->reset([$type]);
    }

    public function update($type){
        
        $response  = ['success' => false, 'message' => ''];
        
        $rules = [
            $type => 'required|image|mimes:jpeg,png,jpg,gif,svg,ico|max:2048',
        ];

        $this->validate($rules);

        DB::beginTransaction();

        try{

            $data                 = Setting::firstOrNew(['settings_group' => $this->settings_group ,'settings_key' => $type]);
            $data->settings_group = $this->settings_group;
            $data->settings_name  = ucfirst($type);
            $data->settings_key   = $type;
            
            $type      = $this->$type->getRealPath();
            $file_name = $this->$type->getClientOriginalName();
            
            $collection = 'content/'.$type;
            $data->clearMediaCollection($collection);
            $data->addMedia($$type)->usingFileName($file_name)->toMediaCollection($collection);    
            
            if($data->save()){
                $response['success'] = true;
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
                'message'        => 'Successfully Updated!'
            ]);
            $this->reset([$type]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while Adding data'
            ]);
        }
    }
}
