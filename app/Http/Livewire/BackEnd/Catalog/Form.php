<?php

namespace App\Http\Livewire\BackEnd\Catalog;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;
use App\Model\Category;
use Utility;
class Form extends Component
{
	public $name;

    public function render()
    {
        return view('livewire.back-end.catalog.form');
    }

    public function add(){
    	$this->validate([
            'name' => 'required|unique:categories',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->key_token = Utility::generate_table_token('Category');
        $category->slug = SlugService::createSlug(Category::class, 'slug', $this->name);
        if($category->save()){
        	$this->emit('category-content');
        	$this->emit('alert', ['type' => 'success', 'message' => ''.ucwords($this->name).' Successfully Added!']);
        	$this->name = '';
        }
    }
}
