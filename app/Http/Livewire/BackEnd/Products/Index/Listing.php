<?php

namespace App\Http\Livewire\BackEnd\Products\Index;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Product;
use App\Model\ProductPost;
use DB;
use Utility;
use QueryUtility;
use Session;

class Listing extends Component
{
    use WithPagination;

    public $search = '', $show_entries=10, $sort = [], $sort_type='desc';
	public $partner, $status, $date_from, $date_to, $reset_filter = false;

    public function mount(){
        $this->sort = ['product_posts.date_start'];
    }

    public function data(){
        $filter = [];
		$filter['select'] = [
			'products.name as product_name', 
			'products.slug as product_slug', 
			'product_posts.*',
        ];
		
		if($this->search){
			$filter['or_where_like'] = $this->search;
		}
		
		if($this->status != null){
			$filter['where']['product_posts.status'] = $this->status;
		}
		
		if($this->partner != null){
			$filter['where']['products.partner_id'] = $this->partner;
		}

		if($this->date_from != null && $this->date_to == null){
			Session::flash('date_to_error','This Date To is Required.');
		}
		if($this->date_from == null && $this->date_to != null){
			Session::flash('date_from_error','This Date From is Required.');
		}
		if($this->date_from != null && $this->date_to != null){
			$filter['date_range'][] = [
				'from'  => $this->date_from,
				'to'    => $this->date_to,
				'field' => 'product_posts.date_start'
			];
		}

		if($this->sort){
			$sort_table = '';
			foreach($this->sort as $key => $value){
				$sort_table .= $value.' '.$this->sort_type.', ';
			}
			$sort_table = substr($sort_table, 0, -2);
			$filter['order_by'] = $sort_table;
		}

		if($this->status != null || $this->partner != null || $this->date_from != null || $this->date_from != null){
			$this->reset_filter = true;
		}
		else{
			$this->reset_filter = false;
		}
		
		return QueryUtility::product_posts($filter)->paginate($this->show_entries);
    }
    
	public function partners(){
		$filter = [];
		$filter['select'] = [
			'partners.*', 
		];
		$filter['where']['partners.status'] = 'done';
		
		return QueryUtility::partners($filter)->get();
	}

    public function updatingSearch(){
		$this->resetPage();
    }
    
    public function render()
    {
        $data     = $this->data();
        $partners = $this->partners();
        return view('livewire.back-end.products.index.listing' , compact('data','partners'));
    }
    
    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}

	public function reset_filter(){
		$this->reset();
	}
}
