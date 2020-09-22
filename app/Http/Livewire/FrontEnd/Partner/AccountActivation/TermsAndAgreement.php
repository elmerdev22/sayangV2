<?php

namespace App\Http\Livewire\FrontEnd\Partner\AccountActivation;

use Livewire\Component;
use App\Model\Partner;
use App\Model\PartnerRepresentative;
use App\Model\PartnerBankAccount;
use Utility;

class TermsAndAgreement extends Component
{

    public $agree=false, $verified=false, $partner;
    
    protected $listeners = [
        'bank_details_success' => 'initialize'
    ];

    public function mount(){
        $this->initialize();
    }

    public function initialize(){
        $account        = Utility::auth_user_account();
        $partner        = Partner::where('user_account_id', $account->id)->first();
        $this->partner  = $partner;
        $this->verified = false;
        
        if($partner){
            $representative = PartnerRepresentative::where('partner_id', $partner->id)->count();
            if($representative > 0){
                $bank_account = PartnerBankAccount::where('partner_id', $partner->id)->count();
                if($bank_account > 0){
                    $this->verified = true;
                }
            }
        }
    }

    public function render(){
        return view('livewire.front-end.partner.account-activation.terms-and-agreement');
    }

    public function update(){
        if(!$this->verified){
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'Information Not Complete, <br> Please reload the page.'
            ]);
        }else if(!$this->agree){
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'Please agree in our Terms and Agreement.'
            ]);
        }else{
            $partner         = Partner::find($this->partner->id);
            $partner->status = 'done';
            $partner->save();

            $this->emit('terms_and_agreement_success', ['success' => true]);
        }
    }

}
