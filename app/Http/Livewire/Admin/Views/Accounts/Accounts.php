<?php

namespace App\Http\Livewire\Admin\Views\Accounts;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;
use QueryUtility;
use Route;
class Accounts extends Component
{
    use WithPagination;

    public $search;
    public $paginate = 10;
    public function user(){
        $filter['select'] = [
            'user_accounts.first_name',
            'user_accounts.last_name',
            'user_accounts.key_token',
            'user_accounts.created_at',
            'users.verified_at',
            'users.email',
        ];

        if(Route::is('admin.cms.partner')){
            $filter['where']['type'] = 'partner';
        }
        if(Route::is('admin.cms.user')){
            $filter['where']['type'] = 'user';
        }
        $user = QueryUtility::user_accounts($filter);
        if($this->search){
            $filter['search'] = $this->search;
            $user = QueryUtility::user_accounts($filter);
        }
       
        $user = $user->paginate($this->paginate);
        return $user;
    }
    public function render()
    {
        $user = $this->user();
        return view('livewire.admin.views.accounts.accounts',compact('user'));
    }
    
   
}
