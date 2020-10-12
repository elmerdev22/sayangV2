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

class Add extends Component
{
    public $account, $full_name, $contact_no, $is_default=false, $force_default;
    public $region, $province, $city, $barangay, $zip_code, $address;
    
    public function mount(){
        $this->initialize();
    }

    public function initialize(){
        $this->account = Utility::auth_user_account();
        $exist_address = UserAccountAddress::where('user_account_id', $this->account->id)->count();
        if($exist_address > 0){
            $this->force_default = false;
        }else{
            $this->force_default = true;
            $this->is_default    = true;
        }
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
        return view('livewire.front-end.user.my-account.addresses.add', compact('component'));
    }

    public function store(){
        $rules = [
            'full_name'  => 'required|max:191',
            'contact_no' => ['required', new MobileNo],
            'barangay'   => 'required|numeric',
            'city'       => 'required|numeric',
            'province'   => 'required|numeric',
            'region'     => 'required|numeric',
            'address'    => 'required|max:191',
            'zip_code'   => 'required|numeric',
            'is_default' => 'nullable'
        ];

        $this->validate($rules);
        $response = ['success' => false];
        DB::beginTransaction();

        try{

            $address                  = new UserAccountAddress();
            $address->user_account_id = $this->account->id;
            $address->barangay_id     = $this->barangay;
            $address->full_name       = $this->full_name;
            $address->contact_no      = $this->contact_no;
            $address->zip_code        = $this->zip_code;
            $address->address         = $this->address;
            $address->is_default      = $this->is_default;
            $address->key_token       = Utility::generate_table_token('UserAccountAddress');

            if($this->is_default){
                $old_default_address = UserAccountAddress::where('is_default', true)
                    ->where('user_account_id', $this->account->id)
                    ->first();

                if($old_default_address){
                    $old_default_address->is_default = false;
                    $old_default_address->save();
                }
            }
            
            if($address->save()){
                $response['success'] = true;
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->reset();
            $this->initialize();
            $this->emit('addresses_initialize', true);
    		$this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Added',
                'message' => 'Address Successfully Added.'
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while adding the address'
            ]);
        }

    }
}
