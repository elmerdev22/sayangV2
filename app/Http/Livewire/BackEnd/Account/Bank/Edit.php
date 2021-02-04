<?php

namespace App\Http\Livewire\BackEnd\Account\Bank;

use Livewire\Component;
use App\Model\AdminBankAccount;
use App\Model\Bank;
use Utility;
use DB;

class Edit extends Component
{
    public $admin_bank_account_id=null, $is_active=true, $bank, $account_no, $account_name;
    
    protected $listeners = [
        'initialize_edit_bank' => 'initialize'
    ];

    public function initialize($param){
        if($param){
            $this->admin_bank_account_id = $param['admin_bank_account_id'];
            $this->is_active             = $param['is_active'];
            $this->bank                  = $param['bank'];
            $this->account_no            = $param['account_no'];
            $this->account_name          = $param['account_name'];
        }
    }

    public function banks(){
        return Bank::orderBy('name', 'asc')->get();    
    }

    public function render(){
        $banks = $this->banks();
        return view('livewire.back-end.account.bank.edit', compact('banks'));
    }

    public function update(){
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
            $bank               = AdminBankAccount::findOrFail($this->admin_bank_account_id);
            $bank->bank_id      = $this->bank;
            $bank->account_name = $this->account_name;
            $bank->account_no   = $this->account_no;
            $bank->is_active    = $this->is_active;
            
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
                'title'   => 'Successfully Updated',
                'message' => 'Bank Account Successfully Saved.'
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while updating the bank account.'
            ]);
        }
    }
}
