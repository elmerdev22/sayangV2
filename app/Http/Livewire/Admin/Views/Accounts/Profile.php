<?php

namespace App\Http\Livewire\Admin\Views\Accounts;

use Livewire\Component;
use Livewire\WithPagination;
use QueryUtility;
use Route;
class Profile extends Component
{
    use WithPagination;
    public $search;
    public $key_token;
    public $paginate = 10;
    public function mount($key_token){
        $key_token = $key_token;
    }
    public function transaction(){
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
        $transaction = QueryUtility::user_accounts($filter);
        if($this->search){
            $filter['search'] = $this->search;
            $transaction = QueryUtility::user_accounts($filter);
        }
       
        $transaction = $transaction->paginate($this->paginate);
        return $transaction;
    }
    public function render()
    {
        $transaction = $this->transaction();
        return view('livewire.admin.views.accounts.profile',compact('transaction'));
    }
}
