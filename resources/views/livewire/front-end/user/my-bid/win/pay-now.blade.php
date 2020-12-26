<div>
    @if($data)
        <table class="table table-borderless table-hover table-shopping-cart table-custom">
            <thead>
                <tr class="border-bottom">
                    <th scope="col">Item</th>
                    <th scope="col">Bid Qty</th>
                    <th scope="col">Bid Price</th>
                    <th scope="col">Expiration</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-12 overflow-hidden">
                                <img src="{{$component->product_featured_photo($data->product_id)}}" class="img-sm border cart-product-photo-thumb">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <p class="title mb-0">{{ucfirst($data->product_name)}}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{number_format($data->bid_quantity,0)}}</td>
                    <td>{{number_format($data->bid_quantity * $data->bid_price,2)}}</td>
                    <td>{{$component->expiration($data->date_end)}}</td>
                </tr>
            </tbody>
        </table>
        <h4>Billing Information</h4>
            @if($address)
                <div class="mb-4">
                    <div class="row">
                        <div class="col-12">
                            <span class="fas fa-user"></span> <strong>{{ucwords($address->full_name)}}</strong>
                        </div>
                    </div>
                    <div>
                        <span class="fas fa-phone"></span> {{Utility::mobile_number_ph_format($address->contact_no)}}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <span class="fas fa-map-marker"></span>
                            {{$address->address}} <br>
                            {{$address->philippine_barangay->name}}, {{$address->philippine_barangay->philippine_city->name}}, <br>
                            {{$address->philippine_barangay->philippine_city->philippine_province->name}}, 
                            {{$address->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}, {{$address->zip_code}} <br>
                        </div>
                    </div>        

                    <a class="btn btn-sm btn-warning" href="{{route('front-end.user.my-account.addresses')}}"><i class="fas fa-edit"></i> Change Default Address</a>
                </div>
            @else
                <p class="text-muted mb-3 mt-3">You don't have address yet.</p>
                <a class="btn btn-sm btn-warning" href="{{route('front-end.user.my-account.addresses')}}"><i class="fas fa-plus-square"></i> Add Addresses</a>
            @endif
        <hr>
        <h4>Payment Method</h4>
        <div class="row mb-3">
            <div class="col-12">
                <button type="button" 
                    class="btn btn-sm {{$payment_method == 'cash_on_pickup' ? 'btn-warning':'btn-default' }}" 
                    @if($payment_method != 'cash_on_pickup') 
                        onclick="change_payment_method('cash_on_pickup')" 
                    @endif
                ><span class="fas fa-truck"></span> Cash on Pickup @if($payment_method == 'cash_on_pickup') <span class="fas fa-check"></span> @endif</button>
                <button type="button" 
                    class="btn btn-sm {{$payment_method == 'e_wallet' ? 'btn-warning':'btn-default' }}" 
                    @if($payment_method != 'e_wallet') 
                        onclick="change_payment_method('e_wallet')" 
                    @endif
                ><span class="fas fa-money-bill"></span> E-Wallet @if($payment_method == 'e_wallet') <span class="fas fa-check"></span> @endif</button>
                <button type="button" 
                    class="btn btn-sm {{$payment_method == 'card' ? 'btn-warning':'btn-default' }}" 
                    @if($payment_method != 'card') 
                        onclick="change_payment_method('card')" 
                    @endif
                ><span class="fas fa-credit-card"></span> Debit/Credit Card @if($payment_method == 'card') <span class="fas fa-check"></span> @endif</button>
            </div>
        </div>

        @if($payment_method == 'cash_on_pickup')
            <h5 class="mb-3"><b>Payment via Cash on Pick-up</b></h5>
            <!-- <p>Description here...</p> -->
        @elseif($payment_method == 'e_wallet')        
            <h5><b>Select Payment</b></h5>
            <div class="row">
                <div class="col-12">
                    <div class="payment-channel-wrapper @if($e_wallet == 'gcash') active @endif" 
                        @if($e_wallet != 'gcash') 
                            @if($total_price >= PaymentUtility::paymongo_minimum())
                                onclick="set_e_wallet('gcash')" 
                            @endif
                        @endif
                    >
                        @if($total_price < PaymentUtility::paymongo_minimum())
                            <div class="payment-channel-disabled">(Minimum of PHP {{number_format(PaymentUtility::paymongo_minimum())}})</div>
                        @endif
                        @if($e_wallet == 'gcash') 
                            <span class="fas fa-check fa-lg mr-2 payment-channel-selected-icon"></span>
                        @endif
                        <img src="{{asset('images/icons/payments/gcash.png')}}" height="42px" alt="GCash Photo">
                    </div>
                    <div class="payment-channel-wrapper @if($e_wallet == 'grab_pay') active @endif" 
                        @if($e_wallet != 'grab_pay') 
                            @if($total_price >= PaymentUtility::paymongo_minimum())
                                onclick="set_e_wallet('grab_pay')" 
                            @endif
                        @endif
                    >
                        @if($total_price < PaymentUtility::paymongo_minimum())
                            <div class="payment-channel-disabled">(Minimum of PHP {{number_format(PaymentUtility::paymongo_minimum())}})</div>
                        @endif
                        @if($e_wallet == 'grab_pay') 
                            <span class="fas fa-check fa-lg mr-2 payment-channel-selected-icon"></span>
                        @endif
                        <img src="{{asset('images/icons/payments/grab-pay.png')}}" height="42px" alt="Grab Pay Photo">
                    </div>
                </div>
            </div>
        @else
            <h5 class="mb-3"><b>Select Credit/Debit Card</b></h5>
            @if($total_price < PaymentUtility::paymongo_minimum())
                <p>(Minimum of PHP 100)</p>
            @else
                @forelse($credit_cards as $row)
                    <div class="row mb-3">
                        <div class="col-1">
                            <span class="icheck-warning">
                                <input  type="radio" 
                                        id="op-radio-{{$row->key_token}}" 
                                        name="bank" 
                                        @if($card_token == $row->key_token) 
                                            checked="true" 
                                        @else 
                                            onclick="set_card_token('{{$row->key_token}}')"
                                        @endif>
                                <label for="op-radio-{{$row->key_token}}"></label>
                            </span>
                        </div>
                        <div class="col-9 col-md-3">
                            <div title="Card Holder Name">
                                <span class="fas fa-user"></span> {{ucwords($row->card_holder)}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div title="Card No.">
                                <span class="fas fa-credit-card"></span> {{$row->card_no}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div title="CVV">
                                <span class="fas fa-key"></span> {{$row->card_verification_value}}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">You don't have debit/credit card yet.</p>
                @endforelse

                <a href="{{route('front-end.user.my-account.banks-and-cards')}}" class="btn btn-warning btn-sm">
                    <i class="fas fa-plus"></i> Add New Debit/Credit Card
                </a>
            @endif
        @endif

        <div class="row mt-3">
            <div class="col-12 text-right">
                <button type="button" class="btn btn-sm btn-warning" wire:loading.attr="disabled" wire:target="proceed" onclick="proceed()">
                    Proceed <span class="fas fa-spin fa-spinner" wire:loading wire:target="proceed"></span>
                </button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    @endif
</div>