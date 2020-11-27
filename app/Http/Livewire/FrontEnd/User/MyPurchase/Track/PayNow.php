<?php

namespace App\Http\Livewire\FrontEnd\User\MyPurchase\Track;

use Livewire\Component;
use App\Model\Order;
use App\Model\OrderItem;
use Utility;

class PayNow extends Component
{
    public $order_id, $order_no;

    public function mount($order_no){
        $this->order_no = $order_no;
        $this->order_id = Order::where('order_no', $this->order_no)->first()->id;
    }

    public function order_repay(){
        $order_items = OrderItem::with(['product_post'])->where('order_id', $this->order_id)->get();
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
        return view('livewire.front-end.user.my-purchase.track.pay-now');
    }

    public function update(){
        $can_repay = $this->order_repay();

        if($can_repay){

            // Do the payment API here...

        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Order expired',
                'message' => 'Unable to process this request.'
            ]);
        }
    }
}
