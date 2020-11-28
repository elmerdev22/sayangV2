<?php

namespace App\Http\Livewire\FrontEnd\User\MyPurchase\Track;

use Livewire\Component;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\OrderPayment;
use App\Model\OrderPaymentLog;
use App\Model\UserAccountCreditCard;
use Luigel\Paymongo\Facades\Paymongo;
use PaymentUtility;
use Utility;
use DB;

class PayNow extends Component
{
    public $account, $order_id, $order_no, $payment_method='e_wallet';
    public $card_token, $e_wallet, $available_e_wallets=[], $total_price=0.00;

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
        $response = ['success' => false, 'message' => ''];

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
                                    dd($e);
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
}
