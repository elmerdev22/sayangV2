<?php

namespace App\Http\Livewire\FrontEnd\Partner\AccountActivation;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\RegionProvince;
use App\Rules\MobileNo;
use App\Model\Partner;
use App\Model\PartnerRepresentative;
use App\Model\City;
use UploadUtility;
use QueryUtility;
use Validator;
use Utility;
use Auth;
use DB;

class RepresentativeDetails extends Component
{
    use WithFileUploads;

    public $representative_id, $representative_contact_no, $representative_email, $designation, $last_name, $first_name;
    public $account, $is_new=true, $partner, $old_representative_id;
    
    protected $listeners = [
        'business_details_success' => 'initialize'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->initialize();
    }

    public function initialize(){
        $partner = Partner::where('user_account_id', $this->account->id)->first();
        if($partner){
            $this->partner  = $partner;
            $representative = PartnerRepresentative::where('partner_id', $partner->id)->first();

            if($representative){
                $this->is_new                    = false;
                $this->first_name                = $representative->first_name;
                $this->last_name                 = $representative->last_name;
                $this->designation               = $representative->designation;
                $this->representative_email      = $representative->email;
                $this->representative_contact_no = $representative->contact_no;
                $this->representative_id         = $representative->uploaded_id_file;
                $this->old_representative_id     = $representative->uploaded_id_file;
            }
        }
    }

    public function render(){
        return view('livewire.front-end.partner.account-activation.representative-details');
    }

    public function update(){
        $rules = [
            'first_name'                => 'required|max:100',
            'last_name'                 => 'required|max:100',
            'designation'               => 'required|max:100',
            'representative_email'      => 'required|max:190|email',
            'representative_contact_no' => ['required', new MobileNo],
        ];

        if($this->is_new){
            $rules['representative_id'] = 'required|mimes:jpeg,jpg,png,gif,docx,pdf,dot,doc,docm|max:2048';
        }else{
            if($this->representative_id){
                if($this->old_representative_id == $this->representative_id){
                    $rules['representative_id'] = 'nullable';
                }else{
                    $rules['representative_id'] = 'nullable|mimes:jpeg,jpg,png,gif,docx,pdf,dot,doc,docm|max:2048';
                }
            }else{
                $rules['representative_id'] = 'required|mimes:jpeg,jpg,png,gif,docx,pdf,dot,doc,docm|max:2048';
            }
        }

        $messages  = ['url.regex' => 'Invalid Link'];
        $requests  = Utility::component_request($rules, $this);
        $validator = Validator::make($requests, $rules, $messages);
        
        if($validator->fails()){
            $this->emit('representative_details_input_errors', $validator->errors());
            return false;
        }

        $response = ['success' => false, 'message' => ''];
        DB::beginTransaction();

        try{
            $account = $this->account;
            $partner = $this->partner;
            if($partner){
                $representative = PartnerRepresentative::where('partner_id', $partner->id)->first();
                if($representative){
                    $old_representative_id = $representative->uploaded_id_file;

                    if($old_representative_id != $this->representative_id){
                        // Replace to Old Uploaded ID
                        $generated_file_name                   = Utility::generate_file_name('PartnerRepresentative', 'uploaded_id_file');
                        $extension                             = $this->representative_id->getClientOriginalExtension();
                        $file_name                             = $this->representative_id->getClientOriginalName();
                        $file_path                             = UploadUtility::upload_file('uploaded-id', $account->key_token);
                        $file                                  = $generated_file_name.'.'.$extension;
                        $file_uploaded                         = $this->representative_id->storeAs($file_path, $file);
                        $representative->uploaded_id_file      = $file;
                        $representative->uploaded_id_file_name = $file_name;
                        $representative_id_dir                 = $account->key_token.'/uploaded-id';
                        $representative_id_unlink              = true;
                        // End of Replace to Old Uploaded ID
                    }
                }else{
                    $representative             = new PartnerRepresentative();
                    $representative->partner_id = $partner->id;
                    $representative->key_token  = Utility::generate_table_token('PartnerRepresentative');

                    // New Upload ID
                    $generated_file_name                   = Utility::generate_file_name('PartnerRepresentative', 'uploaded_id_file');
                    $extension                             = $this->representative_id->getClientOriginalExtension();
                    $file_name                             = $this->representative_id->getClientOriginalName();
                    $file_path                             = UploadUtility::upload_file('uploaded-id', $account->key_token);
                    $file                                  = $generated_file_name.'.'.$extension;
                    $file_uploaded                         = $this->representative_id->storeAs($file_path, $file);
                    $representative->uploaded_id_file      = $file;
                    $representative->uploaded_id_file_name = $file_name;
                    // End of New Upload ID
                }

                $representative->first_name  = $this->first_name;
                $representative->last_name   = $this->last_name;
                $representative->designation = $this->designation;
                $representative->contact_no  = $this->representative_contact_no;
                $representative->email       = $this->representative_email;
                
                if($representative->save()){
                    $response['success'] = true;
                }       
                
            }
        }catch(\Exception $e){
            $response['message'] = 'An error occured.';            
        }

        if($response['success']){
            DB::commit();

            if(isset($representative_id_unlink)){
                UploadUtility::unlink($representative_id_dir, $old_representative_id);
            }

            $this->emit('representative_details_success', ['success' => true]);
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
