<?php

namespace App\Http\Livewire\BackEnd\Partner\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;
use App\Model\User;
use UploadUtility;

class AccountInformation extends Component
{
	public $data, $can_activate=true, $photo_url;

	protected $listeners = [
		'account_info_initialize' => '$refresh'
	];

	public function mount($key_token){
        $this->photo_url = UploadUtility::account_photo($key_token, 'profile-picture', 'profile');
        $this->data      = UserAccount::with(['user', 'partner'])
					->where('key_token', $key_token)
					->firstOrFail();
		
		$this->can_activate = true;

		if(!$this->data->partner){
	        $this->can_activate = false;
		}else{
	        if($this->data->partner->status == 'pending'){
		        $this->can_activate = false;
	        }else if($this->data->partner->is_activated){
		        $this->can_activate = false;
	        }
		}
	}

    public function render(){
        return view('livewire.back-end.partner.profile.account-information');
    }

    public function activate(){
    	if($this->can_activate){
    		$partner 			   = Partner::find($this->data->partner->id);
    		$partner->is_activated = true;
    		$partner->save();

    		$this->can_activate = false;
    		$this->emit('account_info_initialize', true);
    		$this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Changed',
                'message' => 'Status Successfully Changed.'
            ]);
    	}else{
    		$this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'You won\'t able to activate this account.'
            ]);
    	}
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
