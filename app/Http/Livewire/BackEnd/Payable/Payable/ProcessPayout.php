<?php

namespace App\Http\Livewire\BackEnd\Payable\Payable;

use Livewire\Component;
use QueryUtility;
use Utility;

class ProcessPayout extends Component
{
    public $date_from, $date_to;

    protected $listeners = [
        'initialize_process_payout_date' => 'initialize'
    ]; 

    public function initialize($date){
        $this->date_from = $date['date_from'];
        $this->date_to   = $date['date_to'];
    }

    public function data(){
        if($this->date_from && $this->date_to){
            
            $filter = [];
            $filter['select'] = [
                'orders.*',
                'partners.name as partner_name',
                'partners.partner_no',
                'partners.key_token as partner_key_token'
            ];
            $filter['where']['orders.status']                 = 'completed';
            $filter['where']['order_payment_payout_items.id'] = null;
            $filter['date_range'][] = [
                'field' => 'orders.created_at',
                'from'  => $this->date_from,
                'to'    => $this->date_to
            ];

            $orders = QueryUtility::orders($filter);
            $data   = [];

            if($orders->count() > 0){
                foreach($orders->get() as $order){
                    $total = Utility::order_total($order->id);

                    foreach($data as $data_key => $data_checker){
                        if($data_checker['partner_id'] == $order->partner_id){
                            $partner_key = $data_key;
                            break;
                        }
                    }

                    if(isset($partner_key)){
                        $data_orders = $data[$partner_key]['orders'];
                    }else{
                        $data[] = [
                            'partner_id'        => $order->partner_id,
                            'partner_name'      => $order->partner_name,
                            'partner_key_token' => $order->partner_key_token,
                            'orders'            => []
                        ];

                        $data_orders = $data[count($data)-1]['orders'];
                    }

                    $data_orders[] = [
                        'order_id' => $order->id,
                        'total'    => $total
                    ];
                }
            }

            dd($data);
            return $data;
        }else{
            return [];
        }
    }

    public function render(){
        $data = $this->data();

        return view('livewire.back-end.payable.payable.process-payout', compact('data'));
    }

    public function process(){
        
    }
}
