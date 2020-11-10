<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\BusinessInformation;

use Livewire\Component;
use App\Rules\MobileNo;
use App\Model\Partner;
use App\Model\PhilippineBarangay;
use App\Model\PhilippineCity;
use App\Model\PhilippineProvince;
use App\Model\PhilippineRegion;
use Utility;
use DB;

class EditBusinessInformation extends Component
{
    public $partner_id;
    public $business_name, $contact_no, $email, $dti_registration_no, $tin;
    public $region, $province, $city, $barangay, $map_address_link, $address;
    
    protected $listeners = [
        'initialize_business_information' => 'initialize',
        'initialize_business_information' => '$refresh'
    ];

    public function mount(){
        $partner          = Utility::auth_partner();
        $this->partner_id = $partner->partner_id;

        $this->initialize();
    }

    public function initialize(){
        $partner = Partner::with([
                    'philippine_barangay',
                    'philippine_barangay.philippine_city',
                    'philippine_barangay.philippine_city.philippine_province',
                    'philippine_barangay.philippine_city.philippine_province.philippine_region'
                ])
                ->findOrFail($this->partner_id);

        $this->business_name       = $partner->name;
        $this->contact_no          = $partner->contact_no;
        $this->dti_registration_no = $partner->dti_registration_no;
        $this->email               = $partner->email;
        $this->tin                 = $partner->tin;
        $this->address             = $partner->address;
        $this->map_address_link    = $partner->map_address_link;
        $this->region              = $partner->philippine_barangay->philippine_city->philippine_province->philippine_region->id;
        $this->province            = $partner->philippine_barangay->philippine_city->philippine_province->id;
        $this->city                = $partner->philippine_barangay->philippine_city->id;
        $this->barangay            = $partner->philippine_barangay->id;
    }

    public function barangays($city_id){
        if($city_id){
            return PhilippineBarangay::where('city_id', $city_id)->orderBy('name', 'asc')->get();
        }else{
            return [];
        }
    }
    
    public function cities($province_id){
        if($province_id){
            return PhilippineCity::where('province_id', $province_id)->orderBy('name', 'asc')->get();
        }else{
            return [];
        }
    }

    public function provinces($region_id){
        if($region_id){
            return PhilippineProvince::where('region_id', $region_id)->orderBy('name', 'asc')->get();
        }else{
            return [];
        }
    }

    public function regions(){
        return PhilippineRegion::orderBy('name', 'asc')->get();
    }

    public function render(){
        $component = $this;
        $regions   = $this->regions();
        $provinces = $this->provinces($this->region);
        $cities    = $this->cities($this->province);
        $barangays = $this->barangays($this->city);

        return view('livewire.front-end.partner.my-account.profile.business-information.edit-business-information', compact('component', 'regions', 'provinces', 'cities', 'barangays'));
    }

    public function update(){
        $rules = [
            'business_name'       => 'required|max:190',
            'address'             => 'required|max:190',
            'contact_no'          => ['required', new MobileNo],
            'email'               => 'required|max:190|email',
            'region'              => 'required|numeric',
            'province'            => 'required|numeric',
            'city'                => 'required|numeric',
            'barangay'            => 'required|numeric',
            'map_address_link'    => ['required', 'max:500', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
            'dti_registration_no' => 'required|max:100',
            'tin'                 => 'required|max:20',
        ];
        $this->validate($rules);
        
        $response = ['success' => false, 'message' => ''];
        DB::beginTransaction();

        try{
            $partner                      = Partner::findOrFail($this->partner_id);
            $partner->name                = $this->business_name;
            $partner->address             = $this->address;
            $partner->contact_no          = $this->contact_no;
            $partner->email               = $this->email;
            $partner->barangay_id         = $this->barangay;
            $partner->map_address_link    = $this->map_address_link;
            $partner->dti_registration_no = $this->dti_registration_no;
            $partner->tin                 = $this->tin;

            if($partner->save()){
                $response['success'] = true;
            }
        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('initialize_business_information', ['success' => true]);
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Saved',
                'message' => 'Business details successfully saved.'
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
