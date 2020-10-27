<?php

namespace App\Http\Livewire\BackEnd\Catalog;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\Category;
use UploadUtility;
use Auth;
use DB;
class Edit extends Component
{
    use WithFileUploads;
	public $name,$photo,$photo_url,$key_token,$category_select;
    public $is_display = true;

    public function mount($key_token)
    {
        
        $category              = Category::where('key_token', $key_token)->first();
        $this->key_token       = $key_token;
        $this->name            = $category->name;
        $this->category_select = $category->name;
        $this->is_display      = $category->is_display ? true : false;
        
    }
    public function render()
    {
        $this->photo_url = UploadUtility::category_photo($this->key_token);
        return view('livewire.back-end.catalog.edit');
    }

    public function update(){
        $response  = ['success' => false, 'message' => ''];

        $category = Category::where('key_token', $this->key_token)->first();

        $rules = [];

        if($this->name != $category->name){
            $rules['name'] = 'required|unique:categories';
        }

        $this->validate($rules);

        DB::beginTransaction();

        try{

            $category->name       = $this->name;
            $category->is_display = $this->is_display;
            $category->slug       = SlugService::createSlug(Category::class, 'slug', $this->name);

            if($this->photo){

                $photo      = $this->photo->getRealPath();
                $file_name  = $this->photo->getClientOriginalName();
                
                $collection = 'catalog/category-photo';
                $category   = Category::where('key_token', $this->key_token)->first();
                $category->clearMediaCollection($collection);
                $category->addMedia($photo)->usingFileName($file_name)->toMediaCollection($collection);    
                
            }
            
            if($category->save()){
                $this->category_select = $category->name;
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
                'position' => 'top-right',
                'type'     => 'success',
                'message'  => 'Successfully Added!'
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while Adding Category'
            ]);
        }
    }
}
