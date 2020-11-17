<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Livewire\Component;
use App\Model\UserAccountBank;
use App\Model\UserAccountCreditCard;
use Utility;

class PaymentMethod extends Component
{
    public $account, $payment_method = 'e_wallet', $payment_key_token;
    protected $listeners = [
        'banks_initialize'       => 'initialize_payment_key_token',
        'credit_card_initialize' => 'initialize_payment_key_token'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->initialize_payment_key_token();
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
        
        if($this->payment_method == 'e_wallet' || $this->payment_method == 'card'){
            if($this->payment_method == 'e_wallet'){
                $default = UserAccountBank::where('user_account_id', $this->account->id);
            }else{
                $default = UserAccountCreditCard::where('user_account_id', $this->account->id);
            }

            if($key_token && $key_token != $this->payment_key_token){
                $default = $default->where('key_token', $key_token)->firstOrFail();
            }else{
                $default = $default->where('is_default', true)->first();
            }

            if($default){
                $this->payment_key_token = $default->key_token;
                $this->emit('set_payment_method', [
                    'payment_method'    => $this->payment_method,
                    'payment_key_token' => $this->payment_key_token
                ]);
            }else{
                $this->payment_key_token = null;
                $this->emit('set_payment_method', []);
            }
        }
    }

    public function render(){
        $banks        = $this->banks();
        $credit_cards = $this->credit_cards();
        return view('livewire.front-end.user.check-out.index.payment-method', compact('banks', 'credit_cards'));
    }

    public function change_payment_method($method){
        if($method == 'e_wallet' || $method == 'card'){
            $this->payment_method = $method;
            $this->initialize_payment_key_token();
            $this->emit('remove_loading_card', true);
        }else{
            $this->emit('alert', [
                'type'  => 'error',
                'title' => 'Invalid Payment Method'
            ]);
        }
    }
}
