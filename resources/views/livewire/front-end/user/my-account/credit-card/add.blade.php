<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="modal-body">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" id="card_no" class="form-control mask-credit-card-number @error('card_no') is-invalid @enderror" wire:model.lazy="card_no" placeholder="Credit Card No.">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fab fa-cc-visa"></i> &nbsp; <i class="fab fa-cc-amex"></i> &nbsp; 
                            <i class="fab fa-cc-mastercard"></i> 
                        </span>
                    </div>
                </div>
                @error('card_no') 
                    <span class="invalid-feedback d-block">
                        <span>{{$message}}</span>
                    </span> 
                @enderror
            </div>
            <div class="form-group">
                <input type="text" id="card_holder" class="form-control text-capitalize @error('card_holder') is-invalid @enderror" wire:model.lazy="card_holder" placeholder="Card Holder Name">
                @error('card_holder') 
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span> 
                @enderror
            </div>

            <label for="">Expiration Date</label>
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-6">
                            <select name="expiration_month" class="form-control @error('expiration_month') is-invalid @enderror" wire:model.lazy="expiration_month" id="MM">
                                <option value="" selected>Month</option>
                                @foreach($months as $month)
                                    <option value="{{$month}}">{{$month}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <select name="expiration_year" class="form-control @error('expiration_year') is-invalid @enderror" wire:model.lazy="expiration_year" id="YY">
                                <option value="" selected>Year</option>
                                @foreach($years as $year)
                                    <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('expiration_month') 
                        <span class="invalid-feedback d-block">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                    @error('expiration_year') 
                        <span class="invalid-feedback d-block">
                            <span>{{$message}}</span>
                        </span> 
                    @enderror
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" id="cvv" class="form-control @error('cvv') is-invalid @enderror" wire:model.lazy="cvv" placeholder="CVV/CVC">
                        @error('cvv') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" wire:model.lazy="email" placeholder="Email Address">
                @error('email') 
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span> 
                @enderror
            </div>

            <div class="form-group">
                <input type="text" id="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" wire:model.lazy="mobile_no" placeholder="Mobile Number">
                @error('mobile_no') 
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span> 
                @enderror
            </div>

            <div class="form-group">
                <div class="icheck-primary">
                    <input type="checkbox" id="is_default_card" @if($force_default) disabled checked @else wire:model="is_default" @endif>
                    <label for="is_default_card">Set as default credit card</label>
                </div>
            </div>

            @if($error_message)
                <div>
                    <span class="invalid-feedback d-block">
                        <span>{{$error_message}}</span>
                    </span>
                </div>
            @endif
        </div>
        <div class="modal-footer">
            <div class="text-right">
                <button type="button" wire:loading.attr="disabled" wire:target="store" class="btn btn-flat btn-sm btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" wire:loading.attr="disabled" wire:target="store" class="btn btn-flat btn-sm btn-warning">
                    Add @if($is_checkout_page) and Select @endif <span wire:loading wire:target="store"><i class="fas fa-spinner fa-spin"></i></span>
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        $('.mask-credit-card-number').mask("####-####-####-####", {reverse: false});
    });
    window.livewire.on('credit_card_initialize', param => {
        $('#modal-add_credit_card').modal('hide');        
        Swal.close();
    });
</script>
@endpush