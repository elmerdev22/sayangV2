<?php

namespace App\Http\Livewire\FrontEnd\Partner\Payable\Completed;

use Livewire\WithPagination;
use Livewire\Component;
use QueryUtility;
use Utility;
use DB;

class PayableListing extends Component
{
    use WithPagination;

    public $partner_id, $show_entries=10;
    
    public function mount(){
        $this->partner_id = Utility::auth_partner()->id;
    }

    public function data(){
        $filter = [];
        $filter['select'] = [
            'order_payment_payouts.*',
            'order_payment_payout_batches.batch_no',
            'order_payment_payout_batches.date_from',
            'order_payment_payout_batches.date_to',
            'order_payment_payout_batches.commission_percentage'
        ];

        $filter['where']['order_payment_payouts.partner_id']  = $this->partner_id;
        $filter['where']['order_payment_payouts.status']      = 'completed';
        $filter['where']['order_payment_payout_batches.type'] = 'cash';
        $filter['order_by']                                   = 'order_payment_payout_batches.created_at desc';

        return QueryUtility::order_payment_payouts($filter)->paginate($this->show_entries);
    }

    public function order($order_payment_id){
        $filter = [];
        $filter['select'] = [
            'orders.*',
            'orders.id as order_id',
            'orders.created_at as purchase_date',
            'user_accounts.first_name as buyer_first_name',
            'user_accounts.last_name as buyer_last_name',
            'user_accounts.key_token as buyer_key_token'
        ];
        $filter['where']['order_payments.id'] = $order_payment_id;

        return QueryUtility::orders($filter)->first();
    }

    public function data_items($payout_id){
        return DB::table('order_payment_payout_items')->where('order_payment_payout_id', $payout_id)->get();
    }

    public function render(){
        $data      = $this->data();
        $component = $this;
        return view('livewire.front-end.partner.payable.completed.payable-listing', compact('data', 'component'));
    }
}
