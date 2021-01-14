<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use UploadUtility;

class OrderPaymentPayout extends Model implements HasMedia
{
    use HasMediaTrait;

    public function order_payment_payout_batch(){
        return $this->hasOne('App\Model\OrderPaymentPayoutBatch', 'payout_batch_id', 'id');
    }

    public function order_payment_payout_batches(){
        return $this->hasMany('App\Model\OrderPaymentPayoutBatch', 'payout_batch_id', 'id');
    }

    public function order_payment_payout_item(){
        return $this->belongsTo('App\Model\OrderPaymentPayoutItem', 'order_payment_payout_item_id', 'id');
    }

    public function order_payment_payout_items(){
        return $this->belongsTo('App\Model\OrderPaymentPayoutItem', 'order_payment_payout_item_id', 'id');
    }

    public function registerMediaConversions(Media $media = null){
        $height = UploadUtility::conversion_dimension('height');
        $width  = UploadUtility::conversion_dimension('width');

        $this->addMediaConversion('thumb')->height($height)->width($width);
    }
}
