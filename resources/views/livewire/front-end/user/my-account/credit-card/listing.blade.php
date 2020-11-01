<div>
    @forelse($credit_cards as $row)
        <blockquote class="@if($row->is_default) quote-warning @else quote-secondary @endif">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div title="Card Holder Name">
                        <span class="fas fa-user"></span> {{ucwords($row->card_holder)}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div title="Card No.">
                        <span class="fas fa-credit-card"></span> {{$row->card_no}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div title="CVV">
                        <span class="fas fa-key"></span> {{$row->card_verification_value}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    @if(!$row->is_default)
                        <button type="button" class="btn btn-sm btn-default">Set Default</button>
                    @else
                        <button type="button" class="btn btn-sm btn-default" disabled="true">Set Default</button>
                        <span class="badge badge-info">Default</span>
                    @endif
                </div>
            </div>
        </blockquote>
    @empty
        <p class="text-center">You don't have credit card yet.</p>
    @endif
</div>
