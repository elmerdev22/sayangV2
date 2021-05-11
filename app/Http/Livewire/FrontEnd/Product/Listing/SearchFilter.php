<?php

namespace App\Http\Livewire\FrontEnd\Product\Listing;

use Livewire\Component;
use App\Model\Product;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\PhilippineRegion;
use App\Model\PhilippineCity;
use App\Model\PhilippineProvince;
use QueryUtility;
use Session;

class SearchFilter extends Component
{

    public $search, $selected_category_id, $partner_id;
    public $region, $province, $city, $barangay;

    public function mount($search, $partner_id = null){
        $this->search     = $search;
        $this->partner_id = $partner_id;
    }

    public function categories(){
        $data = Category::with(['sub_categories', 'sub_categories.product_sub_categories'])->orderBy('name', 'asc');
        if($this->partner_id != null){
            $partner_category_ids = Product::where('partner_id', $this->partner_id)->pluck('category_id');
            $data->whereIn('id', $partner_category_ids);
        }
        
        return $data->get();
    }

    public function render(){
        $categories = $this->categories();
        $regions    = $this->regions();
        $provinces  = $this->provinces($this->region);
        $cities     = $this->cities($this->province);
        return view('livewire.front-end.product.listing.search-filter', compact('categories','regions', 'provinces', 'cities'));
    }

    public function set_price_range($min_price, $max_price){
        
        $this->emit('set_price_range', [
            'min_price' => $min_price,
            'max_price' => $max_price,
        ]);
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

        if($this->partner_id != null){
            
            $filter['where']['products.partner_id'] = $this->partner_id;

            $partner_category_ids = Product::where('partner_id', $this->partner_id)->pluck('category_id');
            $filter['where_in'][]             = [
                'field'  => 'products.category_id',
                'values' => $partner_category_ids
            ];
        }
        
        $filter['available_quantity']            = true;
        return QueryUtility::product_posts($filter)->count();
    }

    public function cities($province_id){
        if($province_id){
            return PhilippineCity::where('province_id', $province_id)->orderBy('name', 'asc')->get();
        }else{
            return [];
        }
    }

    public function provinces($region_id){
        if($region_id){
            return PhilippineProvince::where('region_id', $region_id)->orderBy('name', 'asc')->get();
        }else{
            return [];
        }
    }

    public function regions(){
        return PhilippineRegion::orderBy('name', 'asc')->get();
    }
}
