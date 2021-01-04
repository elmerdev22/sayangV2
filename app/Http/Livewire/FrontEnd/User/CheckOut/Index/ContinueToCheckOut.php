<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Luigel\Paymongo\Facades\Paymongo;
use Livewire\Component;
use App\Model\Bid;
use App\Model\Cart;
use App\Model\Billing;
use App\Model\ProductPost;
use App\Model\PhilippineBarangay;
use App\Model\Partner;
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
    public $account, $payment_method = [], $billing_address_id, $available_e_wallet=[], $tmp_payment_intent_id=null, $billing_details=[];

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

        $this->set_payment_method($payment_method, true);
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

    public function set_payment_method(array $payment_method = [], $is_init=false){
        if($is_init){
            $cart        = Utility::cart($this->account->id, true);
            $total_price = $cart['total_price'];
        
            if($total_price >= PaymentUtility::paymongo_minimum()){
                // $default_e_wallet = PaymentUtility::active_e_wallet(true);
                $payment_method = [
                    'payment_method'    => 'e_wallet',
                    'payment_e_wallet'  => null,//$default_e_wallet['key'],
                    'payment_key_token' => null,
                ];
            }else{
                $payment_method = [
                    'payment_method'    => 'cash_on_pickup',
                    'payment_e_wallet'  => null,
                    'payment_key_token' => null,
                ];
            }
        }

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
        $cart           = Utility::cart($this->account->id, true);

        if(!empty($this->billing_address_id)){
            if(!empty($payment_method)){
                $allowed_method = PaymentUtility::allowed_method();
                if(!in_array($payment_method['payment_method'], $allowed_method)){
                    $this->emit('remove_loading_card', true);
                    $this->emit('alert', [
                        'type'    => 'error',
                        'title'   => 'Warning',
                        'message' => 'Invalid payment method.'
                    ]);
                    return false;
                }

                if($payment_method['payment_method'] != 'cash_on_pickup'){
                    if($cart['total_price'] < PaymentUtility::paymongo_minimum()){
                        $this->emit('remove_loading_card', true);
                        $this->emit('alert', [
                            'type'    => 'error',
                            'title'   => 'Failed',
                            'message' => 'Minimum for <b>'.str_replace('_', '-', $payment_method['payment_method']).'</b> is PHP '.number_format(PaymentUtility::paymongo_minimum(),2)
                        ]);
                        return false;
                    }
                    
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

                if($this->temporary_account_balance){
                    /*  Do the Insert of Order Transactions
                        and the payment API transaction here...
                    */
                    $response = ['success' => false];
                    DB::beginTransaction();
    
                    try{
                        $notification_details                  = [];
                        $billing_details                       = [];
                        $billing_details['sub_total']          = $cart['total'];
                        $billing_details['total_discount']     = $cart['total_discount'];
                        $billing_details['total_price']        = $cart['total_price'];
                        $billing_details['paymongo']['method'] = $payment_method['payment_method'];
    
                        if($payment_method['payment_method'] == 'card'){
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

                                    $notification_details[] = [
                                        'partner_id'      => $order->partner_id,
                                        'billing_no'      => $billing->billing_no,
                                        'order_no'        => $order->order_no,
                                        'user_account_id' => $billing->user_account_id //Buyer - user account id
                                    ];
                                    
                                    foreach($cart_row['products'] as $order_item_key => $order_item_row){
                                        $order_item                  = new OrderItem();
                                        $order_item->order_id        = $order->id;
                                        $order_item->product_post_id = $order_item_row['product_post_id'];
                                        $order_item->quantity        = $order_item_row['selected_quantity'];
                                        $order_item->key_token       = Utility::generate_table_token('OrderItem');
                                        $order_item->price           = $order_item_row['buy_now_price'];
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
                                    $order_payment->payment_method = $payment_method['payment_method'];
                                    
                                    if($payment_method['payment_method'] == 'card'){
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
                                                'partner_id'           => $order->partner_id,
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
                            }else if($payment_method['payment_method'] == 'card'){
                                $exp_month = date('m', strtotime($payment->card_expiration_date));
                                $exp_year  = date('y', strtotime($payment->card_expiration_date));

                                $paymentMethod = Paymongo::paymentMethod()->create([
                                    'type'    => $payment_method['payment_method'],
                                    'details' => [
                                        'card_number' => str_replace('-', '', $payment->card_no),
                                        'exp_month'   => (int)$exp_month,
                                        'exp_year'    => (int)$exp_year,
                                        'cvc'         => $payment->card_verification_value
                                    ],
                                    'billing' => $billing
                                ]);


                                $order_numbers = '';

                                foreach($billing_details['orders'] as $order_row){
                                    $order_numbers .= $order_row['order_no'].', ';
                                }

                                $order_numbers       = substr($order_numbers, 0, -2);
                                $payment_description = 'Billing No: '.$billing_details['billing_no'].', Order No.: '.$order_numbers.' from Payment Method ID: '.$paymentMethod->id.' - method type (paymentMethod).';

                                $newPaymentIntent = Paymongo::paymentIntent()->create([
                                    'amount'                 => $billing_details['total_price'],
                                    'payment_method_allowed' => [
                                        'card'
                                    ],
                                    'payment_method_options' => [
                                        'card' => [
                                            'request_three_d_secure' => 'automatic'
                                        ]
                                    ],
                                    'description'          => $payment_description,
                                    'statement_descriptor' => 'Sayang PH - Billing No.: '.$billing_details['billing_no'],
                                    'currency'             => PaymentUtility::currency()
                                ]);

                                foreach($billing_details['orders'] as $order){
                                    $payment_log                      = OrderPaymentLog::find($order['order_payment_log_id']);
                                    $payment_log->api                 = 'paymongo';
                                    $payment_log->method              = 'paymentMethod';
                                    $payment_log->method_id           = $paymentMethod->id;
                                    $payment_log->paymongo_payment_id = $newPaymentIntent->id;
                                    $payment_log->save();
                                }

                                $response['payment_intent_success'] = false;
                                $response['payment_intent_error']   = 'An error occured on payment with your card while processing the transaction';

                                $paymentIntent               = Paymongo::paymentIntent()->find($newPaymentIntent->id);
                                $this->tmp_payment_intent_id = $paymentIntent->id;

                                if($paymentIntent->status !== 'awaiting_payment_method'){
                                    throw new \Exception('Uncaught Exception');
                                }else{
                                    try{
                                        $paymentIntentAttach = $paymentIntent->attach($paymentMethod->id);

                                        if($paymentIntentAttach->status === 'awaiting_next_action'){
                                            $next_action = $paymentIntentAttach->next_action;
                                            $response['payment_intent_success'] = true;
                                        }else if($paymentIntentAttach->status === 'succeeded'){
                                            $card_payment_success = $this->paymongo_pay_card($billing_details);
                                            
                                            if($card_payment_success['success']){
                                                $response['payment_intent_success'] = true;
                                                $payment_intent_product_posts = $card_payment_success['product_posts'];
                                            }
                                        }

                                    }catch(\Exception $ex){
                                        $paymentIntentException = json_decode($ex->getMessage());
                                        $paymentIntentMessage   = $paymentIntentException->errors[0];
                                        if($paymentIntentMessage->code === 'resource_failed_state'){
                                            $response['payment_intent_error'] = $paymentIntentMessage->detail;
                                        }
                                    }

                                }
                            }else if($payment_method['payment_method'] == 'cash_on_pickup'){
                                foreach($notification_details as $notify){
                                    
                                    // Web notification
                                    $partner_data = Partner::where('id' , $notify['partner_id'])->first();
                                    Utility::new_notification($partner_data->user_account_id , null , 'new_cop_request', 'order_updates');
                                            
                                    /* After the Transaction via COP, 
                                       Do the Notification via Email or Web 
                                    */
                                    // DATA: $notify['partner_id'], $notify['billing_no'], $notify['order_no'], $notify['user_account_id']
                                    
                                }                                
                            }

                            $response['success'] = true;
                        }
                    }catch(\Exception $e){
                    
                        // dd($e);
                        $response['success'] = false;
                    }
    
                    if($response['success']){
                        if(isset($paymongoSource)){
                            DB::commit();
                            return redirect($paymongoSource->getRedirect()['checkout_url']);
                        }else if(isset($paymentIntent)){
                            if(isset($response['payment_intent_success'])){
                                if($response['payment_intent_success']){
                                    if($paymentIntentAttach->status === 'awaiting_next_action'){
                                        DB::commit();
                                        $this->billing_details = $billing_details;
                                        $this->emit('payment_3d_secure', [
                                            'url' => $next_action['redirect']['url']
                                        ]);
                                    }else if($paymentIntentAttach->status === 'succeeded'){
                                        if(isset($payment_intent_product_posts) > 0){
                                            foreach($payment_intent_product_posts as $key => $product_post){
                                                event(new CheckOut($product_post));
                                            }
                                        }
                                        DB::commit();
                                        Session::flash('checkout_payment', ['success' => true, 'message' => '']);
                                        return redirect(route('front-end.user.my-purchase.list'));
                                    }else{
                                        $paymentIntent->cancel();
                                        DB::rollback();
                                        $this->emit('remove_loading_card', true);
                                        $this->emit('alert', [
                                            'type'    => 'error',
                                            'title'   => 'Failed',
                                            'message' => $response['payment_intent_error']
                                        ]);
                                    }
                                }else{
                                    $paymentIntent->cancel();
                                    DB::rollback();
                                    $this->emit('remove_loading_card', true);
                                    $this->emit('alert', [
                                        'type'    => 'error',
                                        'title'   => 'Failed',
                                        'message' => $response['payment_intent_error']
                                    ]);
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
                        }else if($payment_method['payment_method'] == 'cash_on_pickup'){
                            DB::commit();

                            Session::flash('checkout_payment', ['success' => true, 'message' => '']);
                            return redirect(route('front-end.user.my-purchase.list'));
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

    public function paymongo_pay_card($billing_details=null, $db_transact=false){
        $response      = ['success' => false, 'message' => ''];
        $product_posts = [];
        
        if(!$billing_details){
            $billing_details = $this->billing_details;
        }

        if(count($billing_details) <= 0){
            if($db_transact){
                $this->emit('remove_loading_card', true);
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Failed',
                    'message' => 'An error occured while in order transaction.'
                ]);
            }
            return $response;
        }

        if($db_transact){
            $paymentIntent = Paymongo::paymentIntent()->find($this->tmp_payment_intent_id);
            if(!$paymentIntent){
                $this->emit('remove_loading_card', true);
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Failed',
                    'message' => 'An error occured while in order transaction.'
                ]);
                return $response;
            }else{
                if($paymentIntent->status === 'processing'){
                    $this->emit('reprocess_payment_3d_completed', true);
                    return $response;
                }else if($paymentIntent->status !== 'succeeded'){
                    Session::flash('checkout_payment', ['success' => false, 'message' => '']);
                    return redirect(route('front-end.user.my-purchase.list'));
                }
            }

            DB::beginTransaction();
        }

        try{
            $checker = [];
            foreach($billing_details['orders'] as $order){
                $pay_response = PaymentUtility::pay_order($order['order_id']);
                if(!$pay_response['success']){
                    $checker[] = false;
                    $response['message'] = $pay_response['message'];
                    break;
                }else{
                    $product_posts[] = $pay_response['product_posts'];
                }
            }
            
            if(!in_array(false, $checker)){
                $response['success'] = true;
            }
        }catch(\Exception $e){

        }
        
        if($db_transact){
            if($response['success']){
                DB::commit();

                foreach($billing_details['orders'] as $order){
                    
                    // Web notification
                    $partner_data = Partner::where('id' , $order['partner_id'])->first();
                    Utility::new_notification($partner_data->user_account_id , null , 'new_product_sold', 'order_updates');
                                            
                }
                
                if(count($product_posts) > 0){
                    foreach($product_posts as $key => $product_post){
                        event(new CheckOut($product_post));
                    }
                }

                Session::flash('checkout_payment', ['success' => true, 'message' => '']);
            }else{
                DB::rollback();
                Session::flash('checkout_payment', ['success' => false, 'message' => '']);
            }

            return redirect(route('front-end.user.my-purchase.list'));
        }

        $response['product_posts'] = $product_posts;
        return $response;
    }

}
