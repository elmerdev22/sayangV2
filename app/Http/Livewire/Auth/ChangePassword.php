<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Model\User;
use Session;
use Auth;

class ChangePassword extends Component
{
    public $current_password,$new_password,$password_confirmation, $redirect; 
	
    public function mount($redirect)
    {
        $this->redirect = $redirect;
    }

    public function render()
    {
        return view('livewire.auth.change-password');
    }

    public function change_pass(){
 
        $this->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:8'
        ]);

        $new_pass = Hash::make($this->new_password);
        $is_true  = Hash::check($this->current_password, Auth::user()->password);

    	if($is_true == true){

			$user           = User::where('id', Auth::user()->id)->firstorFail();
			$user->password = $new_pass;
			$is_saved       = $user->save();

			if($is_saved){
				Session::flash('success_change_password','Your password is successfully changed please relogin!'); 
                Auth::logout();
                
                if($this->redirect == 'partner_login'){
				    return redirect()->route('partner.login');
                }
                else if($this->redirect == 'admin_login'){
				    return redirect()->route('admin.login');
                }
                else{
                    return redirect()->to('/login');
                }

			}
			else{
				Session::flash('error_change','Password failed to changed please contact the admin.');
			}
		}
		else{
				Session::flash('error_change','Current password incorrect.');
		}
    }
}
