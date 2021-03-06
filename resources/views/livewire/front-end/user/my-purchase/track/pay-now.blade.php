<div>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 text-center">
                    <button type="button" 
                        class="btn {{$payment_method == 'e_wallet' ? 'btn-primary':'btn-light' }}" 
                        @if($payment_method == 'card') 
                            onclick="change_payment_method('e_wallet')" 
                        @endif
                    ><span class="fas fa-money-bill"></span> E-Wallet @if($payment_method == 'e_wallet') <span class="fas fa-check"></span> @endif</button>
                    <button type="button" 
                        class="btn {{$payment_method == 'card' ? 'btn-primary':'btn-light' }}" 
                        @if($payment_method == 'e_wallet') 
                            onclick="change_payment_method('card')" 
                        @endif
                    ><span class="fas fa-credit-card"></span> Debit/Credit Card @if($payment_method == 'card') <span class="fas fa-check"></span> @endif</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($payment_method == 'e_wallet')    
                        <div class="p-3">
                            <strong>Select Payment :</strong>    
                            <div class="row my-3">
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
                        <div class="row my-3">
                            <div class="col-12">
                                @if($total_price < PaymentUtility::paymongo_minimum())
                                <p>(Minimum of PHP 100)</p>
                                @else
                                    @forelse($credit_cards as $row)
                                        <div class="row mb-3">
                                            <div class="col-sm-1">
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
                                        <p class="text-muted">You don't have debit/credit card yet.</p>
                                    @endforelse

                                    <a href="{{route('front-end.user.my-account.banks-and-cards')}}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Add New Debit/Credit Card
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-light" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:target="proceed" onclick="proceed()">
                        Proceed <span class="fas fa-spin fa-spinner" wire:loading wire:target="proceed"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

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

    window.livewire.on('remove_card_payment_method_loader', param => {
        // var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'hide');
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

    function set_card_token(key_token){
        // var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'show');
        @this.call('set_card_token', key_token)
    }

    function set_e_wallet(type){
        // var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'show');
        @this.call('set_e_wallet', type)
    }

    function change_payment_method(method){
        // var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'show');
        @this.call('change_payment_method', method)
    }

    function proceed(){
        // var card_dom = $('#card-payment_method');
        // card_loader(card_dom, 'show');
        @this.call('proceed')
    }
</script>
@endpush