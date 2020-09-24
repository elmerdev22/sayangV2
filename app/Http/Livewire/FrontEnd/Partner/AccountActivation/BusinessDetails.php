<?php

namespace App\Http\Livewire\FrontEnd\Partner\AccountActivation;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\PhilippineRegion;
use App\Model\PhilippineProvince;
use App\Model\PhilippineCity;
use App\Model\PhilippineBarangay;
use App\Rules\MobileNo;
use App\Model\Partner;
use UploadUtility;
use QueryUtility;
use Validator;
use Utility;
use Auth;
use DB;

class BusinessDetails extends Component
{
    use WithFileUploads;

    public $business_name, $business_address, $map_address_link, $business_contact_no;
    public $business_email, $dti_registration_no, $tin, $dti_certificate_file, $old_dti_certificate_file;
    public $region, $province, $city, $barangay;
    public $account, $is_new=true;

    public function mount(){
        $this->account = Utility::auth_user_account();
        
        $filter = [];
        $filter['select'] = [
            'partners.*',
            'philippine_cities.id as city_id',
            'philippine_provinces.id as province_id',
            'philippine_regions.id as region_id',
        ];
        $filter['where']['partners.user_account_id'] = $this->account->id;
        
        $partner = QueryUtility::partners($filter)->first();
        
        if($partner){
            $this->is_new                   = false;
            $this->business_name            = $partner->name;
            $this->business_address         = $partner->address;
            $this->region                   = $partner->region_id;
            $this->province                 = $partner->province_id;
            $this->city                     = $partner->city_id;
            $this->barangay                 = $partner->barangay_id;
            $this->map_address_link         = $partner->map_address_link;
            $this->business_contact_no      = $partner->contact_no;
            $this->business_email           = $partner->email;
            $this->dti_registration_no      = $partner->dti_registration_no;
            $this->tin                      = $partner->tin;
            $this->dti_certificate_file     = $partner->dti_certificate_file;
            $this->old_dti_certificate_file = $partner->dti_certificate_file;
        }
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

        return view('livewire.front-end.partner.account-activation.business-details', compact('component', 'regions', 'provinces', 'cities', 'barangays'));
    }

    public function update(){
        $rules = [
            'business_name'       => 'required|max:190',
            'business_address'    => 'required|max:190',
            'business_contact_no' => ['required', new MobileNo],
            'business_email'      => 'required|max:190|email',
            'region'              => 'required|numeric',
            'province'            => 'required|numeric',
            'city'                => 'required|numeric',
            'barangay'            => 'required|numeric',
            'map_address_link'    => ['required', 'max:500', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
            'dti_registration_no' => 'required|max:100',
            'tin'                 => 'required|max:20',
        ];

        if($this->is_new){
            $rules['dti_certificate_file'] = 'required|mimes:jpeg,jpg,png,gif,docx,pdf,dot,doc,docm|max:2048';
        }else{
            if($this->dti_certificate_file){
                if($this->old_dti_certificate_file == $this->dti_certificate_file){
                    $rules['dti_certificate_file'] = 'nullable';
                }else{
                    $rules['dti_certificate_file'] = 'nullable|mimes:jpeg,jpg,png,gif,docx,pdf,dot,doc,docm|max:2048';
                }
            }else{
                $rules['dti_certificate_file'] = 'required|mimes:jpeg,jpg,png,gif,docx,pdf,dot,doc,docm|max:2048';
            }
        }

        $messages  = ['url.regex' => 'Invalid Link'];
        $requests  = Utility::component_request($rules, $this);
        $validator = Validator::make($requests, $rules, $messages);
        
        if($validator->fails()){
            $this->emit('business_details_input_errors', $validator->errors());
            return false;
        }
        
        $response = ['success' => false, 'message' => ''];
        DB::beginTransaction();
        
        try{
            $account       = $this->account;
            $partner       = Partner::where('user_account_id', $account->id)->first();

            if($partner){
                $old_dti = $partner->dti_certificate_file;

                if($old_dti != $this->dti_certificate_file){
                    // Replace to Old DTI
                    $dti_file_name                      = Utility::generate_file_name('Partner', 'dti_certificate_file');
                    $extension                          = $this->dti_certificate_file->getClientOriginalExtension();
                    $file_name                          = $this->dti_certificate_file->getClientOriginalName();
                    $dti_certificate_path               = UploadUtility::upload_file('dti-certificates', $account->key_token);
                    $dti_file                           = $dti_file_name.'.'.$extension;
                    $dti_certificate                    = $this->dti_certificate_file->storeAs($dti_certificate_path, $dti_file);
                    $partner->dti_certificate_file      = $dti_file;
                    $partner->dti_certificate_file_name = $file_name;
                    $dir                                = $account->key_token.'/dti-certificates';
                    $dti_unlink                         = true;
                    // End of Replace to Old DTI
                }
            }else{
                $partner                  = new Partner();
                $partner->partner_no      = Utility::generate_partner_no();
                $partner->user_account_id = $this->account->id;
                $partner->slug            = Utility::generate_table_slug('Partner', $this->business_name);
                $partner->key_token       = Utility::generate_table_token('Partner');

                // New DTI
                $dti_file_name                      = Utility::generate_file_name('Partner', 'dti_certificate_file');
                $extension                          = $this->dti_certificate_file->getClientOriginalExtension();
                $file_name                          = $this->dti_certificate_file->getClientOriginalName();
                $dti_certificate_path               = UploadUtility::upload_file('dti-certificates', $account->key_token);
                $dti_file                           = $dti_file_name.'.'.$extension;
                $dti_certificate                    = $this->dti_certificate_file->storeAs($dti_certificate_path, $dti_file);
                $partner->dti_certificate_file      = $dti_file;
                $partner->dti_certificate_file_name = $file_name;
                // End of New DTI
            }

            $partner->name                = $this->business_name;
            $partner->address             = $this->business_address;
            $partner->contact_no          = $this->business_contact_no;
            $partner->email               = $this->business_email;
            $partner->barangay_id         = $this->barangay;
            $partner->map_address_link    = $this->map_address_link;
            $partner->dti_registration_no = $this->dti_registration_no;
            $partner->tin                 = $this->tin;
            
            if($partner->save()){
                $response['success'] = true;
            }            
        }catch(\Exception $e){
            $response['message'] = 'An error occured.';            
        }

        if($response['success']){
            DB::commit();

            if(isset($dti_unlink)){
                UploadUtility::unlink($dir, $old_dti);
            }

            $this->emit('business_details_success', ['success' => true]);
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
