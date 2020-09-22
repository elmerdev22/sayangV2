<?php

namespace App\Http\Livewire\FrontEnd\Partner\AccountActivation;

use Livewire\Component;

class BankDetails extends Component
{
    public $business_name, $business_address, $city, $region_province, $map_address_link, $business_contact_no;
    public $business_email, $dti_registration_no, $tin, $dti_certificate_file;
    // protected $listeners = [
    //     'dti_certificate' => 'store'
    // ];

    public function render(){
        return view('livewire.front-end.partner.account-activation.bank-details');
    }

    public function store($dti_certificate){
        dd($dti_certificate);
    }
}
