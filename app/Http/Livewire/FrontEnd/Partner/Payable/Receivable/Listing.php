<?php

namespace App\Http\Livewire\FrontEnd\Partner\Payable\Receivable;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Order;
use Utility;
use Session;
use QueryUtility;

class Listing extends Component
{
    use WithPagination;

    public $partner_id, $status, $search = '', $show_entries=10, $sort = [], $sort_type='desc';
    public $partner, $date_from, $date_to, $reset_filter = false;

    public function mount(){
        $this->sort       = ['orders.date_completed'];
        $partner          = Utility::auth_partner();
        $this->partner_id = $partner->partner_id;
    }

    public function data(){
        $filter = [];
		$filter['select'] = [
			'orders.*', 
			'orders.id as order_id', 
			'order_payments.payment_method', 
			'order_payment_logs.paymongo_payment_id', 
			'order_payments.status as order_payment_status', 
			'user_accounts.first_name as user_account_first_name',
			'user_accounts.last_name as user_account_last_name',
			'partners.name as partner_name',
			'partners.key_token as partners_key_token'
        ];
  
        $filter['where']['order_payment_payouts.id'] = null;
        $filter['where']['orders.status']            = 'completed';
        $filter['where_in'][] = [
            'field'  => 'order_payments.payment_method',
            'values' => ['e_wallet', 'card']
        ];
		
        $filter['where']['partners.id'] = $this->partner_id;
        
		if($this->date_from != null && $this->date_to != null){
			$filter['date_range'][] = [
				'from'  => $this->date_from,
				'to'    => $this->date_to,
				'field' => 'orders.date_completed'
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

        return view('livewire.front-end.partner.payable.receivable.listing', compact('data', 'partners', 'component'));
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
