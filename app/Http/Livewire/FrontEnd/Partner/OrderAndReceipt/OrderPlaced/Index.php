<?php

namespace App\Http\Livewire\FrontEnd\Partner\OrderAndReceipt\OrderPlaced;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Order;
use QueryUtility;
use Utility;

class Index extends Component
{
    use WithPagination;

    public $partner, $status, $search = '', $show_entries=10, $sort = [], $sort_type='desc';
    
    public function mount(){
        $this->partner = Utility::auth_partner();
        $this->sort    = ['orders.created_at'];
    }

    public function data(){
		$filter = [];
		$filter['select'] = [
			'orders.*', 
			'user_accounts.first_name as user_account_first_name',
			'user_accounts.last_name as user_account_last_name',
		];
		$filter['where']['orders.partner_id']             = $this->partner->id;
		$filter['where']['orders.status']                 = 'order_placed';
		$filter['where']['order_payments.payment_method'] = 'cash_on_pickup';

		if($this->status != null){
			$filter['where']['orders.status'] = $this->status;
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

		return QueryUtility::orders($filter)->paginate($this->show_entries);
    }
    
    public function updatingSearch(){
		$this->resetPage();
	}

    public function render(){
    	$data = $this->data();

        return view('livewire.front-end.partner.order-and-receipt.order-placed.index', compact('data'));
    }

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}
}
