<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\Addresses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\UserAccountAddress;
use DB;
use Auth;
use Utility;

class Listing extends Component
{
	use WithPagination;

    public $account;

    protected $listeners = [
        'addresses_initialize' => '$refresh'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->resetPage();
    }

    public function addresses(){
        return UserAccountAddress::with([
                'philippine_barangay', 
				'philippine_barangay.philippine_city', 
				'philippine_barangay.philippine_city.philippine_province',
				'philippine_barangay.philippine_city.philippine_province.philippine_region',
            ])
            ->where('user_account_id', $this->account->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    public function render(){
        $data = $this->addresses();

        return view('livewire.front-end.user.my-account.addresses.listing', compact('data'));
    }
}
