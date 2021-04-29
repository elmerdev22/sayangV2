<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Livewire\Component;
use App\Model\UserAccountBank;
use App\Model\UserAccountCreditCard;
use PaymentUtility;
use Utility;

class PaymentMethod extends Component
{
    public $account, $payment_method = 'e_wallet', $payment_key_token, $e_wallet=null;
    public $total_price=0.00, $available_e_wallets, $paymongo_minimum;
    
    protected $listeners = [
        'banks_initialize'       => 'initialize_payment_key_token',
        'credit_card_initialize' => 'initialize_payment_key_token'
    ];

    public function mount(){
        $this->paymongo_minimum = PaymentUtility::paymongo_minimum();
        $this->account          = Utility::auth_user_account();
        $cart                   = Utility::cart($this->account->id, true);
        $this->total_price      = $cart['total_price'];
        
        if($this->total_price >= $this->paymongo_minimum){
            $default_e_wallet = PaymentUtility::active_e_wallet(true);
        }else{
            $this->payment_method = 'cash_on_pickup';
        }

        $this->available_e_wallets = PaymentUtility::active_e_wallet();
    }

    public function credit_cards(){
        return UserAccountCreditCard::where('user_account_id', $this->account->id)
                    ->orderBy('is_default', 'desc')
                    ->get();
    }

    public function banks(){
        return UserAccountBank::with(['bank'])
            ->where('user_account_id', $this->account->id)
            ->orderBy('is_default', 'desc')
            ->get();
    }

    public function initialize_payment_key_token($key_token=null){
        $this->payment_key_token = null;
        
        if($this->payment_method == 'card'){
            $card = UserAccountCreditCard::where('user_account_id', $this->account->id);

            if(!empty($key_token) && $key_token != $this->payment_key_token){
                $card = $card->where('key_token', $key_token)->firstOrFail();
            }else{
                $card = $card->where('is_default', true)->first();
            }

            if($card){
                $this->payment_key_token = $card->key_token;
            }else{
                $this->payment_key_token = null;
            }
            $this->e_wallet = null;
        }else if($this->payment_method == 'e_wallet'){

        }else if($this->payment_method == 'cash_on_pickup'){
            $this->e_wallet = null;
        }

        $this->emit('set_payment_method', [
            'payment_method'    => $this->payment_method,
            'payment_key_token' => $this->payment_key_token,
            'payment_e_wallet'  => $this->e_wallet
        ]);
        $this->emit('remove_loading_card', true);
    }

    public function render(){
        $banks        = $this->banks();
        $credit_cards = $this->credit_cards();
        $component    = $this;
        return view('livewire.front-end.user.check-out.index.payment-method', compact('banks', 'credit_cards', 'component'));
    }

    public function set_e_wallet($type){
        $available_ewallet = [];
        foreach($this->available_e_wallets as $e_wallet_row){
            $available_ewallet[] = $e_wallet_row['key'];
        }
        
        if(in_array($type, $available_ewallet)){
            if($this->total_price >= $this->paymongo_minimum){
                $this->e_wallet = $type;
                $this->initialize_payment_key_token();
            }else{
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Oops...',
                    'message' => 'Minimum for '.str_replace('_', '', $type).' is PHP '.$this->paymongo_minimum
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

    public function change_payment_method($method){
        $allowed_method = PaymentUtility::allowed_method();

        if(in_array($method, $allowed_method)){
            $this->payment_method = $method;
            $this->initialize_payment_key_token();
        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Oops...',
                'message' => 'Invalid Payment Method.'
            ]);
        }

        $this->emit('remove_loading_card', true);
    }
}
