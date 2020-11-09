<?php

namespace App\Http\Livewire\FrontEnd\User\MyPurchase\Track;

use Livewire\Component;
use App\Model\Order;

class Status extends Component
{
    public $order_no;

    public function mount($order_no){
        $this->order_no = $order_no;
    }

    public function data(){
        return Order::where('order_no', $this->order_no)->firstOrFail();
    }

    public function render(){
        $data   = $this->data();
        $status = $data->status;
        
        if($status == 'cancelled'){
            $status_level = 0;
        }else if($status == 'order_placed'){
            $status_level = 1;
        }else if($status == 'payment_confirmed'){
            $status_level = 2;
        }else if($status == 'to_receive'){
            $status_level = 3;
        }else if($status == 'completed'){
            $status_level = 4;
        }

        return view('livewire.front-end.user.my-purchase.track.status', compact('data', 'status_level'));
    }
}
