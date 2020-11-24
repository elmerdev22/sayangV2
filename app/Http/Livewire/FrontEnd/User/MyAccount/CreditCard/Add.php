<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\CreditCard;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Luigel\Paymongo\Facades\Paymongo;
use App\Model\UserAccountCreditCard;
use App\Rules\MobileNo;
use App\Rules\CreditCardNumber;
use Utility;
use DB;

class Add extends Component
{
    public $account, $card_holder, $card_no, $cvv, $is_default=false, $force_default;
    public $expiration_month, $expiration_year, $years=[], $months=[], $is_checkout_page, $error_message;
    public $email, $mobile_no;

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

        if($this->account->contact_no){
            $this->mobile_no = $this->account->contact_no;
        }

        if(auth()->user()->email){
            $this->email = auth()->user()->email;
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
        $this->error_message = '';
        $account_id          = $this->account->id;

        if(strlen($this->card_no) == 16){
            $this->card_no = chunk_split($this->card_no, 4, '-');
            $this->card_no = rtrim($this->card_no, "-");
        }
        $card_no             = $this->card_no;

        $rules = [
            'card_holder'      => 'required|min:2|max:191',
            'card_no'          => [ 
                                    'required', new CreditCardNumber(), 
                                    Rule::unique('user_account_credit_cards')->where(function ($query) use($account_id, $card_no){
                                        return $query->where('user_account_id', $account_id)
                                            ->where('card_no', $card_no);
                                    }),
                                ],
            'email'            => 'required|email',
            'mobile_no'        => ['required', new MobileNo()],
            'expiration_month' => 'required|numeric|in:'.implode(',', $this->months),
            'expiration_year'  => 'required|numeric|in:'.implode(',', $this->years),
            'cvv'              => 'required|max:4|min:3',
            'is_default'       => 'nullable'
        ];
        $this->validate($rules);
        $month = $this->expiration_month;
        $month = sprintf("%02d", $month);

        /* Validate the credit card here with Paymongo. (to follow) */
        try{
            $paymongo = Paymongo::paymentMethod()->create([
                'type' => 'card',
                'details' => [
                    'card_number' => str_replace('-', '',$this->card_no),
                    'exp_month'   => (int)$month,
                    'exp_year'    => (int)$this->expiration_year,
                    'cvc'         => $this->cvv,
                ],
                'billing' => [
                    'name'  => ucwords($this->card_holder),
                    'email' => $this->email,
                    'phone' => $this->mobile_no
                ],
            ]);
            $success = true;
        }catch(\Exception $e){
            $success   = false;
            $exception = json_decode($e->getMessage());
            $message   = $exception->errors[0];
            if($message->code){
                $error_message = ucfirst(str_replace('_', ' ', str_replace('details.card_number', 'Card number', $message->detail)));
            }else{
                $error_message = ucfirst(str_replace('_', ' ', $message->detail));
            }
        }

        if(!$success){
            $this->error_message = $error_message;
            return false;
        }
        /* End of validation via paymongo */ 

        $response = ['success' => false];
        DB::beginTransaction();

        try{

            $user_account_card                          = new UserAccountCreditCard();
            $user_account_card->user_account_id         = $this->account->id;
            
            if($paymongo){
                $user_account_card->paymongo_resource_id = $paymongo->id;
                $user_account_card->paymongo_resource    = 'paymentMethod';
            }
            
            $user_account_card->card_no                 = $this->card_no;
            $user_account_card->card_holder             = $this->card_holder;
            $user_account_card->card_verification_value = $this->cvv;
            $user_account_card->card_expiration_date    = $this->expiration_year.'-'.$month.'-01';

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