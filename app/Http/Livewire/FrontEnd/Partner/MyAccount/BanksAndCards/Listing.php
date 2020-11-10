<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\BanksAndCards;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;
use App\Model\PartnerBankAccount;
use App\Model\Bank;
use Utility;
use DB;
class Listing extends Component
{
    public $my_banks, $banks_list;
    public $bank, $account_name, $account_number, $key_token;
    public function mount(){
		$account = Utility::auth_user_account();
		$partner = Partner::with(['partner_bank_accounts', 'partner_bank_accounts.bank'])
						->where('user_account_id', $account->id)
						->first();
		if($partner){
			$this->my_banks = $partner->partner_bank_accounts()->get();
		}
	}

    public function render(){

		$this->banks_list = $this->banks();
        return view('livewire.front-end.partner.my-account.banks-and-cards.listing');
	}
	
	public function banks(){
        return Bank::orderBy('name', 'asc')->get();
	}
	
	public function edit($key_token){

		$bank = PartnerBankAccount::where('key_token', $key_token)->first();

		$this->bank           = $bank->bank_id;
		$this->account_name   = $bank->account_name;
		$this->account_number = $bank->account_no;
		$this->key_token      = $key_token;

	}

    public function update(){

        $rules = [
			'bank'           => 'required',
			'account_name'   => 'required',
			'account_number' => 'required',
        ];
        
		$this->validate($rules);
		
        $response = ['success' => false, 'message' => '',];
        DB::beginTransaction();

        try{
			$bank               = PartnerBankAccount::where('key_token', $this->key_token)->first();
			$bank->bank_id      = $this->bank;
			$bank->account_name = $this->account_name;
			$bank->account_no   = $this->account_number;

            if($bank->save()){
                $response['success'] = true;
            }
        }catch(\Exception $e){

        }

        if($response['success']){
            DB::commit();
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Updated',
                'message' => 'Bank Details Successfully Updated!'
            ]);
            $this->mount();
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while updating information'
            ]);
        }
    }
}
