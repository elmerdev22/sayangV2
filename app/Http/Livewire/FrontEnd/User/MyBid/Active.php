<?php

namespace App\Http\Livewire\FrontEnd\User\MyBid;

use Livewire\Component;
use App\Model\ProductPost;
use App\Model\Bid;
use Livewire\WithPagination;
use QueryUtility;
use Utility;
use Auth;

class Active extends Component
{
	use WithPagination;
    public $search = '', $show_entries=10, $sort = [], $sort_type='desc';
    public $account;
    
    public function mount(){
		$this->account = Utility::auth_user_account();
		$this->sort    = ['product_posts.date_end'];
    } 
    
    public function data(){
        $filter = [];
		$filter['select'] = [
			'products.name as product_name', 
			'products.slug as product_slug', 
			'product_posts.key_token as product_key_token', 
			'product_posts.date_start', 
			'product_posts.date_end', 
        ];
        
		$filter['where']['bids.user_account_id'] = $this->account->id;
		$filter['where']['product_posts.status'] = 'active';
		$filter['where']['bids.status']          = 'active';
		
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

		return QueryUtility::bids($filter)->groupBy('bids.product_post_id')->paginate($this->show_entries);
    }

    public function updatingSearch(){
		$this->resetPage();
	}
    
    public function render(){
		$data = $this->data();
		// dd($data);
        return view('livewire.front-end.user.my-bid.active', compact('data'));
    }

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
    }
    
}
