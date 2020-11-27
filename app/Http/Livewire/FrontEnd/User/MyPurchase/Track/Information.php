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
                'order_payment.bank',
                'order_payment.order_payment_log',
                'billing.philippine_barangay.philippine_city.philippine_province.philippine_region',
            ])
            ->where('order_no', $this->order_no)
            ->firstOrFail();
    }

    public function order_repay($order_id){
        $order_items = OrderItem::with(['product_post'])->where('order_id', $order_id)->get();
        $repay       = true;
        
        foreach($order_items as $row){
            $status = Utility::product_post_status($row->product_post_id);
            if($status == 'active'){
                if($row->product_post->quantity >= $row->quantity){
                    continue;
                }else{
                    $repay = false;
                    break;
                }
            }else{
                $repay = false;
                break;
            }
        }

        return $repay;
    }

    public function render(){
        $data        = $this->data();
        if($data->status == 'order_placed'){
            $can_repay   = $this->order_repay($data->id);
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
