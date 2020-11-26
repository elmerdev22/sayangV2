<div>
    <h4 class="mb-3">Payment Method</h4>
    <div class="d-block my-3">
        <button type="button" 
            class="btn btn-sm {{$payment_method == 'e_wallet' ? 'btn-warning':'btn-default' }}" 
            @if($payment_method == 'card') 
                onclick="change_payment_method('e_wallet')" 
            @endif
        ><span class="fas fa-money-bill"></span> E-Wallet @if($payment_method == 'e_wallet') <span class="fas fa-check"></span> @endif</button>
        <button type="button" 
            class="btn btn-sm {{$payment_method == 'card' ? 'btn-warning':'btn-default' }}" 
            @if($payment_method == 'e_wallet') 
                onclick="change_payment_method('card')" 
            @endif
        ><span class="fas fa-credit-card"></span> Debit/Credit Card @if($payment_method == 'card') <span class="fas fa-check"></span> @endif</button>
    </div>

    @if($payment_method == 'e_wallet')        
        <h5><b>Select Payment</b></h5>
        <div class="row">
            <div class="col-12">
                <div class="payment-channel-wrapper @if($e_wallet == 'gcash') active @endif" 
                    @if($e_wallet != 'gcash') 
                        @if($total_price >= $component->min_amount('gcash'))
                            onclick="set_e_wallet('gcash')" 
                        @endif
                    @endif
                >
                    @if($total_price < $component->min_amount('gcash'))
                        <div class="payment-channel-disabled">(Minimum of PHP {{number_format($component->min_amount('gcash'))}})</div>
                    @endif
                    @if($e_wallet == 'gcash') 
                        <span class="fas fa-check fa-lg mr-2 payment-channel-selected-icon"></span>
                    @endif
                    <img src="{{asset('images/icons/payments/gcash.png')}}" height="42px" alt="GCash Photo">
                </div>
                <div class="payment-channel-wrapper @if($e_wallet == 'grab_pay') active @endif" 
                    @if($e_wallet != 'grab_pay') 
                        @if($total_price >= $component->min_amount('grab_pay'))
                            onclick="set_e_wallet('grab_pay')" 
                        @endif
                    @endif
                >
                    @if($total_price < $component->min_amount('grab_pay'))
                        <div class="payment-channel-disabled">(Minimum of PHP {{number_format($component->min_amount('grab_pay'))}})</div>
                    @endif
                    @if($e_wallet == 'grab_pay') 
                        <span class="fas fa-check fa-lg mr-2 payment-channel-selected-icon"></span>
                    @endif
                    <img src="{{asset('images/icons/payments/grab-pay.png')}}" height="42px" alt="Grab Pay Photo">
                </div>
            </div>
        </div>

        <!-- @forelse($banks as $row)
            <div class="row mb-3">
                <div class="col-1">
                    <span class="icheck-warning">
                        <input  type="radio" 
                                id="op-radio-{{$row->key_token}}" 
                                name="bank" 
                                @if($payment_key_token == $row->key_token) 
                                    checked="true" 
                                @else 
                                    wire:click="initialize_payment_key_token('{{$row->key_token}}')"
                                @endif>
                        <label for="op-radio-{{$row->key_token}}"></label>
                    </span>
                </div>
                <div class="col-9 col-md-2">
                    <div title="Bank Name">
                        <span class="fas fa-building"></span> <strong>{{$row->bank->name}}</strong> 
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div title="Account Name">
                        <span class="fas fa-user"></span> {{ucwords($row->account_name)}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div title="Account No.">
                        <span class="fas fa-credit-card"></span> {{$row->account_no}}
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">You don't have bank account yet.</p>
        @endforelse

        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-add_bank">
            <i class="fas fa-plus"></i> Add New Bank
        </button> -->
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
                                    @if($payment_key_token == $row->key_token) 
                                        checked="true" 
                                    @else 
                                        onclick="initialize_payment_key_token('{{$row->key_token}}')"
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

            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-add_credit_card">
                <i class="fas fa-plus"></i> Add New Debit/Credit Card
            </button>
        @endif
    @endif
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('remove_loading_card', param => {
        var card_dom = $('#card-billing');
        card_loader(card_dom, 'hide');
        Swal.close();
    });

    function initialize_payment_key_token(key_token){
        var card_dom = $('#card-billing');
        card_loader(card_dom, 'show');
        @this.call('initialize_payment_key_token', key_token)
    }

    function change_payment_method(method){
        var card_dom = $('#card-billing');
        card_loader(card_dom, 'show');
        @this.call('change_payment_method', method)
    }

    function set_e_wallet(type){
        var card_dom = $('#card-billing');
        card_loader(card_dom, 'show');
        @this.call('set_e_wallet', type)
    }
</script>
@endpush