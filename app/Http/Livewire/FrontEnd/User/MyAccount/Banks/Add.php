<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\Banks;

use Livewire\Component;
use Luigel\Paymongo\Facades\Paymongo;
use App\Model\UserAccountBank;
use App\Model\Bank;
use PaymentUtility;
use Utility;
use DB;

class Add extends Component
{
    public $account, $account_no, $account_name, $bank, $is_default=false, $force_default;
    public $active_payments = [], $is_checkout_page;
    
    public function mount($is_checkout_page=false){
        $this->is_checkout_page = $is_checkout_page;
        $this->account          = Utility::auth_user_account();
        $exist_bank             = UserAccountBank::where('user_account_id', $this->account->id)->count();
        if($exist_bank > 0){
            $this->force_default = false;
        }else{
            $this->force_default = true;
            $this->is_default    = true;
        }

        $this->active_payments = PaymentUtility::active_payments();
    }

    public function banks(){
        return Bank::where('is_active', true)->orderBy('name', 'asc')->get();
    }

    public function render(){
        $component = $this;

        return view('livewire.front-end.user.my-account.banks.add', compact('component'));
    }

    public function store(){
        $rules = [
            'account_no'   => 'required|numeric',
            'account_name' => 'required|max:100',
            'bank'         => 'required|numeric|in:'.implode(',', $this->active_payments),
            'is_default'   => 'nullable'
        ];
        /* Validate the bank account here with Paymongo. (to follow) */

        $this->validate($rules);
        $response = ['success' => false];
        DB::beginTransaction();

        try{

            $user_account_bank                  = new UserAccountBank();
            $user_account_bank->user_account_id = $this->account->id;
            $user_account_bank->bank_id         = $this->bank;
            $user_account_bank->account_no      = $this->account_no;
            $user_account_bank->account_name    = $this->account_name;
            $user_account_bank->is_default      = $this->is_default;
            $user_account_bank->key_token       = Utility::generate_table_token('UserAccountBank');

            if($this->is_default){
                $old_default = UserAccountBank::where('is_default', true)
                    ->where('user_account_id', $this->account->id)
                    ->first();

                if($old_default){
                    $old_default->is_default = false;
                    $old_default->save();
                }
            }
            
            if($user_account_bank->save()){
                $response['success'] = true;
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->reset(['force_default', 'account_no', 'account_name', 'bank', 'is_default']);
            if($this->is_checkout_page){
                $this->emit('banks_initialize', $user_account_bank->key_token);
                $this->emit('alert', [
                    'type'    => 'success',
                    'title'   => 'Successfully Added',
                    'message' => 'Bank Account Successfully Selected & Added.'
                ]);
            }else{
                $this->emit('banks_initialize', true);
                $this->emit('alert', [
                    'type'    => 'success',
                    'title'   => 'Successfully Added',
                    'message' => 'Bank Account Successfully Added.'
                ]);
            }
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while adding the bank account.'
            ]);
        }
    }
}
