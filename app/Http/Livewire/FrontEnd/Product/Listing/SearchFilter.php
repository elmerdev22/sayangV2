<?php

namespace App\Http\Livewire\FrontEnd\Product\Listing;

use Livewire\Component;
use App\Model\Category;
use App\Model\SubCategory;

class SearchFilter extends Component
{

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
        $this->emit('set_filter',[
            'type'      => 'price_range',
            'price_min' => $price_min,
            'price_max' => $price_max
        ]);
    }
}
