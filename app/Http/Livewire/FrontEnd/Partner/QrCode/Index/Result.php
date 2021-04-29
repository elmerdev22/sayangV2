<?php

namespace App\Http\Livewire\FrontEnd\Partner\QrCode\Index;

use Livewire\Component;
use App\Model\Bid;
use App\Model\Order;
use App\Model\OrderBid;
use App\Model\OrderPayment;
use Utility;

class Result extends Component
{

    public $qr_code, $partner, $order_no;

    public function mount(){
        $this->partner = Utility::auth_partner();
    }

    public function data(){
        return Order::with([
                'billing'
            ])
            ->where('order_no', $this->order_no)
            ->firstOrFail();
    }
    public function render(){
        // $this->qr_code = 'ba4efaaae9e575aef80f';
        if(!empty($this->qr_code)){

            $data = Order::with([
                    'billing', 
                    'order_bid',
                    'order_items',
                    'order_payment',
                    'order_items.product_post',
                    'order_items.product_post.product'
                ])
                ->where('partner_id', $this->partner->id)
                ->where('qr_code', $this->qr_code)
                ->first();
        }else{
            $data = [];
        }

        return view('livewire.front-end.partner.qr-code.index.result', compact('data'));
    }

    public function scan($qr_code){
        $order = Order::where('partner_id', $this->partner->id)->where('qr_code', $qr_code)->first();

        if($order){
            $success        = true;
            $this->qr_code  = $qr_code;
            $order_no       = $order->order_no;
            $this->order_no = $order->order_no;
        }else{
            $success  = false;
            $order_no = '';
        }

        $this->emit('scan_result', [
            'qr_code'  => $qr_code,
            'success'  => $success,
            'order_no' => $order_no
        ]);
    }

    public function update_status(){
        $order = Order::where('partner_id', $this->partner->id)->where('qr_code', $this->qr_code)->first();
        if($order){
            if($order->status == 'order_placed'){
                $order->status                 = 'payment_confirmed';
                $order->date_payment_confirmed = date('Y-m-d H:i:s');
            }else if($order->status == 'payment_confirmed'){
                $order->status = 'to_receive';
            }else if($order->status == 'to_receive'){
                $order->status         = 'completed';
                $order->date_completed = date('Y-m-d H:i:s');
                $order_payment         = OrderPayment::where('order_id', $order->id)->firstOrFail();

                if($order_payment->status == 'pending'){
                    $order_payment->status    = 'paid';
                    $order_payment->date_paid = date('Y-m-d H:i:s');
                    $order_payment->save();

                    $order_bid = OrderBid::where('order_id', $order->id)->first();
                    if($order_bid){
                        $win_bid                 = Bid::find($order_bid->bid_id);
                        $win_bid->winning_status = 'paid';
                        $win_bid->save();
                    }
                }
            }

            if($order->save()){
                $this->emit('status_updated', [
                    'new_status' => ucfirst(str_replace('_', ' ', $order->status)),
                    'success'    => true,
                    'order_no'   => $order->order_no
                ]);
                
                $user_account_id = $this->data()->billing->user_account_id;
                Utility::new_notification($user_account_id, null, 'order_completed', 'order_updates');
            }
        }
    }
    
}
