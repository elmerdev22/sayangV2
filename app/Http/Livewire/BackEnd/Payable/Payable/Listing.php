<?php

namespace App\Http\Livewire\BackEnd\Payable\Payable;

use Livewire\Component;
use QueryUtility;

class Listing extends Component
{

    public function data(){
        $filter           = [];
        $filter['select'] = [
            'order_payment_payout_batches.*'
        ];

        $filter['order_by'] = 'order_payment_payout_batches.date_from desc';

        return QueryUtility::order_payment_payout_batches($filter)->get();
    }

    public function order_payment_payouts($payout_batch_id){
        $filter           = [];
        $filter['select'] = [
            'order_payment_payouts.*'
        ];
        $filter['where']['order_payment_payouts.payout_batch_id'] = $payout_batch_id;
        $filter['where']['order_payment_payouts.status']          = 'pending';
        $filter['order_by']                                       = 'order_payment_payouts.total_amount asc';

        return QueryUtility::order_payment_payouts($filter);
    }

    public function render(){
        $data      = $this->data();
        $component = $this;

        return view('livewire.back-end.payable.payable.listing', compact('data', 'component'));
    }
}
