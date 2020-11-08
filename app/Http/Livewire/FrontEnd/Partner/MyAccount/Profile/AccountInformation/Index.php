<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\AccountInformation;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\UserAccount;
use DB;
use Auth;
use Utility;
use UploadUtility;

class Index extends Component
{
    use WithFileUploads;
    public $data, $account, $old_photo, $photo;

    public function mount(){

        $this->account   = Utility::auth_user_account();
        $this->old_photo = UploadUtility::account_photo($this->account->key_token , 'profile-picture', 'profile');
        $this->data      = UserAccount::with(['user', 'partner'])
                        ->where('key_token', $this->account->key_token)
                        ->firstOrFail();
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
}
