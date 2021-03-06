<?php

namespace App\Http\Livewire\BackEnd\OrderAndReceipt\Track;

use Livewire\Component;
use App\Model\Order;
use UploadUtility;
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
                'order_payment.order_payment_payout_item.order_payment_payout.order_payment_payout_batch',
                'billing.philippine_barangay.philippine_city.philippine_province.philippine_region'
            ])
            ->where('order_no', $this->order_no)
            ->firstOrFail();
    }

    public function render(){
        $data        = $this->data();
        $order_total = Utility::order_total($data->id);
        $component   = $this;

        return view('livewire.back-end.order-and-receipt.track.information', compact('data', 'order_total', 'component'));
    }

    public function qr_code($key_token){
		$order = Order::where('key_token', $key_token)->firstOrFail();
		$this->emit('initialize_qr_code', [
			'qr_code'  => $order->qr_code,
			'order_no' => $order->order_no
		]);
	}
}
