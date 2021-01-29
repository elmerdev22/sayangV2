<?php

namespace App\Http\Livewire\FrontEnd\Partner\Payable\Information;

use Livewire\Component;
use App\Model\OrderPaymentPayoutItem;

class OrderListing extends Component
{       
    public $payout_id;

    public function mount($payout_id){
        $this->payout_id = $payout_id;
    }

    public function data(){
        return OrderPaymentPayoutItem::with([
                'order_payment.order.billing.user_account'
            ])
            ->where('order_payment_payout_id', $this->payout_id)
            ->get();
    }

    public function render(){
        $data = $this->data();
        return view('livewire.front-end.partner.payable.information.order-listing', compact('data'));
    }
}
