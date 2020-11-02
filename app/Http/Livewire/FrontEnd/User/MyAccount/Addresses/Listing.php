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
        'addresses_initialize' => '$refresh',
        'addresses_initialize' => 'resetPage'
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
            ->orderBy('is_default', 'desc')
            ->paginate(5);
    }

    public function render(){
        $data = $this->addresses();

        return view('livewire.front-end.user.my-account.addresses.listing', compact('data'));
    }

    public function set_default($key_token){
        $address = UserAccountAddress::where('user_account_id', $this->account->id)
                ->where('key_token', $key_token)
                ->firstOrFail();

        if(!$address->is_default){
            $old_default_address = UserAccountAddress::where('user_account_id', $this->account->id)
                ->where('is_default', true)
                ->first();
            
            if($old_default_address){
                $old_default_address->is_default = false;
                $old_default_address->save();
            }
            
            $address->is_default = true;
            if($address->save()){
                $this->emit('addresses_initialize', true);
                $this->emit('alert', [
                    'type'    => 'success',
                    'title'   => 'Successfully Change!',
                    'message' => 'Address Default Successfully Changed.'
                ]);
            }
        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'Address Already Set as Default.'
            ]);
        }
    }

    public function edit($key_token){
        $this->emit('edit_address', ['key_token' => $key_token]);
    }

    public function delete($key_token){
        $address = UserAccountAddress::where('user_account_id', $this->account->id)
                ->where('key_token', $key_token)
                ->firstOrFail();

        if($address->delete()){
            $this->emit('addresses_initialize', true);
    		$this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Deleted',
                'message' => 'Address Successfully Deleted.'
            ]);
        }
    }
}
