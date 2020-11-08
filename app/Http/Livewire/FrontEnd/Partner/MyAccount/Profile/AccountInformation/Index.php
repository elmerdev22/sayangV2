<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\AccountInformation;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\UserAccount;
use DB;
use Auth;
use Utility;
use UploadUtility;
use App\Rules\MobileNo;

class Index extends Component
{
    use WithFileUploads;
    public $data, $account, $old_photo, $photo;
    public $first_name, $last_name, $middle_name, $gender, $contact_no, $birth_date;

    public function mount(){

        $this->account   = Utility::auth_user_account();
        $this->old_photo = UploadUtility::account_photo($this->account->key_token , 'profile-picture', 'profile');
        $this->data      = UserAccount::with(['user', 'partner'])
                        ->where('key_token', $this->account->key_token)
                        ->firstOrFail();

        $this->first_name  = $this->data->first_name;
        $this->last_name   = $this->data->last_name;
        $this->middle_name = $this->data->middle_name;
        $this->birth_date  = $this->data->birth_date;
        $this->gender      = $this->data->gender;
        $this->contact_no  = $this->data->contact_no;

    }

    public function render()
    {
        return view('livewire.front-end.partner.my-account.profile.account-information.index');
    }

    public function update_photo(){
        $rules = [
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ];
        
        $this->validate($rules);
        $response  = ['success' => false, 'message' => ''];
        $photo     = $this->photo->getRealPath();
        $file_name = $this->photo->getClientOriginalName();

        DB::beginTransaction();

        try{

            $collection = $this->account->key_token.'/profile-picture';
            $account    = UserAccount::where('key_token', $this->account->key_token)->firstOrFail();
            $account->clearMediaCollection($collection);
            $account->addMedia($photo)->usingFileName($file_name)->toMediaCollection($collection);
            $response['success'] = true;

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('updateProfile');
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Uploaded',
                'message' => 'Profile Picture Successfully Uploaded!'
            ]);
            $this->reset(['photo']);
            $this->mount();
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while updating profile picture'
            ]);
        }
    }
    
    public function cancel_upload_photo(){
        $this->reset(['photo']);
    }

    public function update_profile(){
        
        // $rules = [
		// 	'gender'     => 'in:male,female',
        //     'birth_date' => 'date',
        //     'contact_no' => ['unique:user_accounts', new MobileNo],
        // ];
        
        // $this->validate($rules);
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
            $this->emit('updateProfile');
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Updated',
                'message' => 'Profile Information Successfully Updated!'
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
