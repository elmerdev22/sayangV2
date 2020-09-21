<?php

namespace App\Http\Livewire\Admin\Views\Products;

use Livewire\Component;

class Catalog extends Component
{
    public $input_category;
    public function add_category(){
        if(Route::is('admin.cms.partner')){
            $filter['select'] = [
                'user_accounts.first_name',
                'user_accounts.last_name',
                'user_accounts.key_token',
                'user_accounts.created_at',
                'users.verified_at',
                'users.email',
            ];
            $filter['where']['type'] = 'partner';
        }
        if(Route::is('admin.cms.user')){
            $filter['select'] = [
                'user_accounts.first_name',
                'user_accounts.last_name',
                'user_accounts.key_token',
                'user_accounts.created_at',
                'users.verified_at',
                'users.email',
            ];
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
        return view('livewire.admin.views.products.catalog');
    }
}