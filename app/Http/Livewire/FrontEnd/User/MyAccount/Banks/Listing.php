<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\Banks;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\UserAccountBank;
use Utility;

class Listing extends Component
{
    use WithPagination;
    public $account;
    protected $listeners = [
        'banks_initialize' => '$refresh',
        'banks_initialize' => 'resetPage'
    ];
    
    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->resetPage();
    }

    public function banks(){
        return UserAccountBank::with(['bank'])
        ->where('user_account_id', $this->account->id)
        ->orderByRaw('is_default desc, created_at desc')
        ->paginate(5);
    }

    public function render(){
        $data = $this->banks();
        return view('livewire.front-end.user.my-account.banks.listing', compact('data'));
    }

    public function set_default($key_token){
        $data = UserAccountBank::where('user_account_id', $this->account->id)
                ->where('key_token', $key_token)
                ->firstOrFail();

        if(!$data->is_default){
            $old_default = UserAccountBank::where('user_account_id', $this->account->id)
                ->where('is_default', true)
                ->first();
            
            if($old_default){
                $old_default->is_default = false;
                $old_default->save();
            }
            
            $data->is_default = true;
            if($data->save()){
                $this->emit('banks_initialize', true);
                $this->emit('alert', [
                    'type'    => 'success',
                    'title'   => 'Successfully Change!',
                    'message' => 'Bank Account Default Successfully Changed.'
                ]);
            }
        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'Bank Account Already Set as Default.'
            ]);
        }
    }

    public function delete($key_token){
        $data = UserAccountBank::where('user_account_id', $this->account->id)
                ->where('key_token', $key_token)
                ->firstOrFail();
        
        if($data->is_default){
            $old_data = UserAccountBank::where('user_account_id', $this->account->id)->orderBy('created_at', 'desc')->first();
            if($old_data){
                $old_data->is_default = true;
                $old_data->save();
            }
        }

        if($data->delete()){
            $this->emit('addresses_initialize', true);
    		$this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Deleted',
                'message' => 'Address Successfully Deleted.'
            ]);
        }
    }
}
