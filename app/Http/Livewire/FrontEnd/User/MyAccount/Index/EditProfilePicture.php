<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\Index;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\UserAccount;
use DB;
use Auth;
use Utility;

class EditProfilePicture extends Component
{
    use WithFileUploads;
    public $photo, $account;

    public function mount(){
        $this->account = Utility::auth_user_account();
    }

    public function render(){
        return view('livewire.front-end.user.my-account.index.edit-profile-picture');
    }

    public function update(){
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
            $this->emit('profile_picture_initialize', true);
            $this->emit('edit_profile_picture_close_modal', true);
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Uploaded',
                'message' => 'Profile Picture Successfully Uploaded!'
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while updating profile picture'
            ]);
        }
    }
}
