<?php

namespace App\Http\Livewire\BackEnd\User\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\User;
use UploadUtility;

class AccountInformation extends Component
{
	public $data, $photo_url;
    
    protected $listeners = [
        'account_info_initialize' => '$refresh'
    ];

	public function mount($key_token){
        $this->photo_url = UploadUtility::account_photo($key_token, 'profile-picture', 'profile');
        $this->data      = UserAccount::with(['user'])
					->where('key_token', $key_token)
                    ->firstOrFail();
	}

    public function render(){
        return view('livewire.back-end.user.profile.account-information');
    }

    public function change_block_status(){
        $user             = User::find($this->data->user_id);
        if($user->is_blocked){
            $new_status = false;
            $type       = 'Unblock';
        }else{
            $new_status = true;
            $type       = 'Block';
        }

        $user->is_blocked = $new_status;
        $user->save();

        $this->emit('account_info_initialize', true);
        $this->emit('alert', [
            'type'    => 'success',
            'title'   => 'Successfully '.$type
        ]);
    }
}
