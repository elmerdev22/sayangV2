<?php

namespace App\Http\Livewire\FrontEnd\User\MyBid;

use Livewire\Component;
use App\Model\ProductPost;
use App\Model\Bid;
use Livewire\WithPagination;
use SettingsUtility;
use QueryUtility;
use Utility;
use Auth;
class Win extends Component
{
    use WithPagination;
    public $search = '', $show_entries=10, $sort = [], $sort_type='desc', $winning_bid_expiration;
    public $account;
    
    public function mount(){
		$this->account                = Utility::auth_user_account();
		$this->sort                   = ['product_posts.date_end'];
		$this->winning_bid_expiration = SettingsUtility::settings_value('winning_bid_expiration');
    } 
    
    public function data(){
        $filter = [];
		$filter['select'] = [
			'products.name as product_name', 
			'products.slug as product_slug', 
			'product_posts.key_token as product_key_token', 
			'product_posts.date_start', 
			'product_posts.date_end', 
			'bids.key_token as bid_key_token', 
			'order_bids.id as order_bid_id', 
			'orders.order_no', 
			'order_payments.payment_method',
			'order_payments.status as order_payment_status'
        ];
        
		$filter['where']['bids.user_account_id'] = $this->account->id;
		$filter['where']['product_posts.status'] = 'done';
		$filter['where']['bids.status']          = 'win';
		
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
		$data      = $this->data();
		$component = $this;

		return view('livewire.front-end.user.my-bid.win', compact('data', 'component'));
	}

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}
	
	public function is_expired($date_ended){
		$end     = strtotime($date_ended.'+'.$this->winning_bid_expiration.' hours');
		$current = time();
		if($end >= $current){
			return false;
		}else{
			return true;
		}
	}

	public function pay_now($key_token){
		$response = ['success' => false, 'message' => 'Unable to process your request'];
		
		try{

			$filter = [];
			$filter['select'] = [
				'bids.key_token', 
				'product_posts.date_end', 
				'order_bids.id as order_bid_id', 
			];
			$filter['where']['bids.key_token']      = $key_token;
			$filter['where']['bids.status']         = 'win';
			$filter['where']['bids.winning_status'] = 'not_paid';
			
			$bid = QueryUtility::bids($filter)->first();
			
			if($bid){
				if(!$this->is_expired($bid->date_end)){
					if(!$bid->order_bid_id){
						$response['success'] = true;
					}
				}
			}

		}catch(\Exception $e){
			$response['success'] = false;
			$response['message'] = 'An error occured while processing the payment.';
		}

		if($response['success']){
			$this->emit('bid_pay_now', ['bid_key_token' => $key_token]);
		}else{
			$this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => $response['message']
            ]);
		}
	}
}
