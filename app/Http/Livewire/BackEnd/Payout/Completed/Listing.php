<?php

namespace App\Http\Livewire\BackEnd\Payout\Completed;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Order;
use Utility;
use Session;
use QueryUtility;

class Listing extends Component
{
    use WithPagination;

    public $status, $search = '', $show_entries=10, $sort = [], $sort_type='desc';
    public $partner, $date_from, $date_to, $reset_filter = false;
    
    public function mount(){
        $this->sort    = ['orders.created_at'];
    }

    public function data(){
        $filter = [];
		$filter['select'] = [
			'orders.*', 
			'orders.id as order_id', 
			'order_payments.payment_method', 
			'order_payments.status as order_payment_status', 
			'user_accounts.first_name as user_account_first_name',
			'user_accounts.last_name as user_account_last_name',
			'partners.name as partner_name',
			'partners.key_token as partners_key_token',
			'order_payment_payouts.created_at as payout_date'
        ];
  
        $filter['where']['order_payment_payouts.id'] = null;
        $filter['where']['orders.status']            = 'completed';
        $filter['where_not'][] = [
            'field' => 'order_payment_payouts.id',
            'value' => null
        ];
		
		if($this->partner != null){
			$filter['where']['partners.id'] = $this->partner;
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
				'field' => 'orders.created_at'
			];
		}

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

		if($this->status != null || $this->partner != null || $this->date_from != null || $this->date_from != null){
			$this->reset_filter = true;
		}
		else{
			$this->reset_filter = false;
		}

		return QueryUtility::orders($filter)->paginate($this->show_entries);
    }

    public function updatingSearch(){
		$this->resetPage();
    }

    public function render(){
        $data      = $this->data();
        $partners  = $this->partners();
        $component = $this;

        return view('livewire.back-end.payout.completed.listing', compact('data', 'partners', 'component'));
    }

    public function partners(){
		$filter = [];
		$filter['select'] = [
			'partners.*', 
		];
		$filter['where']['partners.status'] = 'done';
		
		return QueryUtility::partners($filter)->get();
	}

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}

	public function reset_filter(){
		$this->reset();
    }
    
    public function order_total($order_id){
        return Utility::order_total($order_id)['total'];
    }
}
