<?php

namespace App\Http\Livewire\FrontEnd\Partner\AccountActivation;

use Livewire\WithFileUploads;
use Livewire\Component;
use UploadUtility;
use Utility;

class TermsAndAgreement extends Component
{
    use WithFileUploads;
    public $dti_certificate_file;
    
    protected $listeners = [
        'business_details' => 'business_details'
    ];

    public function render(){
        return view('livewire.front-end.partner.account-activation.terms-and-agreement');
    }

    public function business_details($data){
        
    }
}
