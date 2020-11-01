<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\Banks;

use Livewire\Component;
use App\Model\UserAccountBank;
use Utility;

class Listing extends Component
{
    public $account, $banks=[];
    protected $listeners = [
        'initialize_banks' => '$refresh'
    ];
    
    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->banks   = UserAccountBank::with(['banks'])
                        ->where('user_account_id', $this->account->id)
                        ->get();
    }

    public function render(){
        return view('livewire.front-end.user.my-account.banks.listing');
    }
}
