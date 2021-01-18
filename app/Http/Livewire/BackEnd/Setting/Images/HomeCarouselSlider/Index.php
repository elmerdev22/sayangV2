<?php

namespace App\Http\Livewire\BackEnd\Setting\Images\HomeCarouselSlider;


use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use App\Model\ImageSetting;
use UploadUtility;
use Utility;
use Auth;
use DB;

class Index extends Component
{
    
    use WithFileUploads;
    public $photo, $collection, $total;

    public function mount(){
        $this->collection = 'content/home-carousel-slider';
    }

    public function render()
    {
        $data = ImageSetting::orderBy('arrangement','asc')->paginate(10);
        $this->total = $data->total();
        return view('livewire.back-end.setting.images.home-carousel-slider.index', compact('data'));
    }

    public function upload(){
        
        $response  = ['success' => false, 'message' => ''];
        
        $rules = [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $this->validate($rules);

        DB::beginTransaction();

        try{

            $data                 = new ImageSetting();
            $data->arrangement    = $this->total + 1;
            $data->settings_group = 'Home_carousel_slider_banner';
            $data->settings_name  = 'Home Carousel Slider Banner';
            $data->key_token      = Utility::generate_table_token('ImageSetting');
            
            $photo     = $this->photo->getRealPath();
            $file_name = $this->photo->getClientOriginalName();
            
            $collection = $this->collection;
            $data->addMedia($photo)->usingFileName($file_name)->toMediaCollection($collection);    
            
            if($data->save()){
                $response['success'] = true;
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('alert_link', [
                'title'       => 'Successfully Added!',
                'type'           => 'success',
                'message'        => 'Image Successfully Upload!'
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
    
    public function update_arrangement($id, $arrangement){
        $data              = ImageSetting::where('id', $id)->first();
        $data->arrangement = $arrangement;
        if($data->save()){
            $this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Saved!'
            ]);            
        }
    }
    
    public function display($id){
        $data             = ImageSetting::where('id', $id)->first();
        $data->is_display = $data->is_display ? false : true;
        $data->save();
        
        $this->emit('notif_alert', [
            'timer'    => 1500,
            'position' => 'center',
            'type'     => 'success',
            'message'  => 'Successfully Saved!'
        ]);    
    }
    
    public function delete($id){
        $collection = $this->collection;
        $data       = ImageSetting::where('id', $id)->first();
        $data->clearMediaCollection($collection);
        
        if($data->delete()){
            $this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Deleted!'
            ]);            
        }
    }
}
