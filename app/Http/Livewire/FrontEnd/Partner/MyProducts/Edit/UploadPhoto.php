<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\Edit;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Model\Product;
use DB;
use Utility;
use UploadUtility;

class UploadPhoto extends Component
{
    use WithFileUploads;

    public $partner, $account, $product, $featured_photo;
    public $photos = [];

    public function mount($product_id){
        $this->partner        = Utility::auth_partner();
        $this->account        = Utility::auth_user_account();
        $this->product        = Product::findOrFail($product_id);
        $this->featured_photo = UploadUtility::product_featured_photo($this->account->key_token, $this->product->key_token, true , true);

    }

    public function render(){
        return view('livewire.front-end.partner.my-products.edit.upload-photo');
    }

    public function upload(){
        $rules = [
            'photos'   => 'required',
            'photos.*' => 'image|mimes:jpeg,jpg,png|max:2048'
        ];

        $this->validate($rules);

        $response = ['success' => false, 'message' => ''];

        DB::beginTransaction();
        
        try{
            $product    = Product::findOrFail($this->product->id);
            
            $old_featured = count($this->featured_photo) > 0 ? true : false;
            $collection   = $this->account->key_token.'/product/'.$product->key_token.'/photo/';

            foreach($this->photos as $key => $photo){
                if(!$old_featured && $key == 0){
                    $collection = $this->account->key_token.'/product/'.$product->key_token.'/featured-photo/';
                }else{
                    $collection = $this->account->key_token.'/product/'.$product->key_token.'/photo/';
                }

                $product->addMedia($photo->getRealPath())->usingFileName($photo->getClientOriginalName())->toMediaCollection($collection);
            }

            $response['success'] = true;
        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->reset();
            $this->emit('alert_link', [
                'type'     => 'success',
                'title'    => 'Successfully Uploaded',
                'message'  => 'Photos successfully saved.',
            ]);
        }else{
            DB::rollback();
            $this->reset(['photos']);
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while uploading photos.'
            ]);
        }
    }
}
