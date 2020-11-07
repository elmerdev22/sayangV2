<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\BusinessInformation;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\UserAccount;
use DB;
use Auth;
use Utility;
use UploadUtility;

class ProfileAndCoverPhoto extends Component
{
    use WithFileUploads;
    public $account, $old_store_photo, $store_photo, $old_cover_photo, $cover_photo;
    
    public function mount(){
        $this->account         = Utility::auth_user_account();
        $this->old_store_photo = UploadUtility::account_photo($this->account->key_token , 'busiess-information/store-photo', 'store_photo');
        $this->old_cover_photo = UploadUtility::account_photo($this->account->key_token , 'busiess-information/cover-photo', 'cover_photo');
    }
    public function render()
    {
        return view('livewire.front-end.partner.my-account.profile.business-information.profile-and-cover-photo');
    }

    public function update_store_photo(){
        $rules = [
            'store_photo' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ];
        
        $this->validate($rules);
        $response  = ['success' => false, 'message' => ''];
        $photo     = $this->store_photo->getRealPath();
        $file_name = $this->store_photo->getClientOriginalName();

        DB::beginTransaction();

        try{

            $collection = $this->account->key_token.'/busiess-information/store-photo';
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
                'message' => 'Store Photo Successfully Uploaded!'
            ]);
            $this->emit('close_modal', [
                'modal' => 'modal-edit_store_photo'
            ]);
            $this->reset(['store_photo']);
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

    public function update_cover_photo(){
        $rules = [
            'cover_photo' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ];
        
        $this->validate($rules);
        $response  = ['success' => false, 'message' => ''];
        $photo     = $this->cover_photo->getRealPath();
        $file_name = $this->cover_photo->getClientOriginalName();

        DB::beginTransaction();

        try{

            $collection = $this->account->key_token.'/busiess-information/cover-photo';
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
                'message' => 'Cover Photo Successfully Uploaded!'
            ]);
            $this->reset(['cover_photo']);
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

    public function cancel_upload_cover(){
        $this->reset(['cover_photo']);
    }
}
