<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\Index;

use Livewire\Component;
use App\Model\UserAccount;
use App\Rules\MobileNo;
use DB;
use Auth;
use Utility;

class AccountInformation extends Component
{
    public $account, $auth, $first_name, $last_name, $middle_name, $gender, $birth_date, $contact_no ,$old_contact_no;
    
    protected $listeners = [
        'account_information_initialize' => '$refresh'
    ];

    public function mount(){
        $this->auth           = Auth::user();
        $this->account        = Utility::auth_user_account();
        $this->birth_date     = $this->account->birth_date;
        $this->gender         = $this->account->gender;
        $this->first_name     = $this->account->first_name;
        $this->last_name      = $this->account->last_name;
        $this->middle_name    = $this->account->middle_name;
        $this->contact_no     = $this->account->contact_no;
        $this->old_contact_no = $this->account->contact_no;
    }

    public function render(){
        return view('livewire.front-end.user.my-account.index.account-information');
    }

    public function update(){
        
        $rules = [
			'first_name' => 'required',
			'last_name'  => 'required',
			'gender'     => 'required|in:male,female',
			'birth_date' => 'required|date'
        ];

        if($this->old_contact_no != $this->contact_no){
            $rules = [
                'contact_no' => ['required', 'unique:user_accounts', new MobileNo],
            ];
        }
        
        $this->validate($rules);

        $response = ['success' => false, 'message' => '',];
        DB::beginTransaction();

        try{
            $account              = UserAccount::where('key_token', $this->account->key_token)->firstOrFail();
            $account->gender      = $this->gender;
            $account->birth_date  = $this->birth_date;
            $account->first_name  = $this->first_name;
            $account->last_name   = $this->last_name;
            $account->middle_name = $this->middle_name;
            $account->contact_no  = $this->contact_no;

            if($account->save()){
                $response['success'] = true;
            }
        }catch(\Exception $e){

        }

        if($response['success']){
            DB::commit();
            $this->emit('account_information_initialize', true);
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Updated',
                'message' => 'Profile Information Successfully Updated!'
            ]);
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
