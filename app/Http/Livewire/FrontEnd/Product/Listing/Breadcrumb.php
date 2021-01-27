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
        'clear_filter' => 'clear_filter'
    ];

    public function set_filter($param){


        if($param['type'] == 'category'){
            if($param['id'] != null){
                $data               = Category::where('id', $param['id'])->first();
                $this->category     = ucfirst($data->name);
                $this->sub_category = null;
            }
            else{
                $this->category     = null;
                $this->sub_category = null;
            }
        }
        else{
            $data               = SubCategory::where('id', $param['id'])->first();
            $this->sub_category = ucfirst($data->name);
        }

    }
    
    public function render()
    {
        return view('livewire.front-end.product.listing.breadcrumb');
    }
}
