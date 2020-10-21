<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\Index;

use Livewire\Component;
use Livewire\WithPagination;
use Utility;
use QueryUtility;

class Listing extends Component
{
	use WithPagination;

    public $search = '', $show_entries=10, $sort = [], $sort_type='asc';
    public $partner;

    public function mount(){
        $this->partner = Utility::auth_partner();
        $this->sort    = ['products.created_at'];
    }

    public function data(){
        $filter = [];
		$filter['select'] = [
			'products.*', 
			'products.created_at as date_added', 
			'categories.name as category_name' 
		];
		$filter['where']['products.partner_id'] = $this->partner->id;
		
		if($this->search){
			$filter['or_where_like'] = $this->search;
		}
		
		if($this->sort){
			$sort_table = '';
			foreach($this->sort as $key => $value){
				$sort_table .= $value.' '.$this->sort_type.', ';
			}
			$sort_table = substr($sort_table, 0, -2);
			$filter['order_by'] = $sort_table;
		}

		return QueryUtility::products($filter)->paginate($this->show_entries);
    }

    public function updatingSearch(){
		$this->resetPage();
	}
    
    public function render(){
        $data = $this->data();

        return view('livewire.front-end.partner.my-products.index.listing', compact('data'));
    }

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
    }
}
