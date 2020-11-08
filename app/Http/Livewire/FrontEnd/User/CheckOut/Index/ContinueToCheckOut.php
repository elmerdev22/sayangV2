<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Livewire\Component;
use App\Model\Cart;
use App\Model\Billing;
use App\Model\ProductPost;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\OrderPayment;
use App\Model\OrderPaymentLog;
use App\Model\UserAccountBank;
use App\Model\UserAccountAddress;
use App\Model\UserAccountCreditCard;
use App\Events\CheckOut;
use Utility;
use DB;

class ContinueToCheckOut extends Component
{
    public $account, $payment_method = [], $billing_address_id;

    //Sample Bank Account Balance, We will remove this after the payment paymongo implemented
    public $temporary_account_balance=500000;
    
    protected $listeners = [
        'set_payment_method'     => 'set_payment_method',
        'set_billing_address_id' => 'set_billing_address_id'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->initialize_address();
        $this->initialize_bank();
    }

    public function initialize_address(){
        $data = UserAccountAddress::with([
                'philippine_barangay', 
                'philippine_barangay.philippine_city', 
                'philippine_barangay.philippine_city.philippine_province',
                'philippine_barangay.philippine_city.philippine_province.philippine_region',
            ])
            ->where('user_account_id', $this->account->id)
            ->where('is_default', true)
            ->first();
        
        if($data){
            $this->set_billing_address_id($data->id);
        }
    }

    public function initialize_bank(){
        $default = UserAccountBank::where('user_account_id', $this->account->id);
        $default = $default->where('is_default', true)->first();
        if($default){
            $payment_method = [
                'payment_method'    => 'online_payment',
                'payment_key_token' => $default->key_token
            ];

            $this->set_payment_method($payment_method);
        }
    }

    public function set_payment_method(array $payment_method = []){
        $this->payment_method = $payment_method;
    }

    public function set_billing_address_id(int $billing_address_id = null){
        $this->billing_address_id = $billing_address_id;
    }

    public function render(){
        return view('livewire.front-end.user.check-out.index.continue-to-check-out');
    }

    public function proceed(){
        $payment_method = $this->payment_method;

        if(!empty($payment_method) && !empty($this->billing_address_id)){
            $cart = Utility::cart($this->account->id, true);

            if($this->temporary_account_balance >= $cart['total_price']){
                /*  Do the Insert of Order Transactions
                    and the payment API transaction here...
                */
                $response = ['success' => false];
                DB::beginTransaction();

                try{
                    $product_posts = [];

                    if($payment_method['payment_method'] == 'online_payment'){
                        $payment = UserAccountBank::where('user_account_id', $this->account->id);
                    }else{
                        $payment = UserAccountCreditCard::where('user_account_id', $this->account->id);
                    }

                    $payment = $payment->where('key_token', $payment_method['payment_key_token'])->first();
                    
                    if(!$payment){
                        throw new \Exception('Uncaught Exception');
                    }

                    $address = UserAccountAddress::find($this->billing_address_id);
                    
                    if(!$address){
                        throw new \Exception('Uncaught Exception');
                    }

                    $billing                  = new Billing();
                    $billing->billing_no      = Utility::generate_billing_no();
                    $billing->user_account_id = $this->account->id;
                    $billing->barangay_id     = $address->barangay_id;
                    $billing->full_name       = $address->full_name;
                    $billing->contact_no      = $address->contact_no;
                    
                    if(auth()->user()->email){
                        $billing->email = auth()->user()->email;
                    }

                    $billing->address   = $address->address;
                    $billing->zip_code  = $address->zip_code;
                    $billing->key_token = Utility::generate_table_token('Billing');
                    
                    if($billing->save()){
                        foreach($cart['partner_products'] as $cart_key => $cart_row){
                            $order                         = new Order();
                            $order->billing_id             = $billing->id;
                            $order->partner_id             = $cart_row['partner_id'];
                            $order->order_no               = Utility::generate_order_no();
                            $order->qr_code                = Utility::generate_table_token('Order', 'qr_code');
                            $order->status                 = 'payment_confirmed';
                            $order->date_payment_confirmed = date('Y-m-d H:i:s');
                            $order->key_token              = Utility::generate_table_token('Order');
                            if($order->save()){
                                foreach($cart_row['products'] as $order_item_key => $order_item_row){
                                    $order_item                  = new OrderItem();
                                    $order_item->order_id        = $order->id;
                                    $order_item->product_post_id = $order_item_row['product_post_id'];
                                    $order_item->quantity        = $order_item_row['selected_quantity'];
                                    $order_item->key_token       = Utility::generate_table_token('OrderItem');
                                    if($order_item->save()){
                                        $product_post = ProductPost::find($order_item_row['product_post_id']);
                                        
                                        if($product_post->quantity >= $order_item_row['selected_quantity']){
                                            $remaining_quantity     = abs($product_post->quantity - $order_item_row['selected_quantity']);
                                            $product_post->quantity = $remaining_quantity;

                                            if($product_post->save()){
                                                $product_post_cart = Cart::find($order_item_row['cart_id']);

                                                if($product_post_cart->delete()){
                                                    $cart_update_quantity = Cart::where('id', '!=', $order_item_row['cart_id'])
                                                        ->where('product_post_id', $product_post->id)
                                                        ->get();

                                                    foreach($cart_update_quantity as $cart_update_quantity_row){
                                                        if($remaining_quantity == 0){
                                                            $cart_update_quantity_row->quantity = 0;
                                                        }else{
                                                            if($remaining_quantity <= $cart_update_quantity_row->quantity){
                                                                $cart_update_quantity_row->quantity = $remaining_quantity;
                                                            }
                                                        }

                                                        $cart_update_quantity_row->save();
                                                    }

                                                    $product_posts[] = [
                                                        'product_post_id'        => $order_item_row['product_post_id'],
                                                        'product_post_key_token' => $order_item_row['product_post_key_token']
                                                    ];

                                                    continue;
                                                }else{
                                                    throw new \Exception('Uncaught Exception');
                                                }
                                            }else{
                                                throw new \Exception('Uncaught Exception');
                                            }
                                        }else{
                                            throw new \Exception('Uncaught Exception');
                                        }
                                    }else{
                                        throw new \Exception('Uncaught Exception');
                                    }
                                }

                                $order_payment                 = new OrderPayment();
                                $order_payment->order_id       = $order->id;
                                $order_payment->payment_method = $this->payment_method['payment_method'];
                                
                                if($this->payment_method['payment_method'] == 'online_payment'){
                                    $order_payment->bank_id      = $payment->bank_id;
                                    $order_payment->account_name = ucwords($payment->account_name);
                                    $order_payment->account_no   = $payment->account_no;
                                }else{
                                    $order_payment->card_holder             = ucwords($payment->card_holder);
                                    $order_payment->card_no                 = $payment->card_no;
                                    $order_payment->card_expiration_date    = $payment->card_expiration_date;
                                    $order_payment->card_verification_value = $payment->card_verification_value;
                                }

                                $order_payment->status    = 'paid';
                                $order_payment->date_paid = date('Y-m-d H:i:s');
                                $order_payment->key_token = Utility::generate_table_token('OrderPayment');
                                
                                if($order_payment->save()){
                                    $order_payment_log                   = new OrderPaymentLog();
                                    $order_payment_log->order_payment_id = $order_payment->id;
                                    $order_payment_log->api              = 'paymongo';
                                    // $order_payment_log->method           = 'source';
                                    // $order_payment_log->method_id        = $paymongo->id;
                                    // $order_payment_log->logs             = json_encode([]);

                                    if($order_payment_log->save()){
                                        continue;
                                    }else{
                                        throw new \Exception('Uncaught Exception');
                                    }
                                }else{
                                    throw new \Exception('Uncaught Exception');
                                }
                            }
                        }

                        $response['success'] = true;
                    }
                }catch(\Exception $e){
                    // dd($e);
                    $response['success'] = false;
                }

                if($response['success']){
                    DB::commit();
                    
                    if(isset($product_posts)){
                        event(new CheckOut($product_posts));
                    }
                    $this->emit('alert_link', [
                        'type'     => 'success',
                        'title'    => 'Order Successfully Processed',
                        'redirect' => route('front-end.user.my-purchase.list')
                    ]);
                }else{
                    DB::rollback();
                    $this->emit('remove_loading_card', true);
                    $this->emit('alert', [
                        'type'    => 'error',
                        'title'   => 'Failed',
                        'message' => 'An error occured while in order transaction.'
                    ]);
                }

            }else{
                $this->emit('remove_loading_card', true);
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Insufficient Account Balance',
                    'message' => 'Total Price to Pay: <b>₱ '.number_format($cart['total_price'], 2).'</b>'
                ]);
            }

        }else{
            $this->emit('remove_loading_card', true);
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed!',
                'message' => 'Please Select Address and Payment Method'
            ]);
        }
    }

}
