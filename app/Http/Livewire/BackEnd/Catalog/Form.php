<?php

namespace App\Http\Livewire\BackEnd\Catalog;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\Category;
use Utility;
use Auth;
use DB;
class Form extends Component
{
    use WithFileUploads;
	public $name,$photo;
    public $is_display = true;

    public function render()
    {
        return view('livewire.back-end.catalog.form');
    }

    public function add(){
        
        $response  = ['success' => false, 'message' => ''];
        
        $rules = [
            'name' => 'required|unique:categories',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $this->validate($rules);

        DB::beginTransaction();

        try{

            $category             = new Category();
            $category->name       = $this->name;
            $category->is_display = $this->is_display;
            $category->key_token  = Utility::generate_table_token('Category');
            $category->slug       = SlugService::createSlug(Category::class, 'slug', $this->name);
            
            $photo     = $this->photo->getRealPath();
            $file_name = $this->photo->getClientOriginalName();
            
            $collection = 'catalog/category-photo';
            $category->addMedia($photo)->usingFileName($file_name)->toMediaCollection($collection);    
            

            if($category->save()){
                $response['success'] = true;
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('category-content');
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
                'message' => 'An error occured while Adding Category'
            ]);
        }
    }
}
