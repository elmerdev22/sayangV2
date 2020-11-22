<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\Addresses;

use Livewire\Component;
use App\Rules\MobileNo;
use App\Model\PhilippineRegion;
use App\Model\PhilippineProvince;
use App\Model\PhilippineCity;
use App\Model\PhilippineBarangay;
use App\Model\UserAccountAddress;
use DB;
use Auth;
use Utility;

class Edit extends Component
{
    public $account, $full_name, $contact_no, $key_token;
    public $region, $province, $city, $barangay, $zip_code, $address;
    
    public function initialize($key_token){
        $this->account    = Utility::auth_user_account();
        $this->key_token  = $key_token;

        $address          = UserAccountAddress::with(['philippine_barangay.philippine_city.philippine_province.philippine_region'])
            ->where('key_token', $this->key_token)
            ->where('user_account_id', $this->account->id)
            ->firstOrFail();

        $this->full_name  = $address->full_name;
        $this->contact_no = $address->contact_no;
        $this->zip_code   = $address->zip_code;
        $this->address    = $address->address;
        $this->barangay   = $address->barangay_id;
        $this->city       = $address->philippine_barangay->philippine_city->id;
        $this->province   = $address->philippine_barangay->philippine_city->philippine_province->id;
        $this->region     = $address->philippine_barangay->philippine_city->philippine_province->philippine_region->id;
    }

    public function philippine_regions(){
        return PhilippineRegion::orderBy('name', 'asc')->get();
    }

    public function philippine_provinces($region_id){
        return PhilippineProvince::where('region_id', $region_id)->orderBy('name', 'asc')->get();
    }

    public function philippine_cities($province_id){
        return PhilippineCity::where('province_id', $province_id)->orderBy('name', 'asc')->get();
    }

    public function philippine_barangays($city_id){
        return PhilippineBarangay::where('city_id', $city_id)->orderBy('name', 'asc')->get();
    }

    public function render(){
        $component = $this;
        return view('livewire.front-end.user.my-account.addresses.edit', compact('component'));
    }

    public function update(){
        $rules = [
            'full_name'  => 'required|max:191',
            'contact_no' => ['required', new MobileNo],
            'barangay'   => 'required|numeric',
            'city'       => 'required|numeric',
            'province'   => 'required|numeric',
            'region'     => 'required|numeric',
            'address'    => 'required|max:191',
            'zip_code'   => 'required|numeric',
        ];

        $this->validate($rules);
        $response = ['success' => false];
        DB::beginTransaction();

        try{

            $address                  = UserAccountAddress::where('key_token', $this->key_token)->firstOrFail();
            $address->barangay_id     = $this->barangay;
            $address->full_name       = $this->full_name;
            $address->contact_no      = $this->contact_no;
            $address->zip_code        = $this->zip_code;
            $address->address         = $this->address;

            if($address->save()){
                $response['success'] = true;
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->reset();
            $this->emit('addresses_initialize', true);
    		$this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Updated',
                'message' => 'Address Successfully Saved.'
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while saving the address'
            ]);
        }

    }
    
}
