<?php

namespace App\Http\Livewire\FrontEnd\Product\Listing;

use Livewire\Component;
use App\Model\Category;
use App\Model\SubCategory;
use QueryUtility;

class SearchFilter extends Component
{

    public $search, $selected_category_id;

    public function mount($search){
        $this->search = $search;
    }

    public function categories(){
        return Category::with(['sub_categories', 'sub_categories.product_sub_categories'])
            ->orderBy('name', 'asc')
            ->get();
    }

    public function render(){
        $categories = $this->categories();
        
        return view('livewire.front-end.product.listing.search-filter', compact('categories'));
    }

    public function set_price_range($price_min, $price_max){
        if($price_min == '' || $price_max == '' || $price_min == 'Nan' || $price_max == 'Nan'){
            $this->emit('alert',[
                'type'  => 'error',
                'title' => 'Please input price range'
            ]);
        }
        if($price_min > $price_max){
            $this->emit('alert',[
                'type'  => 'error',
                'title' => 'Invalid price range input'
            ]);
        }else{
            $this->emit('set_filter',[
                'type'      => 'price_range',
                'price_min' => $price_min,
                'price_max' => $price_max
            ]);
        }
    }

    public function set_filter($id , $type = 'category'){

        $this->emit('set_filter', [
            'type' => $type,
            'id'   => $id,
        ]);
        
        if($type == 'category'){
            $this->selected_category_id = $id;
        }
        else{
            $this->selected_sub_category_id = $id;
        }

    }

    public function clear_filter(){
        $this->emit('clear_filter', true);
    }

    public function product_count($id, $type = 'category'){
        
        $filter = [];
        $filter['where']['product_posts.status'] = 'active';
        
        if($type == 'category'){
            if($id != null){
                $filter['where']['products.category_id'] = $id;
            }
        }
        else{
            if($id != null){
                $filter['where']['product_sub_categories.sub_category_id'] = $id;
            }
        }
        
        $filter['available_quantity']            = true;
        return QueryUtility::product_posts($filter)->count();
    }
}
