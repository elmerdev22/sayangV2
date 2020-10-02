<?php

namespace App\Http\Livewire\BackEnd\Catalog;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\Component;
use App\Model\Category;
use App\Model\Tag;
use Utility;
class Content extends Component
{
    use WithPagination;
	protected $listeners = ['category-content' => '$refresh'];
	public $search,$name;

    public function render()
    {
    	$data = Category::with('tags')
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
            Rule::unique('tags')->where(function ($query) use ($id) {
                return $query->where('category_id', $id);
            })]
        ]);

        $tag              = new Tag();
        $tag->category_id = $id;
        $tag->name        = $this->name;
        $tag->key_token   = Utility::generate_table_token('Tag');
        $tag->slug        = SlugService::createSlug(Tag::class, 'slug', $this->name);
        if($tag->save()){
        	$this->emit('toast_alert', ['type' => 'success', 'message' => ''.ucwords($this->name).' Successfully Added!']);
        	$this->name = '';
        }
    }
}
