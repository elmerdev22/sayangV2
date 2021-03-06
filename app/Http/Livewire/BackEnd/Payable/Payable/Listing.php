<?php

namespace App\Http\Livewire\BackEnd\Payable\Payable;

use Livewire\Component;
use App\Model\OrderPaymentPayout;
use QueryUtility;

class Listing extends Component
{

    protected $listeners = [
        'initialize_process_payout_listing' => '$refresh'
    ];
    
    public function data(){
        $filter           = [];
        $filter['select'] = [
            'order_payment_payout_batches.*'
        ];

        $filter['order_by'] = 'order_payment_payout_batches.date_from asc';

        return QueryUtility::order_payment_payout_batches($filter)->get();
    }

    public function order_payment_payouts($payout_batch_id){
        $filter           = [];
        $filter['select'] = [
            'order_payment_payouts.*',
            'order_payment_payouts.key_token as payout_key_token',
            'partners.name as partner_name',
            'partner_accounts.key_token as partner_account_key_token'
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

    public function confirm_process_payout($key_token){
        $payout = OrderPaymentPayout::where('key_token', $key_token)->firstOrFail();
        $this->emit('initialize_confirm_process_payout', $payout->id);
    }
}
