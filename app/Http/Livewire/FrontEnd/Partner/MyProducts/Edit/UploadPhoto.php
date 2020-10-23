<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\Edit;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Model\Product;
use DB;
use Utility;

class UploadPhoto extends Component
{
    use WithFileUploads;

    public $partner, $account, $product;
    public $photos = [];

    public function mount($product_id){
        $this->partner = Utility::auth_partner();
        $this->account = Utility::auth_user_account();
        $this->product = Product::findOrFail($product_id);
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
            $collection = $this->account->key_token.'/product/'.$product->key_token.'/photo/';

            foreach($this->photos as $key => $photo){
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
