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
        @forelse($banks as $row)
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
        </button>
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
                                    wire:click="initialize_payment_key_token('{{$row->key_token}}')"
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
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('remove_loading_card', param => {
        var card_dom = $('#card-billing');
        card_loader(card_dom, 'hide');
        Swal.close();
    });

    function change_payment_method(method){
        var card_dom = $('#card-billing');
        card_loader(card_dom, 'show');
        @this.call('change_payment_method', method)
    }
</script>
@endpush