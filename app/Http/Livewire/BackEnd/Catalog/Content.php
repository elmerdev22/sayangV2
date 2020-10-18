<?php

namespace App\Http\Livewire\BackEnd\Catalog;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\Component;
use App\Model\Category;
use App\Model\SubCategory;
use Utility;
class Content extends Component
{
    use WithPagination;
	protected $listeners = ['category-content' => '$refresh'];
	public $search,$name;
    public function render()
    {
    	$data = Category::with('sub_category')
    			->orderBy('name','asc')
				->where('name', 'like', '%'.$this->search.'%')
				->paginate(10);
        return view('livewire.back-end.catalog.content', compact('data'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function add($id){
    	$this->validate([
            'name' => ['required',
            Rule::unique('sub_categories')->where(function ($query) use ($id) {
                return $query->where('category_id', $id);
            })]
        ]);

        $subcategory              = new SubCategory();
        $subcategory->category_id = $id;
        $subcategory->name        = $this->name;
        $subcategory->key_token   = Utility::generate_table_token('SubCategory');
        $subcategory->slug        = SlugService::createSlug(SubCategory::class, 'slug', $this->name);
        if($subcategory->save()){
        	$this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'top-right',
                'type'     => 'success',
                'message'  => 'Successfully Added!'
            ]);
        	$this->name = '';
        }
    }
}
