<div>
    <article class="accordion" id="accordion_pay">
        <div class="card m-0">
            <header class="card-header">
                <img src="{{asset('images/icons/payments/cash.jpg')}}" class="float-right" height="24"> 
                <label class="form-check" data-toggle="collapse" data-target="#pay_paynet" aria-expanded="true">
                    <input class="form-check-input" name="payment-option" 
                        {{$payment_method == 'cash_on_pickup' ? 'checked':'' }} 
                        @if($payment_method != 'cash_on_pickup') 
                            onclick="change_payment_method('cash_on_pickup')" 
                        @endif
                        type="radio"
                        value="option2"
                    >
                    <h6 class="form-check-label"> 
                        Cash On Pickup 
                    </h6>
                </label>
            </header>
            <div id="pay_paynet" class="collapse {{$payment_method == 'cash_on_pickup' ? 'show':'' }}" data-parent="#accordion_pay" style="">
            <div class="card-body">
                <h5 class="mb-3"><b>Header</b></h5>
                <p>Description here...</p>
            </div> <!-- card body .// -->
            </div> <!-- collapse .// -->
        </div> <!-- card.// -->
        <div class="card m-0">
            <header class="card-header">
                <img src="{{asset('images/icons/payments/gcash.png')}}" class="float-right" height="24">  
                <label class="form-check collapsed" data-toggle="collapse" data-target="#pay_payme" aria-expanded="false">
                    <input class="form-check-input" name="payment-option" 
                        {{$payment_method == 'e_wallet' ? 'checked':'' }} 
                        @if($payment_method != 'e_wallet') 
                            onclick="change_payment_method('e_wallet')" 
                        @endif
                        type="radio" 
                        value="option2"
                    >
                    <h6 class="form-check-label"> E-Wallet  </h6>
                </label>
            </header>
            <div id="pay_payme" class="collapse {{$payment_method == 'e_wallet' ? 'show':'' }}" data-parent="#accordion_pay" style="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="payment-channel-wrapper @if($e_wallet == 'gcash') active @endif" 
                                @if($e_wallet != 'gcash') 
                                    @if($total_price >= $paymongo_minimum)
                                        onclick="set_e_wallet('gcash')" 
                                    @endif
                                @endif
                            >
                                @if($total_price < $paymongo_minimum)
                                    <div class="payment-channel-disabled">(Minimum of PHP {{number_format($paymongo_minimum,2)}})</div>
                                @endif
                                @if($e_wallet == 'gcash') 
                                    <span class="fas fa-check fa-lg mr-2 payment-channel-selected-icon"></span>
                                @endif
                                <img src="{{asset('images/icons/payments/gcash.png')}}" height="42px" alt="GCash Photo">
                            </div>
                            <div class="payment-channel-wrapper @if($e_wallet == 'grab_pay') active @endif" 
                                @if($e_wallet != 'grab_pay') 
                                    @if($total_price >= $paymongo_minimum)
                                        onclick="set_e_wallet('grab_pay')" 
                                    @endif
                                @endif
                            >
                                @if($total_price < $paymongo_minimum)
                                    <div class="payment-channel-disabled">(Minimum of PHP {{number_format($paymongo_minimum,2)}})</div>
                                @endif
                                @if($e_wallet == 'grab_pay') 
                                    <span class="fas fa-check fa-lg mr-2 payment-channel-selected-icon"></span>
                                @endif
                                <img src="{{asset('images/icons/payments/grab-pay.png')}}" height="42px" alt="Grab Pay Photo">
                            </div>
                        </div>
                    </div>
                </div> <!-- card body .// -->
            </div> <!-- collapse .// -->
        </div> <!-- card.// -->
        <div class="card m-0">
            <header class="card-header">
                <img src="{{asset('images/icons/payments/payments.png')}}" class="float-right" height="24">  
                <label class="form-check collapsed" data-toggle="collapse" data-target="#pay_card" aria-expanded="false">
                    <input class="form-check-input" name="payment-option" type="radio" 
                        {{$payment_method == 'card' ? 'checked':'' }} 
                        @if($payment_method != 'card') 
                            onclick="change_payment_method('card')" 
                        @endif
                        value="option1"
                    >
                    <h6 class="form-check-label">Card </h6>
                </label>
            </header>
            <div id="pay_card" class="collapse {{$payment_method == 'card' ? 'show':'' }}" data-parent="#accordion_pay" style="">
                <div class="card-body">
                    @if($total_price < PaymentUtility::paymongo_minimum())
                        <p>(Minimum of PHP 100)</p>
                    @else
                        <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modal-add_credit_card">
                            <i class="fas fa-plus"></i> Add New Debit/Credit Card
                        </button>
                        @forelse($credit_cards as $row)
                            <div class="row mb-3">
                                <dt class="col-sm-1">
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
                                </dt>
                                
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
                    @endif
                </div> <!-- card body .// -->
            </div> <!-- collapse .// -->
        </div> <!-- card.// -->
    </article>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('remove_loading_card', param => {
        Swal.close();
    });

    function initialize_payment_key_token(key_token){
        @this.call('initialize_payment_key_token', key_token)
    }

    function change_payment_method(method){
        @this.call('change_payment_method', method)
    }

    function set_e_wallet(type){
        @this.call('set_e_wallet', type)
    }
</script>
@endpush