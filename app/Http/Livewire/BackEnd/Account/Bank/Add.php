<?php

namespace App\Http\Livewire\BackEnd\Account\Bank;

use Livewire\Component;
use App\Model\AdminBankAccount;
use App\Model\Bank;
use Utility;
use DB;

class Add extends Component
{
    public $is_active=true, $bank, $account_no, $account_name;

    public function banks(){
        return Bank::orderBy('name', 'asc')->get();    
    }

    public function render(){
        $banks = $this->banks();

        return view('livewire.back-end.account.bank.add', compact('banks'));
    }

    public function store(){
        $rules = [
            'account_no'   => 'required|numeric',
            'account_name' => 'required|max:100',
            'bank'         => 'required|numeric',
            'is_active'    => 'nullable'
        ];

        $this->validate($rules);
        $response = ['success' => false];
        
        DB::beginTransaction();

        try{
            $bank               = new AdminBankAccount();
            $bank->bank_id      = $this->bank;
            $bank->account_name = $this->account_name;
            $bank->account_no   = $this->account_no;
            $bank->is_active    = $this->is_active;
            $bank->key_token    = Utility::generate_table_token('AdminBankAccount');
            
            if($bank->save()){
                $response['success'] = true;
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->reset();
            $this->emit('initialize_banks', true);
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Added',
                'message' => 'Bank Account Successfully Added.'
            ]);
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
