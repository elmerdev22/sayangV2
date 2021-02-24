<?php

namespace App\Http\Livewire\FrontEnd\Partner\OrderAndReceipt\OrderPlaced;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Order;
use App\Model\OrderPayment;
use App\Events\CheckOut;
use PaymentUtility;
use UploadUtility;
use QueryUtility;
use Utility;
use DB;

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
			'order_payments.payment_method',
			'order_items.quantity',
			'order_items.price',
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

	public function confirm_order($key_token){
		$order = Order::with(['order_payment', 'billing'])
			->where('key_token', $key_token)
			->firstOrFail();

		$confirm = $this->confirmable([
			'payment_method' => $order->order_payment->payment_method,
			'status'         => $order->status
		]);
		$can_repay   = Utility::order_can_repay($order->id);

		if($confirm['is_payment_confirmable'] && $can_repay){

			DB::beginTransaction();
            $response = ['success' => false];
    
            try{
                $pay_order = PaymentUtility::pay_order($order->id, [], true);
    
                if($pay_order['success']){
                    $pay_order['message'];
                    $pay_order['product_posts'];

                    $response['success'] = true;
                }
    
            }catch(\Exception $e){
    
            }
    
            if($response['success']){
                DB::commit();
                if(isset($pay_order['product_posts'])){
                    if(count($pay_order['product_posts']) > 0){
                        foreach($pay_order['product_posts'] as $key => $product_post){
                            event(new CheckOut($product_post));
                        }
                    }
                }
                $user_account_id = $order->billing->user_account_id;
                Utility::new_notification($user_account_id, null, 'confirmed_cop_request', 'order_updates');
                $this->emit('alert',[
                    'type'    => 'success',
                    'title'   => 'Order Successfully Confirmed',
                    'message' => 'Order No. #'.$order->order_no.' was confirmed.'
				]);
				$this->emit('initialize_order_placed', true);
			}else{
                DB::rollback();
                $this->emit('alert',[
                    'type'  => 'error',
                    'title' => 'An error occured'
                ]);
			}
			
		}else{
			$this->emit('alert', [
				'type'  => 'error',
				'title' => 'Cannot confirm this order'
			]);
		}
	}
}
