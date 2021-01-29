<?php

namespace App\Http\Livewire\FrontEnd\Partner\Payable\Receivable;

use Livewire\Component;
use QueryUtility;
use Utility;

class Pending extends Component
{
    public $partner_id;

    public function mount(){
        $this->partner_id = Utility::auth_partner()->id;
    }

    public function data(){
        $filter           = [];
        $filter['select'] = [
            'order_payment_payouts.*',
            'order_payment_payout_batches.created_at as payout_date',
            'order_payment_payout_batches.date_from',
            'order_payment_payout_batches.date_to',
            'order_payment_payout_batches.batch_no',
            'order_payment_payouts.key_token as payout_key_token'
        ];
        $filter['where']['order_payment_payouts.status']          = 'pending';
        $filter['where']['order_payment_payouts.partner_id']      = $this->partner_id;
        $filter['order_by']                                       = 'order_payment_payouts.created_at desc';

        return QueryUtility::order_payment_payouts($filter)->get();
    }
    public function render(){
        $data = $this->data();

        return view('livewire.front-end.partner.payable.receivable.pending', compact('data'));
    }
}
