<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\BusinessInformation;

use Livewire\Component;
use App\Rules\MobileNo;
use App\Model\PartnerRepresentative;
use Utility;
use DB;

class EditRepresentativeInformation extends Component
{
    public $partner_id, $representative_id;
    public $contact_no, $email, $designation, $last_name, $first_name;

    protected $listeners = [
        'initialize_representative_information' => 'intialize',
        'initialize_representative_information' => '$refresh'
    ];

    public function mount(){
        $partner                 = Utility::auth_partner();
        $representative          = PartnerRepresentative::where('partner_id', $partner->partner_id)->first();
        $this->representative_id = $representative->id;
        $this->partner_id        = $partner->partner_id;
        $this->initialize();
    }

    public function initialize(){
        $partner           = Utility::auth_partner();
        $this->contact_no  = $partner->representative_contact_no;
        $this->email       = $partner->representative_email;
        $this->designation = $partner->representative_designation;
        $this->last_name   = $partner->representative_last_name;
        $this->first_name  = $partner->representative_first_name;
    }

    public function render(){
        return view('livewire.front-end.partner.my-account.profile.business-information.edit-representative-information');
    }

    public function update(){
        $rules = [
            'first_name'  => 'required|max:100',
            'last_name'   => 'required|max:100',
            'designation' => 'required|max:100',
            'email'       => 'required|max:190|email',
            'contact_no'  => ['required', new MobileNo],
        ];

        $this->validate($rules);

        $response = ['success' => false, 'message' => ''];
        DB::beginTransaction();

        try{
            $representative              = PartnerRepresentative::findOrFail($this->representative_id);
            $representative->first_name  = $this->first_name;
            $representative->last_name   = $this->last_name;
            $representative->designation = $this->designation;
            $representative->contact_no  = $this->contact_no;
            $representative->email       = $this->email;
            
            if($representative->save()){
                $response['success'] = true;
            }  
            
        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('initialize_representative_information', ['success' => true]);
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Saved',
                'message' => 'Representative details successfully saved.'
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured'
            ]);
        }
    }    
}
