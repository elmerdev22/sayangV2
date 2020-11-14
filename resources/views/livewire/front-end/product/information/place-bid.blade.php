<div>
    <div class="row">
        <div class="col-12">
            <p>Top bidders get the remaining items after auction ends!</p>
            <div class="row justify-content-center">
                @if($allow_purchase == 'allowed')
                    <div class="col-md-6">
                        <label>
                            Bid Increment
                            ₱ {{number_format($bid_increment, 2)}} 
                        </label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-default" id="btn-bid-price-minus" {{$lowest_bid >= $bid ? 'disabled' : ''}}><span class="fas fa-minus"></span></button>
                            </div>
                            <input type="text" class="form-control text-center" id="bid-price" min="{{$lowest_bid}}" wire:model="bid">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default" id="btn-bid-price-plus"><span class="fas fa-plus"></span></button>
                            </div>
                            @error('bid')
                            <div class="text-center">
                                <small class="text-danger">{{$message}}</small>
                            </div>
                            @enderror
                            @if(session('minimum_bid'))
                            <div class="text-center">
                                <small class="text-danger">{{session('minimum_bid')}}</small>
                            </div>
                            @endif
                            @if(session('buy_now_price_reach'))
                            <div class="text-center">
                                <small class="text-danger">{{session('buy_now_price_reach')}}</small>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Quantity</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-default" id="btn-quantity-minus-2" @if($quantity <= 1) disabled="true" @endif><span class="fas fa-minus"></span></button>
                            </div>
                            <input type="number" class="form-control text-center input-number-remove-arrow" id="quantity-2" min="1" max="{{$current_quantity}}" wire:model="quantity">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-default" id="btn-quantity-plus-2" @if($quantity >= $current_quantity) disabled="true" @endif><span class="fas fa-plus"></span></button>
                            </div>
                        </div>
                        @if(session('quantity_required'))
                        <div class="text-center">
                            <small class="text-danger">{{session('quantity_required')}}</small>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="col-12 text-center">
                        <label>
                            Bid Increment
                            ₱ {{number_format($bid_increment, 2)}} 
                        </label>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if($allow_purchase == 'allowed')
                <div class="bg-warning py-1 px-2 mt-4">
                    <h4 class="mb-0 text-white">Your Total: ₱{{number_format($total_amount, 2)}}</h4>
                </div>
                <div class="py-2 px-3 mt-4">
                    <button class="btn btn-default w-100" onclick="confirm_bid('{{number_format($bid, 2)}}')">
                        CONFIRM BID <span wire:loading wire:target="confirm_bid" class="fas fa-spinner fa-spin"></span>
                    </button>
                </div>
            @elseif($allow_purchase == 'login')
                <div class="row">
                    <div class="col-12 p-1">
                        <a href="{{route('front-end.product.information.login-redirect', [
                                'slug'      => $product_post->product->slug,
                                'key_token' => $product_post->key_token,
                                'type'      => 'place_bid'
                            ])}}" 
                            class="btn btn-default w-100">
                            Login to Bid
                        </a>
                    </div>
                </div>
            @elseif($allow_purchase == 'not_verified')
                <div class="row">
                    <div class="col-12 p-1 text-center">
                        Registered email not verified
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 p-1 text-center">
                        Login as User to Bid
                    </div>
                </div>
            @endif

            <hr>
            
            <p>Rankings Top {{$this->ranking_top_show}} | Total Bids: {{number_format($ranking->total(), 0)}}</p>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th scope="col">Rank</th>
                        <th scope="col">Name</th>
                        <th scope="col">Bid</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $quan = $current_quantity;    
                    @endphp
                    @forelse ($ranking as $key => $data)
                    <tr>
                        @php
                            $quan = $quan - $data->quantity;    
                        @endphp
                        <td>{{++$key}}</td>
                        <td>{{$data->user_account->first_name}}</td>
                        <td>₱{{number_format($data->bid, 2)}}</td>
                        <td>{{number_format($data->quantity, 0)}}</td>
                        <td>{{$quan >= 0  ? 'Winning' : 'Losing'}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No Bids.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if($allow_purchase == 'allowed' && $view_my_bids)
                <div>
                    <div>
                        <button class="btn btn-warning btn-sm" onclick="all_my_bids()">View all my bids in this product</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        // $('.mask-money').mask("#,##0.00", {reverse: true});
        $('#quantity-2').val('{{$quantity}}');
        $('#bid-price').val('{{$bid}}');
        $('#bid-price').on('input', function (e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });

        quantityField('#quantity-2', '#btn-quantity-minus-2', '#btn-quantity-plus-2');
        $(document).on('change', '#quantity-2', function (){
            @this.call('validate_quantity', $('#quantity-2').val())
        });
        $(document).on('change', '#quantity-2', function (){
            @this.call('validate_quantity', $('#quantity-2').val())
        });
        $(document).on('keyup', '#quantity-2', function (){
            @this.call('validate_quantity', $('#quantity-2').val())
        });
        $(document).on('click', '#btn-quantity-minus-2', function () {
            @this.call('validate_quantity', $('#quantity-2').val())
        });
        $(document).on('click', '#btn-quantity-plus-2', function () {
            @this.call('validate_quantity', $('#quantity-2').val())
        });

        quantityField('#bid-price', '#btn-bid-price-minus', '#btn-bid-price-plus', {{$bid_increment}});
        $(document).on('change', '#bid-price', function (){
            @this.call('set_bid', $('#bid-price').val())
        });
        $(document).on('keyup', '#bid-price', function (){
            @this.call('set_bid', $('#bid-price').val())
        });
        $(document).on('click', '#btn-bid-price-minus', function () {
            @this.call('set_bid', $('#bid-price').val())
        });
        $(document).on('click', '#btn-bid-price-plus', function () {
            @this.call('set_bid', $('#bid-price').val())
        });
    });

    window.livewire.on('place_bid_quantity_value', param => {
        $(document).find('#quantity-2').val(param['quantity']);
    });

    var event_channel = push_init.subscribe('product-post-update-channel');
    event_channel.bind('product-post-update-event', function(param) {
        @this.call('product_post_update_event', param)
    });

    function confirm_bid(bid){
        Swal.fire({
        title: 'Your Bid is : ₱'+bid,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Confirm`,
        denyButtonText: `Don't save`,
        reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('confirm_bid')
            } 
        })
    }
    
    function all_my_bids(){
        window.livewire.emit('show-my-bids');
        $('#my-all-bids').modal('show');
    }
</script>
@endpush