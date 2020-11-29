<?php

namespace App\Http\Livewire\FrontEnd\User\MyPurchase\Track;

use Luigel\Paymongo\Facades\Paymongo;
use Livewire\Component;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\OrderPayment;
use App\Model\OrderPaymentLog;
use App\Model\UserAccountCreditCard;
use App\Events\CheckOut;
use PaymentUtility;
use Utility;
use Session;
use DB;

class PayNow extends Component
{
    public $account, $order_id, $order_no, $payment_method='e_wallet';
    public $card_token, $e_wallet, $available_e_wallets=[], $total_price=0.00, $tmp_payment_intent_id, $tmp_payment_method_id;

    public function mount($order_no){
        $this->order_no            = $order_no;
        $this->order_id            = Order::where('order_no', $this->order_no)->first()->id;
        $this->account             = Utility::auth_user_account();
        $this->available_e_wallets = PaymentUtility::active_e_wallet();
        $this->total_price         = Utility::order_total($this->order_id)['total'];
    }

    public function credit_cards(){
        return UserAccountCreditCard::where('user_account_id', $this->account->id)
                    ->orderBy('is_default', 'desc')
                    ->get();
    }

    public function render(){
        $credit_cards = $this->credit_cards();
        return view('livewire.front-end.user.my-purchase.track.pay-now', compact('credit_cards'));
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
                    'type'  => 'error',
                    'title' => 'Minimum for '.str_replace('_', '', $type).' is PHP '.PaymentUtility::paymongo_minimum()
                ]);
            }
        }else{
            $this->emit('alert', [
                'type'  => 'error',
                'title' => 'Invalid E-Wallet.'
            ]);
        }

        $this->emit('remove_card_payment_method_loader', true);
    }

    public function set_card_token($token){
        $card = UserAccountCreditCard::where('key_token', $token)->where('user_account_id', $this->account->id)->first();
        if($card){
            $this->card_token = $card->key_token;
        }else{
            $this->emit('alert', [
                'type'  => 'error',
                'title' => 'Invalid Card.'
            ]);
        }

        $this->emit('remove_card_payment_method_loader', true);
    }

    public function change_payment_method($method){
        if($method == 'e_wallet' || $method == 'card'){
            $this->payment_method = $method;
            $this->e_wallet       = null;
            $this->card_token     = null;
        }else{
            $this->emit('alert', [
                'type'  => 'error',
                'title' => 'Invalid Payment Method.'
            ]);
        }

        $this->emit('remove_card_payment_method_loader', true);
    }

    public function proceed(){
        $response = ['success' => false, 'message' => 'An error occured.'];

        $can_repay = Utility::order_can_repay($this->order_id);

        if($can_repay){
            if($this->total_price >= PaymentUtility::paymongo_minimum()){
                // Do the payment API here...
                if(!empty($this->payment_method)){
                    $order = Order::with([
                            'order_payment.order_payment_log',
                            'billing.philippine_barangay.philippine_city.philippine_province'
                        ])
                        ->find($this->order_id);

                    $billing = [
                        'name'    => ucwords($order->billing->full_name),
                        'phone'   => $order->billing->contact_no,
                        'email'   => $order->billing->email,
                        'address' => [
                            'line1'       => ucfirst($order->billing->philippine_barangay->name),
                            'line2'       => ucfirst($order->billing->address),
                            'postal_code' => $order->billing->zip_code,
                            'state'       => ucfirst($order->billing->philippine_barangay->philippine_city->philippine_province->name),
                            'city'        => ucfirst($order->billing->philippine_barangay->philippine_city->name),
                            'country'     => PaymentUtility::billing_country()
                        ]
                    ];

                    $payment_log = OrderPaymentLog::find($order->order_payment->order_payment_log->id);
                    
                    if($this->payment_method == 'e_wallet'){
                        // E-Wallet
                        if(!empty($this->e_wallet)){
                            $available_ewallet = [];
                            foreach($this->available_e_wallets as $e_wallet_row){
                                $available_ewallet[] = $e_wallet_row['key'];
                            }
                            
                            if(in_array($this->e_wallet, $available_ewallet)){
                                // Valid E-Wallet
                                DB::beginTransaction();
                                try{
                                    $paymongoSource = Paymongo::source()->create([
                                        'type'     => $this->e_wallet,
                                        'amount'   => $this->total_price,
                                        'currency' => PaymentUtility::currency(),
                                        'redirect' => [
                                            'success' => route('front-end.user.check-out.paymongo-repay-order-e-wallet', ['order_key_token' => $order->key_token, 'success' => true]),
                                            'failed'  => route('front-end.user.check-out.paymongo-repay-order-e-wallet', ['order_key_token' => $order->key_token, 'success' => false])
                                        ],
                                        'billing' => $billing
                                    ]);

                                    if($paymongoSource){
                                        $payment_log->method    = 'source';
                                        $payment_log->method_id = $paymongoSource->id;
                                        if($payment_log->save()){
                                            $response['success'] = true;
                                        }
                                    }

                                }catch(\Exception $e){
                                    // dd($e);
                                }

                                if($response['success']){
                                    DB::commit();
                                    return redirect($paymongoSource->getRedirect()['checkout_url']);
                                }else{
                                    DB::rollback();
                                    $this->emit('alert', [
                                        'type'    => 'error',
                                        'title'   => 'Failed',
                                        'message' => 'An error occured.'
                                    ]);
                                }
                            }else{
                                $this->emit('alert', [
                                    'type'    => 'error',
                                    'title'   => 'Invalid E-Wallet Type',
                                    'message' => 'Unable to process this request.'
                                ]);
                            }
                        }else{
                            $this->emit('alert', [
                                'type'    => 'error',
                                'title'   => 'Please Select E-Wallet Type.'
                            ]);
                        }
                    }else if($this->payment_method == 'card'){
                        // Card
                        if(!empty($this->card_token)){
                            $card = UserAccountCreditCard::where('key_token', $this->card_token)
                                ->where('user_account_id', $this->account->id)
                                ->first();

                            if($card){
                                // Card Found
                                DB::beginTransaction();

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
                                    'billing' => $billing
                                ]);

                                $this->tmp_payment_method_id = $paymentMethod->id;
                                $payment_description         = 'Billing No: '.$order->billing->billing_no.', Order No.: '.$order->order_no.' from Payment Method ID: '.$paymentMethod->id.' - method type (paymentMethod).';
                                
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
                                    'statement_descriptor' => 'Sayang PH - Billing No.: '.$order->billing->billing_no,
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
                                        $paymentIntentException = json_decode($ex->getMessage());
                                        $paymentIntentMessage   = $paymentIntentException->errors[0];
                                        if($paymentIntentMessage->code === 'resource_failed_state'){
                                            $response['message'] = $paymentIntentMessage->detail;
                                        }
                                    }
                                }


                                $this->emit('remove_card_payment_method_loader', true);

                                if($response['success']){

                                    $order_payment                          = OrderPayment::find($order->order_payment->id);
                                    $order_payment->bank_id                 = null;
                                    $order_payment->payment_method          = 'card';
                                    $order_payment->card_holder             = ucwords($card->card_holder);
                                    $order_payment->card_no                 = $card->card_no;
                                    $order_payment->card_expiration_date    = $card->card_expiration_date;
                                    $order_payment->card_verification_value = $card->card_verification_value;
                                    $order_payment->account_no              = null;
                                    $order_payment->account_name            = null;

                                    $payment_log                      = OrderPaymentLog::find($order->order_payment->order_payment_log->id);
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

                                        Session::flash('checkout_payment', ['success' => true, 'message' => '']);
                                        return redirect(route('front-end.user.my-purchase.track', ['id' => $this->order_no]));
                                    }
                                }else{
                                    $this->emit('alert', [
                                        'type'    => 'error',
                                        'title'   => 'Failed',
                                        'message' => $response['message']
                                    ]);
                                }
                                
                            }else{
                                $this->emit('alert', [
                                    'type'    => 'error',
                                    'title'   => 'Card Not Found',
                                    'message' => 'Unable to process this request.'
                                ]);
                            }
                        }else{
                            $this->emit('alert', [
                                'type'    => 'error',
                                'title'   => 'Please Select Card'
                            ]);
                        }
                    }else{
                        $this->emit('alert', [
                            'type'    => 'error',
                            'title'   => 'Invalid Payment Method',
                            'message' => 'Unable to process this request.'
                        ]);
                    }
                }else{
                    $this->emit('alert', [
                        'type'    => 'error',
                        'title'   => 'Please select payment method'
                    ]);
                }
            }else{
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Failed',
                    'message' => 'Minimum Total Price is PHP '.number_format(PaymentUtility::paymongo_minimum(),2)
                ]);
            }
        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Order expired',
                'message' => 'Unable to process this request.'
            ]);
        }

        $this->emit('remove_card_payment_method_loader', true);
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
                Session::flash('checkout_payment', ['success' => true, 'message' => '']);
            }else{
                DB::rollback();
                Session::flash('checkout_payment', ['success' => false, 'message' => '']);
            }

            if(count($product_posts) > 0){
                event(new CheckOut($product_posts));
            }

            return redirect(route('front-end.user.my-purchase.track', ['id' => $this->order_no]));
        }

        $response['product_posts'] = $product_posts;
        return $response;
    }
}
