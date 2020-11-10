<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\BusinessInformation;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Model\Partner;
use UploadUtility;
use Utility;
use DB;

class UploadDtiCertificate extends Component
{
    use WithFileUploads;
    public $file, $partner_id, $error='';

    public function mount(){
        $partner          = Utility::auth_partner();
        $this->partner_id = $partner->partner_id;
    }

    public function render(){
        return view('livewire.front-end.partner.my-account.profile.business-information.upload-dti-certificate');
    }

    public function upload(){
        $rules = [];

        if(!empty($this->file)){
            $this->error = null;
            
            $rules['file'] = 'required|mimes:jpeg,jpg,png,gif,docx,pdf,dot,doc,docm,zip|max:2048';
            $response      = ['success' => false, 'message' => ''];
            
            DB::beginTransaction();

            try{
                $partner  = Partner::findOrFail($this->partner_id);
                $account  = Utility::auth_user_account();
                $old_file = $partner->dti_certificate_file;
     
                $file_name                          = Utility::generate_file_name('Partner', 'dti_certificate_file');
                $extension                          = $this->file->getClientOriginalExtension();
                $original_file_name                 = $this->file->getClientOriginalName();
                $file_path                          = UploadUtility::upload_file('dti-certificates', $account->key_token);
                $file                               = $file_name.'.'.$extension;
                $uploaded                           = $this->file->storeAs($file_path, $file);
                $partner->dti_certificate_file      = $file;
                $partner->dti_certificate_file_name = $original_file_name;
                $dir                                = $account->key_token.'/dti-certificates';

                if($partner->save()){
                    $old_file_unlink     = true;
                    $response['success'] = true;
                }

            }catch(\Exception $e){
                $response['success'] = false;
            }

            if($response['success']){
                DB::commit();
                if(isset($old_file_unlink)){
                    UploadUtility::unlink($dir, $old_file);
                }
                $this->reset(['file']);
                $this->emit('initialize_business_information', ['success' => true]);
                $this->emit('alert', [
                    'type'    => 'success',
                    'title'   => 'Successfull Uploaded.',
                    'message' => 'New DTI certificate successfully uploaded'
                ]);
            }else{
                DB::rollback();
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Failed',
                    'message' => 'An error occured'
                ]);
            }
        }else{
            $this->error = 'Please Upload File';
        }
    }
}
