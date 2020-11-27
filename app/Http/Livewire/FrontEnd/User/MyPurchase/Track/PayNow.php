<?php

namespace App\Http\Livewire\FrontEnd\User\MyPurchase\Track;

use Livewire\Component;

class PayNow extends Component
{
    public $order_no;

    public function mount($order_no){
        $this->order_no = $order_no;
    }

    public function render(){
        return view('livewire.front-end.user.my-purchase.track.pay-now');
    }
}
