<?php

namespace App\Http\Livewire\Admin\Views\Accounts;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;
use QueryUtility;
use Route;
use Session;
class Accounts extends Component
{
    use WithPagination;
    public $search;
    public $type;
    public $paginate = 10;
    public function mount($type){
        $this->type = $type;
    }
    public function user(){
        
        if($this->type === 'partner'){
            $filter['select'] = [
                'user_accounts.first_name',
                'user_accounts.last_name',
                'user_accounts.key_token',
                'user_accounts.created_at',
                'users.verified_at',
                'users.email',
            ];
        }

        if($this->type === 'user'){
            $filter['select'] = [
                'user_accounts.first_name',
                'user_accounts.last_name',
                'user_accounts.key_token',
                'user_accounts.created_at',
                'users.verified_at',
                'users.type',
                'users.email',
            ];
        }
        
        $filter['where']['users.type'] = $this->type;

        if($this->search){
            $filter['search'] = $this->search;
        }

        $user = QueryUtility::user_accounts($filter)->paginate($this->paginate);

        return $user;
    }
    public function render()
    {
        $user = $this->user();
        return view('livewire.admin.views.accounts.accounts',compact('user'));
    }
    
   
}
