<?php

namespace App\Http\Livewire\BackEnd\Payable\Information;

use Livewire\Component;
use App\Model\OrderPaymentPayout;

class Index extends Component
{
    public $payout_id;

    public function mount($payout_id){
        $this->payout_id = $payout_id;
    }

    public function data(){
        return OrderPaymentPayout::with([
                'order_payment_payout_batch',
                'partner.user_account'
            ])
            ->findOrFail($this->payout_id);
    }

    public function render(){
        $data = $this->data();
        return view('livewire.back-end.payable.information.index', compact('data'));
    }
}
