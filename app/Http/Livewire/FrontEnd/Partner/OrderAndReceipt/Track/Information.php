<?php

namespace App\Http\Livewire\FrontEnd\Partner\OrderAndReceipt\Track;

use Livewire\Component;
use App\Model\Order;
use App\Model\OrderPayment;
use App\Events\CheckOut;
use PaymentUtility;
use UploadUtility;
use Utility;
use DB;

class Information extends Component
{
    public $order_no, $is_cancellable, $is_payment_confirmable, $can_repay, $is_remarkable_as_paid;

    public function mount($order_no, $is_cancellable, $is_payment_confirmable){
        $this->order_no               = $order_no;
        $this->is_cancellable         = $is_cancellable;
        $this->is_payment_confirmable = $is_payment_confirmable;
        $this->is_remarkable_as_paid  = false;
    }

    public function data(){
        return Order::with([
                'order_bid',
                'order_payment.order_payment_payout',
                'order_payment.bank',
                'order_payment.order_payment_log',
                'billing.philippine_barangay.philippine_city.philippine_province.philippine_region'
            ])
            ->where('order_no', $this->order_no)
            ->firstOrFail();
    }

    public function render(){
        $data        = $this->data();
        $order_total = Utility::order_total($data->id);
        $component   = $this;
        
        if($data->status == 'order_placed'){
            if($data->order_bid){
                $this->can_repay = true;
            }else{
                $this->can_repay = Utility::order_can_repay($data->id);
            }
        }else{
            $this->can_repay = false;
        }

        $this->is_remarkable_as_paid = false;

        if($data->order_payment->payment_method == 'cash_on_pickup'){
            if($data->order_payment->status == 'pending'){
                $status_remark_paid = ['to_receive', 'payment_confirmed', 'completed'];
                if(in_array($data->status, $status_remark_paid)){
                    $this->is_remarkable_as_paid = true;
                }
            }
        }

        return view('livewire.front-end.partner.order-and-receipt.track.information', compact('data', 'order_total', 'component'));
    }

    public function payout_receipt(){
        $data     = $this->data();
        $response = null;
        
        if($data->order_payment->order_payment_payout){
            $receipt = UploadUtility::payout_receipt($data->order_payment->order_payment_payout->key_token);
            if(count($receipt) > 0){
                $response = $receipt[0]->getFullUrl();
            }
        }
        
        return $response; 
    }

    public function qr_code($key_token){
		$order = Order::where('key_token', $key_token)->firstOrFail();
		$this->emit('initialize_qr_code', [
			'qr_code'  => $order->qr_code,
			'order_no' => $order->order_no
		]);
    }

    public function remark_as_paid(){
        if($this->is_remarkable_as_paid){
            DB::beginTransaction();
            $response = ['success' => false];

            try{
                $order              = Order::where('order_no', $this->order_no)->firstOrFail();
                $payment            = OrderPayment::where('order_id', $order->id)->firstOrFail();
                $payment->status    = 'paid';
                $payment->date_paid = date('Y-m-d H:i:s');
                
                if($payment->save()){
                    $response['success'] = true;
                }
            }catch(\Exception $e){

            }

            if($response['success']){
                DB::commit();
                $this->emit('alert_link',[
                    'type'  => 'success',
                    'title' => 'Order Successfully Paid'
                ]);
            }else{
                DB::rollback();
                $this->emit('alert',[
                    'type'  => 'error',
                    'title' => 'An error occured'
                ]);
            }
        }else{
            $this->emit('alert',[
                'type'  => 'error',
                'title' => 'Unable to remark as paid the payment'
            ]);
        }
    }
    
    public function payment_confirmed(){
        if($this->can_repay && $this->is_payment_confirmable){
            DB::beginTransaction();
            $response = ['success' => false];
    
            try{
                $order     = Order::where('order_no', $this->order_no)->where('status', 'order_placed')->firstOrFail();
                $pay_order = PaymentUtility::pay_order($order->id, [], true);
    
                if($pay_order['success']){
                    $pay_order['message'];
                    $pay_order['product_posts'];

                    $response['success'] = true;
                }
    
            }catch(\Exception $e){
    
            }
    
            if($response['success']){
                DB::commit();
                if(isset($pay_order['product_posts'])){
                    if(count($pay_order['product_posts']) > 0){
                        foreach($pay_order['product_posts'] as $key => $product_post){
                            event(new CheckOut($product_post));
                        }
                    }
                }
                $user_account_id = $this->data()->billing->user_account_id;
                Utility::new_notification($user_account_id, null, 'confirmed_cop_request', 'order_updates');
                $this->emit('alert_link',[
                    'type'  => 'success',
                    'title' => 'Order Successfully Confirmed'
                ]);
            }else{
                DB::rollback();
                $this->emit('alert',[
                    'type'  => 'error',
                    'title' => 'An error occured'
                ]);
            }
        }else{
            $this->emit('alert',[
                'type'  => 'error',
                'title' => 'Unable to confirm the payment'
            ]);
        }
    }
}
