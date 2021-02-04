<?php

namespace App\Http\Livewire\BackEnd\Account\Bank;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\AdminBankAccount;

class Listing extends Component
{
    use WithPagination;

    protected $listeners = [
        'initialize_banks' => '$refresh'
    ];

    public function data(){
        return AdminBankAccount::with(['bank'])
            ->orderBy('is_active', 'desc')
            ->orderBy('created_at', 'asc')
            ->paginate(10);
    }

    public function render(){
        $data = $this->data();
        return view('livewire.back-end.account.bank.listing', compact('data'));
    }

    public function edit($key_token){
        $bank = AdminBankAccount::where('key_token', $key_token)->firstOrFail();
        $this->emit('initialize_edit_bank', [
            'admin_bank_account_id' => $bank->id,
            'is_active'             => $bank->is_active,
            'bank'                  => $bank->bank_id,
            'account_no'            => $bank->account_no,
            'account_name'          => $bank->account_name
        ]);
    }

    public function delete($key_token){
        $bank = AdminBankAccount::where('key_token', $key_token)->firstOrFail();
        $bank->delete();
        $this->emit('alert',[
            'type'    => 'success',
            'title'   => 'Successfully Deleted',
            'message' => 'Bank successfully deleted.'
        ]);
        $this->emit('initialize_banks', false);
    }
}
