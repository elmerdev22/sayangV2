<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\Index;

use Livewire\Component;
use App\Model\UserAccount;
use DB;
use Auth;
use UploadUtility;

class ProfilePicture extends Component
{
    public $account, $auth, $photo_url;

    public function mount(){
        $this->auth = Auth::user();
        $this->initialize();
    }
    
    public function initialize(){
        $this->account   = UserAccount::where('user_id', $this->auth->id)->firstOrFail();
        $this->photo_url = UploadUtility::profile_picture($this->account->key_token);
    }

    public function render(){
        return view('livewire.front-end.user.my-account.index.profile-picture');
    }
}
