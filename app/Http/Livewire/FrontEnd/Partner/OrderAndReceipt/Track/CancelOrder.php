<?php

namespace App\Http\Livewire\FrontEnd\Partner\OrderAndReceipt\Track;

use Livewire\Component;
use App\Model\Order;
use App\Model\OrderPayment;
use Utility;
use DB;

class CancelOrder extends Component
{

    public $cancelation_reason, $order_no;

    public function mount($order_no){
        $this->order_no = $order_no;
    }

    public function render(){
        return view('livewire.front-end.partner.order-and-receipt.track.cancel-order');
    }

    public function update(){
        $rules = ['cancelation_reason' => 'required|max:190'];

        $this->validate($rules);

        DB::beginTransaction();
        $response = ['success' => false];

        try{
            $order                     = Order::where('order_no', $this->order_no)->firstOrFail();
            $order->status             = 'cancelled';
            $order->cancelation_reason = ucfirst($this->cancelation_reason);
            $order->date_cancelled     = date('Y-m-d H:i:s');
            $order->cancelled_by       = 'partner';

            if($order->save()){
                $order_payment         = OrderPayment::where('order_id', $order->id)->firstOrFail();
                $order_payment->status = 'cancelled';

                if($order_payment->save()){
                    $response['success'] = true;
                }
            }
        }catch(\Exception $e){

        }

        if($response['success']){
            DB::commit();
            $this->emit('alert_link',[
                'type'  => 'success',
                'title' => 'Order Successfully Cancelled'
            ]);
        }else{
            DB::rollback();
            $this->emit('alert',[
                'type'  => 'error',
                'title' => 'An error occured'
            ]);
        }
    }
}
