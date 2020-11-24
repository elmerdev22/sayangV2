<?php

namespace App\Http\Livewire\FrontEnd\Partner\AccountActivation;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Model\RegionProvince;
use App\Rules\MobileNo;
use App\Model\Partner;
use App\Model\PartnerBankAccount;
use App\Model\Bank;
use App\Model\City;
use UploadUtility;
use QueryUtility;
use Validator;
use Utility;
use Auth;
use DB;

class BankDetails extends Component
{
    public $bank, $account_name, $account_number; 
    public $account, $is_new=true, $partner;

    protected $listeners = [
        'representative_details_success' => 'initialize'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->initialize();
    }

    public function initialize(){
        $partner = Partner::where('user_account_id', $this->account->id)->first();
        if($partner){
            $this->partner = $partner;
            $bank_account  = PartnerBankAccount::where('partner_id', $partner->id)->first();

            if($bank_account){
                $this->is_new         = false;
                $this->bank           = $bank_account->bank_id;
                $this->account_name   = $bank_account->account_name;
                $this->account_number = $bank_account->account_no;
            }
        }
    }

    public function banks(){
        return Bank::orderBy('name', 'asc')->get();
    }

    public function render(){
        $banks = $this->banks();
       
        return view('livewire.front-end.partner.account-activation.bank-details', compact('banks'));
    }

    public function update(){
        $rules = [
            'account_name'   => 'required|max:100',
            'account_number' => 'required|min:9|max:12',
            'bank'           => 'required|numeric'
        ];
        
        $messages  = [];
        $requests  = Utility::component_request($rules, $this);
        $validator = Validator::make($requests, $rules, $messages);
        
        if($validator->fails()){
            $this->emit('bank_details_input_errors', $validator->errors());
            return false;
        }

        $response = ['success' => false, 'message' => ''];
        DB::beginTransaction();

        try{
            $account = $this->account;
            $partner = $this->partner;
            if($partner){
                $bank_account  = PartnerBankAccount::where('partner_id', $partner->id)->first();
                
                if(!$bank_account){
                    $bank_account  = new PartnerBankAccount();
                    $bank_account->partner_id = $partner->id;
                    $bank_account->key_token = Utility::generate_table_token('PartnerBankAccount');
                }

                $bank_account->bank_id      = $this->bank;
                $bank_account->account_name = $this->account_name;
                $bank_account->account_no   = $this->account_number;
                
                if($bank_account->save()){
                    $response['success'] = true;
                }
            }
        }catch(\Exception $e){
            $response['message'] = 'An error occured.';            
        }

        if($response['success']){
            DB::commit();
            $this->emit('bank_details_success', ['success' => true]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured'
            ]);
        }
    }
}
