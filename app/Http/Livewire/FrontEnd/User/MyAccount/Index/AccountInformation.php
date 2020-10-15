<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\Index;

use Livewire\Component;
use App\Model\UserAccount;
use DB;
use Auth;
use Utility;

class AccountInformation extends Component
{
    public $account, $auth, $birth_date, $gender;
    
    protected $listerners = [
        'account_information_initialize' => '$refresh'
    ];

    public function mount(){
        $this->auth       = Auth::user();
        $this->account    = Utility::auth_user_account();
        $this->birth_date = $this->account->birth_date;
        $this->gender     = $this->account->gender;
    }

    public function render(){
        return view('livewire.front-end.user.my-account.index.account-information');
    }

    public function update(){
        $rules = [
            'gender'     => 'required|in:male,female',
            'birth_date' => 'required|date'
        ];

        $this->validate($rules);

        $response = ['success' => false, 'message' => '',];
        DB::beginTransaction();

        try{
            $account             = UserAccount::where('key_token', $this->account->key_token)->firstOrFail();
            $account->gender     = $this->gender;
            $account->birth_date = $this->birth_date;
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
                'message' => 'Gender & Birthdate Successfully Updated!'
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
