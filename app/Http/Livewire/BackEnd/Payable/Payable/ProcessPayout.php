<?php

namespace App\Http\Livewire\BackEnd\Payable\Payable;

use Livewire\Component;
use App\Model\OrderPaymentPayout;
use App\Model\OrderPaymentPayoutItem;
use App\Model\OrderPaymentPayoutBatch;
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
                'order_payments.id as order_payment_id',
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
                'field' => 'orders.date_completed',
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
                        'order_payment_id'    => $order->order_payment_id,
                        'payment_method'      => $order->payment_method,
                        'paymongo_payment_id' => $order->paymongo_payment_id,
                        'total_discount'      => $total['total_discount'],
                        'sub_total'           => $total['sub_total'],
                        'sayang_commission'   => $sayang_commission['total_commission'],
                        'paymongo_fee'        => $paymongo_commission['fee'],
                        'foreign_fee'         => $paymongo_commission['foreign_fee'],
                        'online_payment_fee'  => $online_payment_fee,
                        'total'               => $total['total'],
                        'net_amount'          => $net_amount,
                    ];
                }
                foreach($data as $key => $row){
                    $sayang_commission  = 0;
                    $online_payment_fee = 0;
                    $paymongo_fee       = 0;
                    $foreign_fee        = 0;
                    $net_amount         = 0;
                    $total_amount       = 0;

                    foreach($row['orders'] as $order_row){
                        $sayang_commission  += $order_row['sayang_commission'];
                        $paymongo_fee       += $order_row['paymongo_fee'];
                        $foreign_fee        += $order_row['foreign_fee'];
                        $online_payment_fee += $order_row['online_payment_fee'];
                        $total_amount       += $order_row['total'];
                        $net_amount         += $order_row['net_amount'];
                    }

                    $data[$key]['sayang_commission']  = $sayang_commission;
                    $data[$key]['paymongo_fee']       = $paymongo_fee;
                    $data[$key]['foreign_fee']        = $foreign_fee;
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
            DB::beginTransaction();
            $response = ['success' => false, 'message' => 'An error occured'];

            try{
                $payout_batch                        = new OrderPaymentPayoutBatch();
                $payout_batch->batch_no              = Utility::generate_payout_batch_no();
                $payout_batch->date_from             = $this->date_from;
                $payout_batch->date_to               = $this->date_to;
                $payout_batch->commission_percentage = PaymentUtility::commission_percentage();
                $payout_batch->type                  = 'online_payment';
                $payout_batch->key_token             = Utility::generate_table_token('OrderPaymentPayoutBatch');
                
                if($payout_batch->save()){
                    foreach($data as $row){
                        if(!in_array($row['partner_key_token'], $key_tokens)){
                            continue;
                        }

                        $payout                    = new OrderPaymentPayout();
                        $payout->payout_batch_id   = $payout_batch->id;
                        $payout->partner_id        = $row['partner_id'];
                        $payout->payout_no         = Utility::generate_payout_no();
                        $payout->total_amount      = $row['total_amount'];
                        $payout->sayang_commission = $row['sayang_commission'];
                        $payout->paymongo_fee      = $row['paymongo_fee'];
                        $payout->foreign_fee       = $row['foreign_fee'];
                        $payout->net_amount        = $row['net_amount'];
                        $payout->key_token         = Utility::generate_table_token('OrderPaymentPayout');
                        
                        if($payout->save()){
                            if(count($row['orders']) > 0){
                                foreach($row['orders'] as $order){
                                    $payout_item                          = new OrderPaymentPayoutItem();
                                    $payout_item->order_payment_id        = $order['order_payment_id'];
                                    $payout_item->order_payment_payout_id = $payout->id;
                                    $item_success                         = $payout_item->save();

                                    if(!$item_success){
                                        throw new \Exception('Uncaught Exception');
                                    }
                                }
                            }else{
                                throw new \Exception('Uncaught Exception');
                            }
                        }else{
                            throw new \Exception('Uncaught Exception');
                        }
                    }

                    $response['success'] = true;
                    $response['message'] = 'Successfully added to pending payables.';
                }
            }catch(\Exception $e){
                DB::rollback();
                $response['success'] = false;
                dd($e);
            }

            if($response['success']){
                DB::commit();
                $this->emit('alert', [
                    'type'    => 'success',
                    'title'   => 'Successfully Added!',
                    'message' => $response['message']
                ]);
                $this->emit('initialize_process_payout_listing', true);
                $this->reset();
            }else{
                DB::rollback();
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Failed!',
                    'message' => $response['message']
                ]);
            }
        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed!',
                'message' => 'No selected row.'
            ]);
        }
    }
}
