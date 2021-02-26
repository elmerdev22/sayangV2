<div>
    @if($data)
        <article class="card card-body mb-3">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <figure class="itemside align-items-center">
                        <div class="aside"><img src="{{$component->product_featured_photo($data->product_id)}}" class="img-sm"></div>
                        <figcaption class="info">
                            <a href="#" class="title text-dark">{{ucfirst($data->product_name)}}</a>
                            <p class="small text-muted">
                                Bid amount: {{Utility::currency_code()}}{{number_format($data->bid_price,2)}}  
                                <br> 
                                Quantity: {{number_format($data->bid_quantity,0)}}
                                <br>
                                Total amount: {{Utility::currency_code()}}{{number_format($total_price,2)}}
                            </p>
                        </figcaption>
                    </figure>
                    {{-- <figure class="itemside">
                        <div class="aside"><img src="{{$component->product_featured_photo($data->product_id)}}" class="border img-sm"></div>
                        <figcaption class="info">
                            <a href="#" class="title">{{ucfirst($data->product_name)}}</a>
                            <div>
                                <span class="text-muted">Bid amount: {{Utility::currency_code()}}{{number_format($data->bid_price,2)}}</span>
                            </div>
                            <div>
                                <span class="text-muted">Quantity: {{number_format($data->bid_quantity,0)}}</span>
                            </div>
                            <div>
                                <span class="text-muted">Total amount: {{Utility::currency_code()}}{{number_format($total_price,2)}}</span>
                            </div>
                        </figcaption>
                    </figure>  --}}
                </div> <!-- col.// -->
                <div class="col">
                    <div>
                        <small class="text-muted">
                            Expiration
                        </small>
                    </div>
                    <div class="h6"> {{$component->expiration($data->date_end)}} </div>
                </div>
            </div> <!-- row.// -->
        </article>
        <div class="card">
            <header class="card-header">
                <strong class="d-inline-block mr-3">Biiling Address</strong>
                <a href="{{route('front-end.user.my-account.addresses')}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </header>
            <div class="card-body">
                @if($address)
                    <dl class="row">
                        <dt class="col-sm-3">Fullname</dt>
                        <dd class="col-sm-9">{{ucwords($address->full_name)}}</dd>

                        <dt class="col-sm-3">Contact number</dt>
                        <dd class="col-sm-9">{{Utility::mobile_number_ph_format($address->contact_no)}}</dd>

                        <dt class="col-sm-3">Address</dt>
                        <dd class="col-sm-9">
                            {{$address->address}} <br>
                            {{$address->philippine_barangay->name}}, {{$address->philippine_barangay->philippine_city->name}}, <br>
                            {{$address->philippine_barangay->philippine_city->philippine_province->name}}, 
                            {{$address->philippine_barangay->philippine_city->philippine_province->philippine_region->name}}, {{$address->zip_code}} <br>
                        </dd>
                    </dl>
                @else
                    <p class="text-muted mb-3 mt-3 text-center">You don't have address yet.</p>
                @endif
            </div>
        </div>
        <br>
        <div class="card">
            <header class="card-header">
                <strong class="d-inline-block mr-3">Payment Method</strong>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-center mb-3">
                        <button type="button" 
                            class="btn {{$payment_method == 'cash_on_pickup' ? 'btn-primary':'btn-light' }}" 
                            @if($payment_method != 'cash_on_pickup') 
                                onclick="change_payment_method('cash_on_pickup')" 
                            @endif
                        ><span class="fas fa-truck"></span> Cash on Pickup @if($payment_method == 'cash_on_pickup') <span class="fas fa-check"></span> @endif</button>
                        <button type="button" 
                            class="btn {{$payment_method == 'e_wallet' ? 'btn-primary':'btn-light' }}" 
                            @if($payment_method != 'e_wallet') 
                                onclick="change_payment_method('e_wallet')" 
                            @endif
                        ><span class="fas fa-money-bill"></span> E-Wallet @if($payment_method == 'e_wallet') <span class="fas fa-check"></span> @endif</button>
                        <button type="button" 
                            class="btn {{$payment_method == 'card' ? 'btn-primary':'btn-light' }}" 
                            @if($payment_method != 'card') 
                                onclick="change_payment_method('card')" 
                            @endif
                        ><span class="fas fa-credit-card"></span> Debit/Credit Card @if($payment_method == 'card') <span class="fas fa-check"></span> @endif</button>
                    </div>
                    <div class="col-12">
                        @if($payment_method == 'cash_on_pickup')
                            <div class="p-3">
                                <p>
                                    Payment via Cash on Pick-up
                                </p>
                            </div>
                            <!-- <p>Description here...</p> -->
                        @elseif($payment_method == 'e_wallet')
                            <div class="p-3">
                                <strong>Select Payment :</strong>
                                <div class="row py-3">
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
                            </div>        
                        @else
                            <div class="p-3">
                                <strong>Select Credit/Debit Card :</strong>
                                @if($total_price < PaymentUtility::paymongo_minimum())
                                    <p>(Minimum of PHP {{PaymentUtility::paymongo_minimum()}})</p>
                                @else
                                    @forelse($credit_cards as $row)
                                        <div class="row mb-3">
                                            <div class="col-sm-1">
                                                <span class="icheck-primary">
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
                                            
                                            <dt class="col-sm-3">Card Holder Name</dt>
                                            <dd class="col-sm-8">{{ucwords($row->card_holder)}}</dd>

                                            <dt class="col-sm-1"></dt>
                                            <dt class="col-sm-3">Card Number</dt>
                                            <dd class="col-sm-8">{{$row->card_no}}</dd>

                                            <dt class="col-sm-1"></dt>
                                            <dt class="col-sm-3">CVV</dt>
                                            <dd class="col-sm-8">{{$row->card_verification_value}}</dd>
                                        </div>
                                    @empty
                                        <p class="text-muted py-3">You don't have debit/credit card yet.</p>
                                    @endforelse

                                    <a href="{{route('front-end.user.my-account.banks-and-cards')}}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus"></i> Add New Debit/Credit Card
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 text-right">
                <button type="button" class="btn btn-light" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:target="proceed" onclick="proceed()">
                    Proceed <span class="fas fa-spin fa-spinner" wire:loading wire:target="proceed"></span>
                </button>
            </div>
        </div>
    @endif
</div>


@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        window.addEventListener('message', ev => {
                if (ev.data === '3DS-authentication-complete') {
                    payment_3d_completed();
                }
            },
            false
        );
    });

    window.livewire.on('payment_3d_secure', param => {
        var url = param['url'];
        $('#modal-payment_3rd_secure_iframe').html(`<iframe src="`+url+`" title="3D Secure" style="width: 100%; height: 70vh; border: 0px;"></iframe>`);
        setTimeout(function (){
            $('#modal-pay_now').modal('hide'); 
            $('#modal-payment_3d_secure').modal('show'); 
        }, 2000);
    });
    
    function payment_3d_completed(){
        $('#modal-payment_3d_secure').modal('hide');
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Processing Payment...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('paymongo_pay_card', true)
            }
        });
    }

    window.livewire.on('remove_loading_card', param => {
        var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'hide');
    });

    function change_payment_method(method){
        var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'show');
        @this.call('change_payment_method', method)
    }

    function set_card_token(key_token){
        var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'show');
        @this.call('set_card_token', key_token)
    }

    function set_e_wallet(type){
        var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'show');
        @this.call('set_e_wallet', type)
    }

    function proceed(){
        var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'show');
        @this.call('proceed')
    }
</script>
@endpush
