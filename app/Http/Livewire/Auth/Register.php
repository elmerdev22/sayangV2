<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Rules\MobileNo;
use App\Model\User;
use App\Model\UserAccount;
use Utility;
use Auth;
use Hash;
use DB;

class Register extends Component
{
    public $first_name, $last_name, $email, $contact_no, $password, $confirm_password, $agree=true;

    public function render(){
        return view('livewire.auth.register');
    }

    public function store(){
		$rules = [
			'first_name'       => 'required|max:150',
			'last_name'        => 'required|max:150',
			'email'            => 'required|email|unique:users',
			'contact_no'       => ['required', 'unique:user_accounts', new MobileNo],
			'password'         => 'required|required_with:confirm_password|same:confirm_password|min:8',
			'confirm_password' => 'required|min:8'
        ];
        $messages = [];
        $this->validate($rules, $messages);

        if(!$this->agree){
            return false;
        }

        $response = [
            'success' => false,
            'message' => 'An error occured'
        ];
        
        DB::beginTransaction();
        try{
            $user            = new User();
            $user->name      = Utility::generate_username_from_email($this->email);
            $user->email     = $this->email;
            $user->type      = 'user';
            $user->password  = Hash::make($this->password);
            $user->key_token = Utility::generate_table_token('User');
            
            if($user->save()){
                $account             = new UserAccount();
                $account->user_id    = $user->id;
                $account->first_name = $this->first_name;
                $account->last_name  = $this->last_name;
                $account->contact_no = $this->contact_no;
                $account->key_token  = Utility::generate_table_token('UserAccount');

                if($account->save()){
                    $response['success'] = true;
                }
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->login($user->id);
        }else{
            DB::rollback();
        }
    }

    public function login($user_id){
        Auth::loginUsingId($user_id);

        return redirect(route('login-redirect.index'));
    }
}
