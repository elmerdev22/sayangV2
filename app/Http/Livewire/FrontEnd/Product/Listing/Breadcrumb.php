<?php

namespace App\Http\Livewire\FrontEnd\Product\Listing;

use Livewire\Component;
use App\Model\Category;
use App\Model\SubCategory;
class Breadcrumb extends Component
{
    public $sub_category, $category;
    public $category_slug, $sub_category_slug;

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
    }

    public function set_filter($param){

        if($param['type'] == 'category'){
            if($param['id'] != null){
                $data               = Category::where('id', $param['id'])->first();
                if($data){
                    $this->category     = ucfirst($data->name);
                    $this->sub_category = null;
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
            $data               = SubCategory::where('id', $param['id'])->first();
            if($data){
                $this->sub_category = ucfirst($data->name);
            }
            else{
                abort(404);
            }
        }

    }
    
    public function render()
    {
        return view('livewire.front-end.product.listing.breadcrumb');
    }
}
