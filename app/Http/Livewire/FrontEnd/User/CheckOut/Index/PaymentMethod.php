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
    public $total_price=0.00, $available_e_wallets;
    
    protected $listeners = [
        'banks_initialize'       => 'initialize_payment_key_token',
        'credit_card_initialize' => 'initialize_payment_key_token'
    ];

    public function mount(){
        $this->account             = Utility::auth_user_account();
        $default_e_wallet          = PaymentUtility::active_e_wallet(true);
        $this->available_e_wallets = PaymentUtility::active_e_wallet();
        $cart                      = Utility::cart($this->account->id, true);
        $this->total_price         = $cart['total_price'];
        $min_amount                = $this->min_amount($default_e_wallet['key']);
    }

    public function min_amount($key){
        return PaymentUtility::e_wallet($key, 'minimum');
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
        }else if($this->payment_method == 'e_wallet'){

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
            if($this->total_price >= $this->min_amount($type)){
                $this->e_wallet = $type;
                $this->initialize_payment_key_token();
            }else{
                $this->emit('alert', [
                    'type'  => 'error',
                    'title' => 'Minimum for '.str_replace('_', '', $type).' is PHP '.$this->min_amount($type)
                ]);
            }
        }else{
            $this->emit('alert', [
                'type'  => 'error',
                'title' => 'Invalid E-Wallet.'
            ]);
        }

        $this->emit('remove_loading_card', true);
    }

    public function change_payment_method($method){
        if($method == 'e_wallet' || $method == 'card'){
            $this->payment_method = $method;
            $this->initialize_payment_key_token();
            $this->emit('remove_loading_card', true);
        }else{
            $this->emit('alert', [
                'type'  => 'error',
                'title' => 'Invalid Payment Method.'
            ]);
        }
    }
}
