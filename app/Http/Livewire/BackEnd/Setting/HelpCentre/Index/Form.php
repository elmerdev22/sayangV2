<?php

namespace App\Http\Livewire\BackEnd\Setting\HelpCentre\Index;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;
use App\Model\HelpCentre;
use Utility;
use Auth;
use DB;

class Form extends Component
{
    protected $listeners = ['help-centre-add' => '$refresh'];
    
    use WithFileUploads;
	public $name,$photo,$arrangement;
    public $is_display = true;

    public function render()
    {
        $this->arrangement = HelpCentre::count() + 1;
        return view('livewire.back-end.setting.help-centre.index.form');
    }

    
    public function add(){
        
        $response  = ['success' => false, 'message' => ''];
        
        $rules = [
            'name'        => 'required',
            'arrangement' => 'required',
            'photo'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $this->validate($rules);

        DB::beginTransaction();

        try{

            $data              = new HelpCentre();
            $data->topic       = $this->name;
            $data->is_display  = $this->is_display;
            $data->arrangement = $this->arrangement;
            $data->slug        = SlugService::createSlug(HelpCentre::class, 'slug', $this->name);
            
            $photo     = $this->photo->getRealPath();
            $file_name = $this->photo->getClientOriginalName();
            
            $collection = 'help-centre';
            $data->addMedia($photo)->usingFileName($file_name)->toMediaCollection($collection);    
            
            if($data->save()){
                $response['success'] = true;
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('help-centre-listing');
                $this->emit('notif_alert', [
                    'timer'          => 5000,
                    'confirm_button' => true,
                    'position'       => 'center',
                    'type'           => 'success',
                    'message'        => 'Successfully Added!'
                ]);
            $this->reset();
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while Adding Help Centre'
            ]);
        }
    }
}
