<?php

namespace App\Http\Livewire\FrontEnd\User\MyBid\Win;

use Luigel\Paymongo\Facades\Paymongo;
use Livewire\Component;
use App\Model\Product;
use App\Model\Bid;
use App\Model\Billing;
use App\Model\Partner;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\OrderBid;
use App\Model\OrderPayment;
use App\Model\OrderPaymentLog;
use App\Model\UserAccountAddress;
use App\Model\PhilippineBarangay;
use App\Model\UserAccountCreditCard;
use App\Events\CheckOut;
use SettingsUtility;
use UploadUtility;
use PaymentUtility;
use QueryUtility;
use Session;
use Utility;
use DB;

class PayNow extends Component
{
    public $order_id, $order_no, $bid_key_token=null, $payment_method, $account, $address, $winning_bid_expiration;
    public $e_wallet, $card, $total_price=0.00, $card_token, $available_e_wallets=[], $tmp_payment_method_id, $tmp_payment_intent_id;

    protected $listeners = [
        'bid_pay_now' => 'initialize'
    ];

    public function mount(){
        $this->account                = Utility::auth_user_account();
        $this->payment_method         = 'cash_on_pickup';
        $this->winning_bid_expiration = SettingsUtility::settings_value('winning_bid_expiration');
        $this->available_e_wallets    = PaymentUtility::active_e_wallet();
        $this->address();
    }

    public function initialize($param){
        $this->bid_key_token = $param['bid_key_token'];
    }

    public function data(){
        $filter = [];
        $filter['select'] = [
            'bids.id as bid_id', 
            'bids.quantity as bid_quantity', 
            'bids.bid as bid_price', 
            'bids.key_token as bid_key_token', 
            'products.id as product_id',
            'products.name as product_name',
            'products.slug as product_slug',
            'products.partner_id',
            'product_posts.date_start', 
            'product_posts.date_end', 
            'order_bids.id as order_bid_id', 
            'order_payments.payment_method', 
            'order_payments.status as order_payment_status' 
        ];
        $filter['where']['bids.key_token']      = $this->bid_key_token;
        $filter['where']['bids.status']         = 'win';
        $filter['where']['bids.winning_status'] = 'not_paid';
        
        return QueryUtility::bids($filter)->first();
    }

    public function credit_cards(){
        return UserAccountCreditCard::where('user_account_id', $this->account->id)
                    ->orderBy('is_default', 'desc')
                    ->get();
    }

    public function address($key_token=null){
        $data = UserAccountAddress::with(['philippine_barangay.philippine_city.philippine_province.philippine_region'])
            ->where('user_account_id', $this->account->id);
        
        if($key_token){
            $data = $data->where('key_token', $key_token);
        }else{
            $data = $data->where('is_default', true);
        }
        
        $this->address = $data->first();
    }

    public function set_e_wallet($type){
        $available_ewallet = [];
        foreach($this->available_e_wallets as $e_wallet_row){
            $available_ewallet[] = $e_wallet_row['key'];
        }
        
        if(in_array($type, $available_ewallet)){
            if($this->total_price >= PaymentUtility::paymongo_minimum()){
                $this->e_wallet   = $type;
                $this->card_token = null;
            }else{
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Oops...',
                    'message' => 'Minimum for '.str_replace('_', '', $type).' is PHP '.PaymentUtility::paymongo_minimum()
                ]);
            }
        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Oops...',
                'message' => 'Invalid E-Wallet.'
            ]);
        }

        $this->emit('remove_loading_card', true);
    }

    public function set_card_token($token){
        $card = UserAccountCreditCard::where('key_token', $token)->where('user_account_id', $this->account->id)->first();
        if($card){
            $this->card_token = $card->key_token;
        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Oops...',
                'message' => 'Invalid Card.'
            ]);
        }

        $this->emit('remove_loading_card', true);
    }

    public function render(){
        $data              = $this->data();
        $component         = $this;
        $credit_cards      = $this->credit_cards();
        
        if($data){
            $this->total_price = $data->bid_quantity * $data->bid_price;
        }

        return view('livewire.front-end.user.my-bid.win.pay-now', compact('data', 'component', 'credit_cards'));
    }

    public function product_featured_photo($product_id){
        $product        = Product::with(['partner', 'partner.user_account'])->findOrFail($product_id);
        $featured_photo = UploadUtility::product_featured_photo($product->partner->user_account->key_token, $product->key_token);

        return $featured_photo;
    }

    public function expiration($date_ended, $check_if_expired=false){
        if($check_if_expired){
            $end     = strtotime($date_ended.'+'.$this->winning_bid_expiration.' hours');
            $current = time();
            if($end >= $current){
                return false;
            }else{
                return true;
            }
        }else{
            $expiration = date('M/d/Y h:iA', strtotime($date_ended.'+'.$this->winning_bid_expiration.' hours'));
            return $expiration;
        }
    }
    
    public function change_payment_method($method){
        $allowed_method = PaymentUtility::allowed_method();

        if(in_array($method, $allowed_method)){
            $this->payment_method = $method;
        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Oops...',
                'message' => 'Invalid Payment Method.'
            ]);
        }

        $this->emit('remove_loading_card', true);
    }

    public function proceed(){
        $response = ['success'=>false, 'message'=>'Unable to process your request'];
        $data     = $this->data();
        
        DB::beginTransaction();

        try{
            $is_expired = $this->expiration($data->date_end, true);

            if(!$is_expired){
                if(!empty($this->address)){
                    $address = $this->address;
                    if(in_array($this->payment_method, PaymentUtility::allowed_method())){
                        if($this->payment_method == 'card'){
                            if($this->total_price >= PaymentUtility::paymongo_minimum()){
                                if(!empty($this->card_token)){
                                    $card = UserAccountCreditCard::where('key_token', $this->card_token)
                                        ->where('user_account_id', $this->account->id)
                                        ->first();
                                    if(!$card){
                                        $this->emit('alert', [
                                            'type'    => 'error',
                                            'title'   => 'Oops...',
                                            'message' => 'Invalid Card.'
                                        ]);
                                        $this->emit('remove_loading_card', true);
                                        return false;
                                    }
                                }else{
                                    $this->emit('alert', [
                                        'type'    => 'error',
                                        'title'   => 'Oops...',
                                        'message' => 'No Selected Credit/Debit Card.'
                                    ]);
                                    $this->emit('remove_loading_card', true);
                                    return false;
                                }
                            }else{
                                $this->emit('alert', [
                                    'type'    => 'error',
                                    'title'   => 'Oops...',
                                    'message' => 'Minimum for '.str_replace('_', '-', $this->payment_method).' is PHP '.PaymentUtility::paymongo_minimum()
                                ]);
                                $this->emit('remove_loading_card', true);
                                return false;
                            }
                        }else if($this->payment_method == 'e_wallet'){
                            if($this->total_price < PaymentUtility::paymongo_minimum()){
                                $this->emit('alert', [
                                    'type'    => 'error',
                                    'title'   => 'Oops...',
                                    'message' => 'Minimum for '.str_replace('_', '-', $this->payment_method).' is PHP '.PaymentUtility::paymongo_minimum()
                                ]);
                                $this->emit('remove_loading_card', true);
                                return false;
                            }else{
                                $available_ewallet = [];
                                foreach($this->available_e_wallets as $e_wallet_row){
                                    $available_ewallet[] = $e_wallet_row['key'];
                                }
                                if(!in_array($this->e_wallet, $available_ewallet)){
                                    $this->emit('alert', [
                                        'type'    => 'error',
                                        'title'   => 'Oops...',
                                        'message' => 'Invalid E-Wallet.'
                                    ]);
                                    $this->emit('remove_loading_card', true);
                                    return false;   
                                }
                            }
                        }else if($this->payment_method == 'cash_on_pickup'){
    
                        }else{
                            $this->emit('alert', [
                                'type'    => 'error',
                                'title'   => 'Oops...',
                                'message' => 'Invalid Payment Method.'
                            ]);
                            $this->emit('remove_loading_card', true);
                            return false;
                        }

                        $bid                      = Bid::findOrFail($data->bid_id);
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
                            $order                         = new Order();
                            $order->billing_id             = $billing->id;
                            $order->partner_id             = $data->partner_id;
                            $order->order_no               = Utility::generate_order_no();
                            $order->qr_code                = Utility::generate_table_token('Order', 'qr_code');
                            $order->status                 = 'order_placed';
                            $order->key_token              = Utility::generate_table_token('Order');
                            
                            if($order->save()){
                                $this->order_id              = $order->id;
                                $this->order_no              = $order->order_no;
                                $order_item                  = new OrderItem();
                                $order_item->order_id        = $order->id;
                                $order_item->product_post_id = $bid->product_post_id;
                                $order_item->quantity        = $data->bid_quantity;
                                $order_item->price           = $data->bid_price;
                                $order_item->key_token       = Utility::generate_table_token('OrderItem');
                                $order_item_saved            = $order_item->save();

                                if($order_item_saved){
                                    $order_bid           = new OrderBid();
                                    $order_bid->order_id = $order->id;
                                    $order_bid->bid_id   = $data->bid_id;
                                    $order_bid_saved     = $order_bid->save();
                                    
                                    if(!$order_bid_saved){
                                        throw new \Exception('Uncaught Exception');
                                    }
                                }else{
                                    throw new \Exception('Uncaught Exception');
                                }

                                $order_payment                 = new OrderPayment();
                                $order_payment->order_id       = $order->id;
                                $order_payment->payment_method = $this->payment_method;
                                
                                if($this->payment_method == 'card'){
                                    $order_payment->card_holder             = ucwords($card->card_holder);
                                    $order_payment->card_no                 = $card->card_no;
                                    $order_payment->card_expiration_date    = $card->card_expiration_date;
                                    $order_payment->card_verification_value = $card->card_verification_value;
                                }

                                $order_payment->status    = 'pending';
                                $order_payment->key_token = Utility::generate_table_token('OrderPayment');

                                if($order_payment->save()){
                                    $order_payment_log                   = new OrderPaymentLog();
                                    $order_payment_log->order_payment_id = $order_payment->id;
                                    $order_payment_log_saved             = $order_payment_log->save();

                                    if(!$order_payment_log_saved){
                                        throw new \Exception('Uncaught Exception');
                                    }
                                }else{
                                    throw new \Exception('Uncaught Exception');
                                }

                                $barangay = PhilippineBarangay::with(['philippine_city.philippine_province'])
                                ->find($billing->barangay_id);

                                $billing_address = [
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
                                
                                if($this->payment_method == 'e_wallet'){
                                    $paymongoSource = Paymongo::source()->create([
                                        'type'     => $this->e_wallet,
                                        'amount'   => $this->total_price,
                                        'currency' => PaymentUtility::currency(),
                                        'redirect' => [
                                            'success' => route('front-end.user.check-out.paymongo-repay-order-e-wallet', ['order_key_token' => $order->key_token, 'success' => true]),
                                            'failed'  => route('front-end.user.check-out.paymongo-repay-order-e-wallet', ['order_key_token' => $order->key_token, 'success' => false])
                                        ],
                                        'billing' => $billing_address
                                    ]);

                                    if($paymongoSource){
                                        $payment_log            = OrderPaymentLog::find($order_payment_log->id);
                                        $payment_log->method    = 'source';
                                        $payment_log->method_id = $paymongoSource->id;
                                        if($payment_log->save()){
                                            $response['success'] = true;
                                        }
                                    }
                                }else if($this->payment_method == 'card'){
                                    $exp_month = date('m', strtotime($card->card_expiration_date));
                                    $exp_year  = date('y', strtotime($card->card_expiration_date));

                                    $paymentMethod = Paymongo::paymentMethod()->create([
                                        'type'    => $this->payment_method,
                                        'details' => [
                                            'card_number' => str_replace('-', '', $card->card_no),
                                            'exp_month'   => (int)$exp_month,
                                            'exp_year'    => (int)$exp_year,
                                            'cvc'         => $card->card_verification_value
                                        ],
                                        'billing' => $billing_address
                                    ]);

                                    $this->tmp_payment_method_id = $paymentMethod->id;
                                    $payment_description         = 'Billing No: '.$billing->billing_no.', Order No.: '.$order->order_no.' from Payment Method ID: '.$paymentMethod->id.' - method type (paymentMethod).';
                                    
                                    $newPaymentIntent = Paymongo::paymentIntent()->create([
                                        'amount'                 => $this->total_price,
                                        'payment_method_allowed' => [
                                            'card'
                                        ],
                                        'payment_method_options' => [
                                            'card' => [
                                                'request_three_d_secure' => 'automatic'
                                            ]
                                        ],
                                        'description'          => $payment_description,
                                        'statement_descriptor' => 'Sayang PH - Billing No.: '.$billing->billing_no,
                                        'currency'             => PaymentUtility::currency()
                                    ]);
                                    $this->tmp_payment_intent_id = $newPaymentIntent->id;
                                    $paymentIntent               = Paymongo::paymentIntent()->find($newPaymentIntent->id);
                                    $response['message']         = 'An error occured on payment with your card while processing the transaction';
                                    
                                    if($paymentIntent->status !== 'awaiting_payment_method'){
                                        throw new \Exception('Uncaught Exception');
                                    }else{
                                        try{
                                            $paymentIntentAttach = $paymentIntent->attach($paymentMethod->id);
    
                                            if($paymentIntentAttach->status === 'awaiting_next_action'){
                                                $next_action             = $paymentIntentAttach->next_action;
                                                $response['success']     = true;
                                                $response['next_action'] = true;
                                            }else if($paymentIntentAttach->status === 'succeeded'){
                                                $card_payment_success = $this->paymongo_pay_card();

                                                if($card_payment_success['success']){
                                                    $response['success'] = true;
                                                    $payment_intent_product_posts = $card_payment_success['product_posts'];
                                                }
                                            }
                                        
                                        }catch(\Exception $e){
                                            $paymentIntentException = json_decode($e->getMessage());
                                            $paymentIntentMessage   = $paymentIntentException->errors[0];
                                            if($paymentIntentMessage->code === 'resource_failed_state'){
                                                $response['message'] = $paymentIntentMessage->detail;
                                            }
                                        }
                                    }
                                }else if($this->payment_method == 'cash_on_pickup'){
                                    // Web notification
                                    $partner_data = Partner::find($data->partner_id);
                                    Utility::new_notification($partner_data->user_account_id , null , 'new_cop_request', 'order_updates');
                                    /* After the Transaction via COP, 
                                        Do the Notification via Email or Web 
                                    */
                                    // DATA: $notify['partner_id'], $notify['billing_no'], $notify['order_no'], $notify['user_account_id']
                                    $response['success'] = true;
                                }
                            }
                        }
                    }else{
                        $response['message'] = 'Invalid Payment Method.';
                    }
                }else{
                    $response['message'] = 'No billing address yet.';
                }
            }else{
                $response['message'] = 'Bid is already expired.';
            }
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            $response['success'] = false;
            $response['message'] = 'An error occured.';
        }


        if($response['success']){
            if($this->payment_method == 'cash_on_pickup'){
                DB::commit();
                $this->emit('alert_link', [
                    'type'     => 'success',
                    'title'    => 'Bid Order Success',
                    'message'  => 'Waiting for confirmation via cash on pickup',
                    'redirect' => route('front-end.user.my-purchase.track', ['id' => $order->order_no])
                ]);
            }else if($this->payment_method == 'card'){
                $order_payment                          = OrderPayment::find($order_payment->id);
                $order_payment->bank_id                 = null;
                $order_payment->payment_method          = 'card';
                $order_payment->card_holder             = ucwords($card->card_holder);
                $order_payment->card_no                 = $card->card_no;
                $order_payment->card_expiration_date    = $card->card_expiration_date;
                $order_payment->card_verification_value = $card->card_verification_value;
                $order_payment->account_no              = null;
                $order_payment->account_name            = null;

                $payment_log                      = OrderPaymentLog::where('order_payment_id', $order_payment->id)->first();
                $payment_log->method              = 'paymentMethod';
                $payment_log->method_id           = $paymentMethod->id;
                $payment_log->paymongo_payment_id = $paymentIntentAttach->id;
                $payment_log->save();
                
                if(isset($response['next_action'])){
                    $order_payment->save();
                    DB::commit();
                    $this->emit('payment_3d_secure', [
                        'url' => $next_action['redirect']['url']
                    ]);
                }else{
                    $order_payment->status                  = 'paid';
                    $order_payment->date_paid               = date('Y-m-d H:i:s');
                    $order_payment->save();
                    DB::commit();
                        
                    if(isset($payment_intent_product_posts) > 0){
                        event(new CheckOut($payment_intent_product_posts));
                    }

                    $this->emit('alert_link', [
                        'type'     => 'success',
                        'title'    => 'Bid Order Success',
                        'message'  => 'Order paid via Card',
                        'redirect' => route('front-end.user.my-purchase.track', ['id' => $order->order_no])
                    ]);
                }

                
            }else if($this->payment_method == 'e_wallet'){
                DB::commit();
                return redirect($paymongoSource->getRedirect()['checkout_url']);
            }else{
                DB::rollback();
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Failed',
                    'message' => $response['message']
                ]);
                $this->emit('remove_loading_card', true);
            }
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => $response['message']
            ]);
            $this->emit('remove_loading_card', true);
        }
    }

    public function paymongo_pay_card($db_transact=false){
        $response      = ['success' => false, 'message' => ''];
        $product_posts = [];
        
        if($db_transact){
            $paymentIntent = Paymongo::paymentIntent()->find($this->tmp_payment_intent_id);
            if(!$paymentIntent){
                $this->emit('remove_card_payment_method_loader', true);
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
                    return redirect(route('front-end.user.my-purchase.track', ['id' => $this->order_no]));
                }
            }

            DB::beginTransaction();
        }

        try{
            $pay_response = PaymentUtility::pay_order($this->order_id);
            if(!$pay_response['success']){
                $response['message'] = $pay_response['message'];
            }else{
                $response['success'] = true;
                $product_posts = $pay_response['product_posts'];
            }
        }catch(\Exception $e){

        }
        
        if($db_transact){
            if($response['success']){
                DB::commit();
                
                // Web notification
                $order        = Order::find($this->order_id);
                $partner_data = Partner::where('id' , $order->partner_id)->first();
                Utility::new_notification($partner_data->user_account_id , null , 'new_product_sold', 'order_updates');
                if(count($product_posts) > 0){
                    event(new CheckOut($product_posts));
                }
                Session::flash('checkout_payment', ['success' => true, 'message' => '']);
            }else{
                DB::rollback();
                Session::flash('checkout_payment', ['success' => false, 'message' => '']);
            }

            return redirect(route('front-end.user.my-purchase.track', ['id' => $this->order_no]));
        }

        $response['product_posts'] = $product_posts;
        return $response;
    }
}
