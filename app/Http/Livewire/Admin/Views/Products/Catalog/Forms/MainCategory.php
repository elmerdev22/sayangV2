<?php

namespace App\Http\Livewire\Admin\Views\Products\Catalog\Forms;

use Livewire\Component;
use App\Model\Category;
class MainCategory extends Component
{
    public $name;
    protected $rules = [
        'name' => 'required|unique:categories',
    ];
    protected $message = [
        'name.required' => 'Main category field is required.',
    ];
   
    public function add_main_category(){
        $this->validate($this->rules,$this->message);
        $main_category = New Category();
        $main_category->name = $this->name;
        if($main_category->save()){
            $this->reset();
            $this->emit('main_category');
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Main Category Successfully Saved.'
            ]);
        }
    }

    public function render()
    {
        $main_categories = Category::where('parent_category_id','=',NULL)->get();
        return view('livewire.admin.views.products.catalog.forms.main-category',compact('main_categories'));
    }
}
