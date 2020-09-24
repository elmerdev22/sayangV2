<?php

namespace App\Http\Livewire\Admin\Views\Accounts\Components;

use Livewire\Component;
use App\User;
class BlockUser extends Component
{
    public $account,$status;
    public function mount($id,$status)
    {
        $this->account = $id;
        $this->status  = $status;
        
    }

    public function block()
    {
        
        $user             = User::findorFail($this->account);
        $user->is_blocked = $user->is_blocked == 1 ? 0 : 1;
        $message          = $user->is_blocked == 1 ? 'Blocked' : 'Unblocked';
        
        if($user->save()){
            $this->emit('refresh');
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Success',
                'message' => "User Successfully $message."
            ]);    
            $this->status = $user->is_blocked;

        }
        else{
            $this->emit('refresh');
            $this->emit('alert', [
                'type'    => 'failed',
                'title'   => 'Failed',
                'message' => "User Not Successfully $message."
            ]);

        }
    }
    public function render()
    {
        $status = $this->status;
        return view('livewire.admin.views.accounts.components.block-user',compact('status'));
    }
}
