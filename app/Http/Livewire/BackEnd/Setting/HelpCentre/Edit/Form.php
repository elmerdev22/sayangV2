<?php

namespace App\Http\Livewire\BackEnd\Setting\HelpCentre\Edit;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;
use App\Model\HelpCentre;
use UploadUtility;
use Utility;
use Auth;
use DB;

class Form extends Component
{
    use WithFileUploads;
	public $name, $photo, $photo_url, $arrangement, $help_centre_id;
    public $is_display;

    public function mount($help_centre_id){
        $this->help_centre_id = $help_centre_id;
        
        $data              = HelpCentre::find($help_centre_id);
        $this->name        = $data->topic;
        $this->arrangement = $data->arrangement;
        $this->is_display  = $data->is_display;
    }
    
    public function render()
    {
        $this->photo_url = UploadUtility::help_centre_photos($this->help_centre_id);

        return view('livewire.back-end.setting.help-centre.edit.form');
    }

    public function update(){
        $response  = ['success' => false, 'message' => ''];

        $rules = [
            'name'        => 'required',
            'arrangement' => 'required',
        ];

        if($this->photo){

            $rules = [
                'photo'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }

        $this->validate($rules);

        DB::beginTransaction();

        try{

            $data              = HelpCentre::find($this->help_centre_id);;
            $data->topic       = $this->name;
            $data->arrangement = $this->arrangement;
            $data->is_display  = $this->is_display;
            $data->slug        = SlugService::createSlug(HelpCentre::class, 'slug', $this->name);

            if($this->photo){

                $photo     = $this->photo->getRealPath();
                $file_name = $this->photo->getClientOriginalName();
                
                $collection = 'help-centre';
                $data->clearMediaCollection($collection);
                $data->addMedia($photo)->usingFileName($file_name)->toMediaCollection($collection);    
                
            }
            
            if($data->save()){
                $response['success'] = true;
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->photo = '';
        	$this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Updated!'
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while Updating Help Centre'
            ]);
        }
    }
}
