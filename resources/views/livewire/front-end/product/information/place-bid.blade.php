<div>
    <div class="row">
        <div class="col-12">
            <p>Top bidders get the remaining items after auction ends!</p>
            <div class="row justify-content-center">
                @if($allow_purchase == 'allowed')
                    <div class="col-md-6">
                        <label>
                            Bid Increment
                            {{Utility::currency_code()}} {{number_format($bid_increment, 2)}} 
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-light" id="btn-bid-price-minus" {{$lowest_bid >= $bid ? 'disabled' : ''}}><span class="fas fa-minus"></span></button>
                            </div>
                            <input type="text" class="form-control text-center" id="bid-price" min="{{$lowest_bid}}" wire:model="bid">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-light" id="btn-bid-price-plus"><span class="fas fa-plus"></span></button>
                            </div>
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
                    <div class="col-md-6">
                        <label>Quantity</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-light" id="btn-quantity-minus-2" @if($quantity <= 1) disabled="true" @endif><span class="fas fa-minus"></span></button>
                            </div>
                            <input type="number" class="form-control text-center input-number-remove-arrow" id="quantity-2" min="1" max="{{$current_quantity}}" wire:model="quantity">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-light rounded-right" id="btn-quantity-plus-2" @if($quantity >= $current_quantity) disabled="true" @endif><span class="fas fa-plus"></span></button>
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
                            {{Utility::currency_code()}} {{number_format($bid_increment, 2)}} 
                        </label>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        @if(session('reach_buy_now_price'))
            <div class="col-12 mt-3">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{session('reach_buy_now_price')}}
                </div>
            </div>
        @endif
        <div class="col-12 mt-3">
            @if($allow_purchase == 'allowed')
                <p>From this purchase, you'll rescue</p>
                <small>
                    <div class="row text-center">
                        <div class="col-4">	
                            <figure class="item-feature">
                                <span class="text-primary"><i class="fa fa fa-seedling"></i></span> 
                                <span>{{number_format(Utility::elements_multiplier($product_post->id)['trees'] * $quantity, $elements_round_off)}} trees  </span>
                            </figure> <!-- iconbox // -->
                        </div><!-- col // -->
                        <div class="col-4">	
                            <figure  class="item-feature">
                                <span class="text-info"><i class="fa fa fa-tint"></i></span>	
                                <span>{{number_format(Utility::elements_multiplier($product_post->id)['water'] * $quantity, $elements_round_off)}} gal of water</span>
                            </figure> <!-- iconbox // -->
                        </div><!-- col // -->
                        <div class="col-4">	
                            <figure  class="item-feature">
                                <span class="text-warning"><i class="fa fa fa-bolt"></i></span>
                                <span>{{number_format(Utility::elements_multiplier($product_post->id)['energy'] * $quantity, $elements_round_off)}} kw of energry</span>
                            </figure> <!-- iconbox // -->
                        </div> <!-- col // -->
                    </div>
                </small>
                <div class="bg-primary rounded py-1 px-2 mt-4">
                    <h5 class="mb-0 p-1 text-white">Your Total: {{Utility::currency_code()}}{{number_format($total_amount, 2)}}</h5>
                </div>
                <div class="py-2 mt-4">
                    <button class="btn btn-light w-100" onclick="confirm_bid('{{$bid != null ? number_format($bid, 2) : $bid}}')">
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
                            class="btn btn-light w-100">
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
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Name</th>
                            <th scope="col">Bid</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Allocated Qty</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ranking as $key => $data)
                            <tr>
                                @php
                                    $current_quantity -= $data->quantity;
                                    $updated_quantity  = $current_quantity + $data->quantity;
                                @endphp
                                <td>{{++$key}}</td>
                                <td>{{$data->user_account->first_name}} </td>
                                <td>{{Utility::currency_code()}}{{number_format($data->bid, 2)}}</td>
                                <td>{{number_format($data->quantity, 0)}}</td>
                                <td>
                                    @if ($updated_quantity >= $data->quantity)
                                        {{number_format($data->quantity, 0)}}
                                    @else
                                        {{number_format($updated_quantity < 0 ? 0 : $updated_quantity, 0)}}
                                    @endif
                                </td>
                                <td>
                                    {{$updated_quantity <= 0 ? 'Losing' : 'Winning'}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Bids.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($allow_purchase == 'allowed' && $view_my_bids)
                <div class="my-2">
                    <div>
                        <button class="btn btn-primary btn-sm" onclick="all_my_bids()">View all my bids in this product</button>
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
        title: 'Your Bid is : {{Utility::currency_code()}}'+bid,
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