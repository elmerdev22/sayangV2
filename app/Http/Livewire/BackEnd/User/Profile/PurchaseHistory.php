<?php

namespace App\Http\Livewire\BackEnd\User\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use Livewire\WithPagination;
use App\Model\Order;
use QueryUtility;
use Utility;

class PurchaseHistory extends Component
{
    use WithPagination;

	public $account;
    public $status, $search = '', $show_entries=10, $sort = [], $sort_type='desc';

	public function mount($key_token){
		$this->account = UserAccount::where('key_token', $key_token)->firstOrFail();
        $this->sort    = ['orders.created_at'];
	}

	public function data(){
		$filter = [];
		$filter['select'] = [
			'orders.*', 
			'partners.name as partner_name'
		];
		$filter['where']['billings.user_account_id'] = $this->account->id;

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

        return view('livewire.back-end.user.profile.purchase-history', compact('data'));
	}

	public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}
}
