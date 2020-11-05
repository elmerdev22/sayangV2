<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Livewire\Component;
use App\Model\UserAccountAddress;
use Utility;

class SelectOtherAddress extends Component
{
    public $account;

    protected $listeners = [
        'initialize_select_other_address' => '$refresh'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
    }

    public function addresses(){
        return UserAccountAddress::with([
                'philippine_barangay', 
				'philippine_barangay.philippine_city', 
				'philippine_barangay.philippine_city.philippine_province',
				'philippine_barangay.philippine_city.philippine_province.philippine_region',
            ])
            ->where('user_account_id', $this->account->id)
            ->orderBy('is_default', 'desc')
            ->get();
    }

    public function render(){
        $data = $this->addresses();
        return view('livewire.front-end.user.check-out.index.select-other-address', compact('data'));
    }

    public function select($key_token){
        $is_exists = UserAccountAddress::where('user_account_id', $this->account->id)->where('key_token', $key_token)->first();
        
        if($is_exists){
            $this->emit('remove_modal_select_other_address', true);
            $this->emit('initialize_billing_address', $key_token);
        }
    }
}
