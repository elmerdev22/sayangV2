<?php

namespace App\Http\Livewire\BackEnd\Payable\Receivable;

use Livewire\Component;
use QueryUtility;

class PartnerReceivable extends Component
{
    public $partner_id, $date_from, $date_to, $date_start, $date_end;

    protected $listeners = [
        'partner_receivable' => 'initialize'
    ];

    public function initialize($partner){
        $this->partner_id = $partner['partner_id'];
    }

    public function data(){
        if($this->partner_id){
            $filter = [];
            $filter['select'] = [
                'orders.*',
                'orders.id as order_id',
                'user_accounts.first_name as buyer_first_name',
                'user_accounts.last_name as buyer_last_name',
                'user_accounts.key_token as buyer_key_token'
            ];
            $filter['where']['orders.partner_id'] = $this->partner_id;
    
            $filter['where']['orders.status'] = 'completed';
            $filter['where_in'][]             = [
                'field'  => 'order_payments.payment_method',
                'values' => ['cash_on_pickup']
            ];
            $filter['where']['order_payment_payout_items.id'] = null;

            if($this->date_from && $this->date_to){
                $filter['date_range'][] = [
                    'field' => 'orders.date_completed',
                    'from'  => $this->date_from,
                    'to'    => $this->date_to
                ];
            }
            $filter['order_by'] = 'orders.date_completed asc';

            return QueryUtility::orders($filter)->get();
        }else{
            return [];
        }
    }

    public function render(){
        $data = $this->data();
        return view('livewire.back-end.payable.receivable.partner-receivable', compact('data'));
    }

    public function update_date(){
        $rules = [
            'date_start' => 'required|date',
            'date_end'   => 'required|date|after_or_equal:date_start'
        ];

        $this->validate($rules);
        $this->date_from = $this->date_start;
        $this->date_to   = $this->date_end;
    }
}
