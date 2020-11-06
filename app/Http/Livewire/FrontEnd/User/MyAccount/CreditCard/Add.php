<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\CreditCard;

use Livewire\Component;
use Luigel\Paymongo\Facades\Paymongo;
use App\Model\UserAccountCreditCard;
use App\Rules\CreditCardNumber;
use Utility;
use DB;

class Add extends Component
{
    public $account, $card_holder, $card_no, $cvv, $is_default=false, $force_default;
    public $expiration_month, $expiration_year, $years=[], $months=[], $is_checkout_page;

    public function mount($is_checkout_page=false){
        $this->is_checkout_page = $is_checkout_page;
        $this->account          = Utility::auth_user_account();
        $exist_card             = UserAccountCreditCard::where('user_account_id', $this->account->id)->count();

        if($exist_card > 0){
            $this->force_default = false;
        }else{
            $this->force_default = true;
            $this->is_default    = true;
        }

        for($x = date('Y'); $x <= 2070; $x++){
            $this->years[] = $x;
        }

        for($x = 1; $x <= 12; $x++){
            $this->months[] = $x;
        }
    }

    public function render(){
        return view('livewire.front-end.user.my-account.credit-card.add');
    }

    public function store(){
        $rules = [
            'card_holder'      => 'required|min:2|max:191',
            'card_no'          => ['required', new CreditCardNumber()],
            'expiration_month' => 'required|numeric|in:'.implode(',', $this->months),
            'expiration_year'  => 'required|numeric|in:'.implode(',', $this->years),
            'cvv'              => 'required|max:4|min:3',
            'is_default'       => 'nullable'
        ];
        /* Validate the credit card here with Paymongo. (to follow) */

        $this->validate($rules);
        $response = ['success' => false];
        DB::beginTransaction();

        try{

            $user_account_card                          = new UserAccountCreditCard();
            $user_account_card->user_account_id         = $this->account->id;
            $user_account_card->card_no                 = $this->card_no;
            $user_account_card->card_holder             = $this->card_holder;
            $user_account_card->card_verification_value = $this->cvv;
            
            $month                                   = $this->expiration_month;
            $month                                   = sprintf("%02d", $month);
            $user_account_card->card_expiration_date = $this->expiration_year.'-'.$month.'-01';

            $user_account_card->is_default              = $this->is_default;
            $user_account_card->key_token               = Utility::generate_table_token('UserAccountCreditCard');

            if($this->is_default){
                $old_default = UserAccountCreditCard::where('is_default', true)
                    ->where('user_account_id', $this->account->id)
                    ->first();

                if($old_default){
                    $old_default->is_default = false;
                    $old_default->save();
                }
            }
            
            if($user_account_card->save()){
                $response['success'] = true;
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->reset(['force_default', 'cvv', 'card_no', 'card_holder', 'is_default']);
            
            $this->emit('credit_card_initialize', $user_account_card->key_token);
            if($this->is_checkout_page){
                $this->emit('alert', [
                    'type'    => 'success',
                    'title'   => 'Successfully Added',
                    'message' => 'Card Number Successfully Added and Selected.'
                ]);
            }else{
                $this->emit('alert', [
                    'type'    => 'success',
                    'title'   => 'Successfully Added',
                    'message' => 'Card Number Successfully Added.'
                ]);
            }

        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while adding the card number.'
            ]);
        }
    }
}