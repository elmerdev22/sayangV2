<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Livewire\Component;
use App\Model\UserAccountAddress;
use Utility;

class Billing extends Component
{
    public $account, $row;

    protected $listeners = [
        'initialize_billing_address' => 'address'
    ];

    public function mount(){
        $this->account   = Utility::auth_user_account();
        $this->address();
    }

    public function address($key_token=null){
        
        $data = UserAccountAddress::with([
                'philippine_barangay', 
                'philippine_barangay.philippine_city', 
                'philippine_barangay.philippine_city.philippine_province',
                'philippine_barangay.philippine_city.philippine_province.philippine_region',
            ])
            ->where('user_account_id', $this->account->id);
        
        if($key_token){
            $data = $data->where('key_token', $key_token);
        }else{
            $data = $data->where('is_default', true);
        }
        
        $this->row = $data->first();
        
        if($this->row){
            $this->emit('set_billing_address_id', ['id' => $this->row->id]);
        }else{
            $this->emit('set_billing_address_id', null);
        }
    }

    public function render(){
        return view('livewire.front-end.user.check-out.index.billing');
    }
}
