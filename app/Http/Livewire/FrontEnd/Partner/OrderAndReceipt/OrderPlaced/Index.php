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
	
	protected $listeners = [
		'initialize_order_placed' => '$refresh'
	];

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
			'order_payments.payment_method'
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
    	$data      = $this->data();
    	$component = $this;
        return view('livewire.front-end.partner.order-and-receipt.order-placed.index', compact('data', 'component'));
    }

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}

	public function confirmable($param){
		$is_payment_confirmable = false;
		$is_cancellable         = false;

        if($param['payment_method'] == 'cash_on_pickup'){
            if($param['status'] == 'order_placed'){
                $is_payment_confirmable = true;
                $is_cancellable         = true;
            }
        }else if($param['status'] == 'order_placed'){
            $is_cancellable = true;
		}
		
		return [
			'is_payment_confirmable' => $is_payment_confirmable,
			'is_cancellable'         => $is_cancellable
		];
	}

	public function cancel_order($key_token){
		$order = Order::with(['order_payment'])
			->where('key_token', $key_token)
			->firstOrFail();

		$confirm = $this->confirmable([
			'payment_method' => $order->order_payment->payment_method,
			'status'         => $order->status
		]);

		if($confirm['is_cancellable']){
			$this->emit('initialize_cancel_order', [
				'order_no' => $order->order_no
			]);
		}else{
			$this->emit('alert', [
				'type'  => 'error',
				'title' => 'Cannot cancel this order'
			]);
		}
	}
}
