<?php

namespace App\Http\Livewire\FrontEnd\User\MyPurchase;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Order;
use QueryUtility;
use Utility;

class Listing extends Component
{
    use WithPagination;
	public $account, $search = '', $show_entries=10, $sort = [], $sort_type='desc';
    
    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->sort    = ['orders.created_at'];
    }

    public function data(){
		$filter = [];
		$filter['select'] = [
			'orders.*', 
			'partners.name as partner_name',
            'order_payments.payment_method'
		];
		$filter['where']['billings.user_account_id'] = $this->account->id;
		$filter['where_in'][] = [
			'field'  => 'orders.status',
			'values' => ['order_placed', 'cancelled', 'to_receive', 'payment_confirmed']
		];

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

        return view('livewire.front-end.user.my-purchase.listing', compact('data'));
    }

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}

}
