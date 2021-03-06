<?php

namespace App\Http\Livewire\FrontEnd\User\MyPurchase\Track;

use Livewire\Component;
use App\Model\Order;
use App\Model\OrderItem;
use Utility;

class Information extends Component
{
    
    public $order_no;

    public function mount($order_no){
        $this->order_no = $order_no;
    }

    public function data(){
        return Order::with([
                'order_bid',
                'order_payment.bank',
                'order_payment.order_payment_log',
                'billing.philippine_barangay.philippine_city.philippine_province.philippine_region',
            ])
            ->where('order_no', $this->order_no)
            ->firstOrFail();
    }

    public function render(){
        $data        = $this->data();

        if($data->status == 'order_placed'){
            if($data->order_bid){
                $can_repay = true;
            }else{
                $can_repay = Utility::order_can_repay($data->id);
            }
        }else{
            $can_repay = false;
        }

        $order_total = Utility::order_total($data->id);
        return view('livewire.front-end.user.my-purchase.track.information', compact('data', 'order_total', 'can_repay'));
    }

    public function qr_code($key_token){
		$order = Order::where('key_token', $key_token)->firstOrFail();
		$this->emit('initialize_qr_code', [
			'qr_code'  => $order->qr_code,
			'order_no' => $order->order_no
		]);
	}
}
