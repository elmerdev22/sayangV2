<?php

namespace App\Http\Livewire\FrontEnd\Product\Listing;

use Livewire\Component;
use App\Model\Category;
use App\Model\SubCategory;
class Breadcrumb extends Component
{
    public $sub_category, $category;

    protected $listeners = [
        'set_filter'   => 'set_filter',
        'clear_filter' => 'clear_filter',    
    ];

    public function mount($category = null, $sub_category = null){
        if($category != null){
            $data = Category::where('slug', $category)->first();
            if($data){
                $this->category = ucfirst($data->name);
            }
            else{
                abort(404);
            }
        }
        if($sub_category != null){
            $data = SubCategory::where('slug', $sub_category)->first();
            if($data){
                $this->sub_category = ucfirst($data->name);
            }
            else{
                abort(404);
            }
        }
    }

    public function clear_filter($param){
        $this->reset();

        $url = route('front-end.product.list.index', ['category' => null , 'sub_category' => null]);
        $this->emit('change_url', $url);
    }

    public function set_filter($param){
        $category_slug     = null;
        $sub_category_slug = null;

        if($param['type'] == 'category'){
            if($param['id'] != null){
                $data = Category::where('id', $param['id'])->first();
                if($data){
                    $this->category     = ucfirst($data->name);
                    $this->sub_category = null;

                    $category_slug = $data->slug;
                }
                else{
                    abort(404);
                }
            }
            else{
                $this->reset();
            }
        }
        else{
            $data = SubCategory::where('id', $param['id'])->first();
            if($data){
                $category = Category::where('id', $data->category_id)->first();
                $this->category     = ucfirst($category->name);
                $this->sub_category = ucfirst($data->name);
                
                $category_slug     = $category->slug;
                $sub_category_slug = $data->slug;
            }
            else{
                abort(404);
            }
        }
        
        $url = route('front-end.product.list.index', ['category' => $category_slug , 'sub_category' => $sub_category_slug]);
        $this->emit('change_url', $url);
    }
    
    public function render()
    {
        return view('livewire.front-end.product.listing.breadcrumb');
    }
}
