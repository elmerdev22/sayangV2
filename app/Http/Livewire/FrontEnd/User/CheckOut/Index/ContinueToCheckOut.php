<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Luigel\Paymongo\Facades\Paymongo;
use Livewire\Component;
use App\Model\Bid;
use App\Model\Cart;
use App\Model\Billing;
use App\Model\ProductPost;
use App\Model\PhilippineBarangay;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\OrderPayment;
use App\Model\OrderPaymentLog;
use App\Model\UserAccountBank;
use App\Model\UserAccountAddress;
use App\Model\UserAccountCreditCard;
use App\Events\CheckOut;
use PaymentUtility;
use Session;
use Utility;
use DB;

class ContinueToCheckOut extends Component
{
    public $account, $payment_method = [], $billing_address_id, $available_e_wallet=[];

    //Sample Bank Account Balance, We will remove this after the payment paymongo implemented
    public $temporary_account_balance=true;
    
    protected $listeners = [
        'set_payment_method'     => 'set_payment_method',
        'set_billing_address_id' => 'set_billing_address_id'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->initialize_address();
        $this->available_e_wallet = PaymentUtility::active_e_wallet();
        
        $payment_method = [];

        $this->set_payment_method($payment_method);
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

        if(!empty($this->billing_address_id)){
            if(!empty($payment_method)){
                if($payment_method['payment_method'] != 'e_wallet' && $payment_method['payment_method'] != 'card'){
                    $this->emit('remove_loading_card', true);
                    $this->emit('alert', [
                        'type'    => 'error',
                        'title'   => 'Warning',
                        'message' => 'Invalid payment method.'
                    ]);
                    return false;
                }else{
                    if($payment_method['payment_method'] == 'e_wallet'){
    
                        $available_ewallet = [];
                        foreach($this->available_e_wallet as $e_wallet_row){
                            $available_ewallet[] = $e_wallet_row['key'];
                        }
    
                        if(!in_array($payment_method['payment_e_wallet'], $available_ewallet)){
                            $this->emit('remove_loading_card', true);
                            $this->emit('alert', [
                                'type'    => 'error',
                                'title'   => 'Warning',
                                'message' => 'Invalid e-wallet.'
                            ]);
                            return false;
                        }
                    }
                }
    
                $cart = Utility::cart($this->account->id, true);
    
                if($this->temporary_account_balance){
                    /*  Do the Insert of Order Transactions
                        and the payment API transaction here...
                    */
                    $response = ['success' => false];
                    DB::beginTransaction();
    
                    try{
                        $billing_details                       = [];
                        $billing_details['sub_total']          = $cart['total'];
                        $billing_details['total_discount']     = $cart['total_discount'];
                        $billing_details['total_price']        = $cart['total_price'];
                        $billing_details['paymongo']['method'] = $payment_method['payment_method'];
    
                        if($payment_method['payment_method'] != 'e_wallet'){
                            $payment = UserAccountCreditCard::where('user_account_id', $this->account->id);
                            $payment = $payment->where('key_token', $payment_method['payment_key_token'])->first();
    
                            if(!$payment){
                                throw new \Exception('Uncaught Exception');
                            }
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
                            $billing_details['billing_id'] = $billing->id;
                            $billing_details['billing_no'] = $billing->billing_no;
    
                            foreach($cart['partner_products'] as $cart_key => $cart_row){
                                $order                         = new Order();
                                $order->billing_id             = $billing->id;
                                $order->partner_id             = $cart_row['partner_id'];
                                $order->order_no               = Utility::generate_order_no();
                                $order->qr_code                = Utility::generate_table_token('Order', 'qr_code');
                                $order->status                 = 'order_placed';
                                $order->key_token              = Utility::generate_table_token('Order');
                                if($order->save()){
    
                                    foreach($cart_row['products'] as $order_item_key => $order_item_row){
                                        $order_item                  = new OrderItem();
                                        $order_item->order_id        = $order->id;
                                        $order_item->product_post_id = $order_item_row['product_post_id'];
                                        $order_item->quantity        = $order_item_row['selected_quantity'];
                                        $order_item->key_token       = Utility::generate_table_token('OrderItem');
                                        $order_item_saved            = $order_item->save();
    
                                        if($order_item_saved){
                                            $product_post_cart = Cart::find($order_item_row['cart_id']);
                                            $product_post_cart->delete();
                                        }else{
                                            throw new \Exception('Uncaught Exception');
                                        }
    
                                    }
    
                                    $order_payment                 = new OrderPayment();
                                    $order_payment->order_id       = $order->id;
                                    $order_payment->payment_method = $this->payment_method['payment_method'];
                                    
                                    if(!isset($payment)){
                                        $order_payment->bank_id      = null;
                                        $order_payment->account_name = null;
                                        $order_payment->account_no   = null;
                                    }else{
                                        $order_payment->card_holder             = ucwords($payment->card_holder);
                                        $order_payment->card_no                 = $payment->card_no;
                                        $order_payment->card_expiration_date    = $payment->card_expiration_date;
                                        $order_payment->card_verification_value = $payment->card_verification_value;
                                    }
    
                                    $order_payment->status    = 'pending';
                                    $order_payment->key_token = Utility::generate_table_token('OrderPayment');
                                    
                                    if($order_payment->save()){
                                        $order_payment_log                   = new OrderPaymentLog();
                                        $order_payment_log->order_payment_id = $order_payment->id;    
                                        if($order_payment_log->save()){
                                            $billing_details['orders'][] = [
                                                'order_id'             => $order->id,
                                                'order_no'             => $order->order_no,
                                                'order_payment_id'     => $order_payment->id,
                                                'order_payment_log_id' => $order_payment_log->id
                                            ];
                                            continue;
                                        }else{
                                            throw new \Exception('Uncaught Exception');
                                        }
                                    }else{
                                        throw new \Exception('Uncaught Exception');
                                    }

                                }
                            }

                            $barangay = PhilippineBarangay::with(['philippine_city.philippine_province'])
                                ->find($billing->barangay_id);

                            $billing = [
                                'name'    => ucwords($billing->full_name),
                                'phone'   => $billing->contact_no,
                                'email'   => $billing->email,
                                'address' => [
                                    'line1'       => ucfirst($barangay->name),
                                    'line2'       => ucfirst($billing->address),
                                    'postal_code' => $billing->zip_code,
                                    'state'       => ucfirst($barangay->philippine_city->philippine_province->name),
                                    'city'        => ucfirst($barangay->philippine_city->name),
                                    'country'     => PaymentUtility::billing_country()
                                ]
                            ];

                            if($payment_method['payment_method'] == 'e_wallet'){
                                $billing_details['paymongo']['type']   = $payment_method['payment_e_wallet'];
                                $paymongoSource = Paymongo::source()->create([
                                    'type'     => $payment_method['payment_e_wallet'],
                                    'amount'   => $billing_details['total_price'],
                                    'currency' => PaymentUtility::currency(),
                                    'redirect' => [
                                        'success' => route('front-end.user.check-out.paymongo-pay-e-wallet', ['billing_details' => $billing_details, 'success' => true]),
                                        'failed'  => route('front-end.user.check-out.paymongo-pay-e-wallet', ['billing_details' => $billing_details, 'success' => false])
                                    ],
                                    'billing' => $billing
                                ]);
                                
                                foreach($billing_details['orders'] as $order){
                                    $payment_log            = OrderPaymentLog::find($order['order_payment_log_id']);
                                    $payment_log->api       = 'paymongo';
                                    $payment_log->method    = 'source';
                                    $payment_log->method_id = $paymongoSource->id;
                                    $payment_log->save();
                                }
                            }
    
                            $response['success'] = true;
                        }
                    }catch(\Exception $e){
                        $response['success'] = false;
                    }
    
                    if($response['success']){
                        if(isset($paymongoSource)){
                            DB::commit();
                            return redirect($paymongoSource->getRedirect()['checkout_url']);
                        }else{
                            DB::rollback();
                            dd('OOPS... CARD RESOURCE ON DEVELOPMENT ^_^');
                        }
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
                    'message' => 'Please choose payment method.'
                ]);
            }
        }else{
            $this->emit('remove_loading_card', true);
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed!',
                'message' => 'Please select your billing address.'
            ]);
        }
    }

}
