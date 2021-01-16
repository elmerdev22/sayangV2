<?php

namespace App\Http\Livewire\BackEnd\Payable\Payable;

use Livewire\Component;
use QueryUtility;
use PaymentUtility;
use Utility;
use DB;

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
                'order_payments.payment_method',
                'order_payment_logs.paymongo_payment_id',
                'partners.name as partner_name',
                'partners.partner_no',
                'partners.key_token as partner_key_token',
                'partners.slug as partner_slug',
                'partner_accounts.key_token as partner_account_key_token'
            ];
            $filter['where']['orders.status'] = 'completed';
            $filter['where_in'][]             = [
                'field'  => 'order_payments.payment_method',
                'values' => ['card', 'e_wallet']
            ];
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

                    if(!isset($partner_key)){
                        $data[] = [
                            'partner_id'                => $order->partner_id,
                            'partner_name'              => $order->partner_name,
                            'partner_key_token'         => $order->partner_key_token,
                            'partner_slug'              => $order->partner_slug,
                            'partner_account_key_token' => $order->partner_account_key_token,
                            'orders'                    => []
                        ];

                        $partner_key = count($data)-1;
                    }

                    $sayang_commission   = Utility::sayang_commission($total['total']);
                    $paymongo_commission = PaymentUtility::paymongo_commission($order->paymongo_payment_id, $order->payment_method);
                    $online_payment_fee  = $paymongo_commission['fee'] + $paymongo_commission['foreign_fee'];
                    $net_amount          =  $total['total'] - ($online_payment_fee + $sayang_commission['total_commission']);
                    
                    $data[$partner_key]['orders'][] = [
                        'order_id'            => $order->id,
                        'payment_method'      => $order->payment_method,
                        'paymongo_payment_id' => $order->paymongo_payment_id,
                        'total_discount'      => $total['total_discount'],
                        'sub_total'           => $total['sub_total'],
                        'sayang_commission'   => $sayang_commission['total_commission'],
                        'online_payment_fee'  => $online_payment_fee,
                        'total'               => $total['total'],
                        'net_amount'          => $net_amount,
                    ];
                }
                foreach($data as $key => $row){
                    $sayang_commission  = 0;
                    $online_payment_fee = 0;
                    $net_amount         = 0;
                    $total_amount       = 0;

                    foreach($row['orders'] as $order_row){
                        $sayang_commission  += $order_row['sayang_commission'];
                        $online_payment_fee += $order_row['online_payment_fee'];
                        $total_amount       += $order_row['total'];
                        $net_amount         += $order_row['net_amount'];
                    }

                    $data[$key]['sayang_commission']  = $sayang_commission;
                    $data[$key]['online_payment_fee'] = $online_payment_fee;
                    $data[$key]['net_amount']         = $net_amount;
                    $data[$key]['total_amount']       = $total_amount;
                    $data[$key]['total_orders']       = count($row['orders']);
                }
            }

            return $data;
        }else{
            return [];
        }
    }

    public function render(){
        $data = $this->data();

        return view('livewire.back-end.payable.payable.process-payout', compact('data'));
    }

    public function process(array $key_tokens = []){
        if(count($key_tokens) <= 0){
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed!',
                'message' => 'No selected row.'
            ]);
            return false;
        }

        $data = $this->data();
        
        if($data){
            
        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed!',
                'message' => 'No selected row.'
            ]);
        }
    }
}
