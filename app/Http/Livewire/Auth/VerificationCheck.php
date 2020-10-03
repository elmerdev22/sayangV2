<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Model\User;
use Utility;
use Auth;

class VerificationCheck extends Component
{

    public $verification_code, $error_message, $resend=false;

    public function mount(){
        $this->initialize();
    }

    public function initialize(){
        $user = Auth::user();
    }

    public function render(){
        return view('livewire.auth.verification-check');
    }

    public function verify(){
        $user = User::findOrFail(Auth::user()->id);

        if(empty($this->verification_code)){
            $this->error_message = 'Please enter the verification code.';    
        }else if($user->verification_code != $this->verification_code){
            $this->error_message = 'Invalid Code.';    
        }else{
            if(Utility::is_date_time_expired($user->verification_expired_at) === true){
                $this->error_message = 'Verification code has expired, <br> Please resend a new code.';    
            }else{
                $user->verified_at = date('Y-m-d H:i:s');
                $user->save();

                $this->emit('alert_link', [
                    'type'     => 'success',
                    'title'    => 'Successfully Verified',
                    'message'  => 'Your account successfully verified.',
                    'redirect' => route('login-redirect.index'),
                ]);
            }
        }
    }

    public function resend(){
        if($this->resend){
            $user                          = User::find(Auth::user()->id);
            $user->verification_code       = rand(100000, 999999);
            $user->verification_expired_at = Utility::generate_verification_expiration();
            if($user->save()){
                $is_sent      = true;//Utility::mail_verification_code($user);
                $this->resend = false;
    
                if($is_sent){
                    $this->emit('alert', [
                        'type'     => 'success',
                        'title'    => 'Successfully Sent',
                        'message'  => 'Verification code successfully sent.',
                    ]);
                    $this->emit('reset_resend',['success' => true]);
                }else{
                    $this->emit('alert', [
                        'type'     => 'error',
                        'title'    => 'Failed',
                        'message'  => 'Verification code not sent.',
                    ]);
                    $this->emit('reset_resend',['success' => true]);
                }
            }
        }
    }
}
