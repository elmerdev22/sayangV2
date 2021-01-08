<?php

namespace App\Http\Livewire\FrontEnd\Product\Listing;

use Livewire\Component;
use App\Model\Category;
use App\Model\SubCategory;

class SearchFilter extends Component
{

    public $search;

    public function mount($search){
        $this->search = $search;
    }

    public function categories(){
        return Category::with(['sub_categories', 'sub_categories.product_sub_categories'])
            ->where('is_display', true)
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

    public function set_category($categories, $sub_categories){
        $category_ids     = [];
        $sub_category_ids = [];

        foreach($categories as $key_token){
            $category = Category::where('key_token', $key_token)->first();
            if($category){
                $category_ids[] = $category->id;
            }
        }

        foreach($sub_categories as $key_token){
            $sub_category = SubCategory::where('key_token', $key_token)->first();
            if($sub_category){
                $sub_category_ids[] = $sub_category->id;
            }
        }

        $this->emit('set_filter', [
            'type'           => 'category',
            'categories'     => $category_ids,
            'sub_categories' => $sub_category_ids
        ]);
    }

    public function set_search($keyword){
        $this->emit('set_filter', [
            'type'     => 'search',
            'key_word' => $keyword
        ]);
    }

    public function clear_filter(){
        $this->emit('clear_filter', true);
    }
}
