<?php

namespace App\Http\Livewire\BackEnd\Partner\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;
use Livewire\WithPagination;
use App\Model\Order;
use QueryUtility;
use Utility;

class PurchaseHistory extends Component
{
	use WithPagination;
	public $account, $partner;
	public $status, $search = '', $show_entries=10, $sort = [], $sort_type='desc';
    
    public function mount($key_token){
		$this->account = UserAccount::where('key_token', $key_token)->firstOrFail();
		$this->partner = Partner::where('user_account_id', $this->account->id)->first();
        $this->sort    = ['orders.created_at'];
	}
	
	public function data(){
		$filter = [];
		$filter['select'] = [
			'orders.*', 
			'user_accounts.first_name as user_account_first_name',
			'user_accounts.last_name as user_account_last_name'
		];

		if(!empty($this->partner)){
			$filter['where']['orders.partner_id'] = $this->partner->id;
		}else{
			$filter['where']['orders.partner_id'] = 'no_data';
		}

		if($this->status != null){
			$filter['where']['orders.status'] = $this->status;
			
			if($this->status == 'order_placed'){
				$filter['where']['order_payments.payment_method'] = 'cash_on_pickup';
			}
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
		
		return view('livewire.back-end.partner.profile.purchase-history', compact('data'));
	}
	
	public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}
}
