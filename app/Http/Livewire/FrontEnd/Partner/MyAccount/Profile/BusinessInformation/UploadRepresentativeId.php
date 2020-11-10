<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\BusinessInformation;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Model\Partner;
use App\Model\PartnerRepresentative;
use UploadUtility;
use Utility;
use DB;

class UploadRepresentativeId extends Component
{
    use WithFileUploads;
    public $file, $partner_id, $error='';

    public function mount(){
        $partner          = Utility::auth_partner();
        $this->partner_id = $partner->partner_id;
    }

    public function render(){
        return view('livewire.front-end.partner.my-account.profile.business-information.upload-representative-id');
    }

    public function upload(){
        $rules = [];

        if(!empty($this->file)){
            $this->error = null;
            
            $rules['file'] = 'required|mimes:jpeg,jpg,png,gif,docx,pdf,dot,doc,docm|max:2048';
            $response      = ['success' => false, 'message' => ''];
            
            DB::beginTransaction();

            try{
                $partner  = PartnerRepresentative::where('partner_id', $this->partner_id)->firstOrFail();
                $account  = Utility::auth_user_account();
                $old_file = $partner->uploaded_id_file;
     
                $file_name                      = Utility::generate_file_name('PartnerRepresentative', 'uploaded_id_file');
                $extension                      = $this->file->getClientOriginalExtension();
                $original_file_name             = $this->file->getClientOriginalName();
                $file_path                      = UploadUtility::upload_file('uploaded-id', $account->key_token);
                $file                           = $file_name.'.'.$extension;
                $uploaded                       = $this->file->storeAs($file_path, $file);
                $partner->uploaded_id_file      = $file;
                $partner->uploaded_id_file_name = $original_file_name;
                $dir                            = $account->key_token.'/uploaded-id';

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
                $this->emit('initialize_representative_information', ['success' => true]);
                $this->emit('alert', [
                    'type'    => 'success',
                    'title'   => 'Successfull Uploaded.',
                    'message' => 'New representative ID successfully uploaded'
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
