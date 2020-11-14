<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\Activities\Past;


use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Product;
use App\Model\ProductPost;
use DB;
use Utility;
use UploadUtility;
use QueryUtility;

class Index extends Component
{
    use WithPagination;

    public $search = '', $show_entries=10, $sort = [], $sort_type='desc';
    public $partner;

    public function mount(){
        $this->partner = Utility::auth_partner();
        $this->sort    = ['products.created_at'];
    }

    public function data(){
        $filter = [];
		$filter['select'] = [
			'products.name as product_name', 
			'products.slug as product_slug', 
			'product_posts.*',
        ];
        
		$filter['where']['products.partner_id']  = $this->partner->id;
		$filter['where']['product_posts.status'] = 'done';
		
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

		return QueryUtility::product_posts($filter)->paginate($this->show_entries);
    }
    
    public function updatingSearch(){
		$this->resetPage();
    }
    
    public function render()
    {
        $data = $this->data();
        return view('livewire.front-end.partner.my-products.activities.past.index' , compact('data'));
    }
    
    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
    }
}