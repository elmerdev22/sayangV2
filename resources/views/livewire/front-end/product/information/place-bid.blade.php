<div>
    <div class="row">
        <div class="col-12">
            <p>Top bidders get the remaining items after auction ends!</p>
            <div class="row justify-content-center">
                @if($allow_purchase == 'allowed')
                    <div class="col-md-6">
                        <label>
                            Minimum Bid
                            Php {{number_format($lowest_price, 2)}} 
                        </label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-default" id="btn-bid-price-minus"><span class="fas fa-minus"></span></button>
                            </div>
                            <input type="text" class="form-control text-center mask-money" id="bid-price" min="{{$lowest_price}}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default" id="btn-bid-price-plus"><span class="fas fa-plus"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Quantity</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-default" id="btn-quantity-minus-2"><span class="fas fa-minus"></span></button>
                            </div>
                            <input type="number" class="form-control text-center input-number-remove-arrow" id="quantity-2" min="0" max="{{$current_quantity}}">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-default" id="btn-quantity-plus-2"><span class="fas fa-plus"></span></button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 text-center">
                        <label>
                            Minimum Bid
                            Php {{number_format($lowest_price, 2)}} 
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
                    <h4 class="mb-0 text-white">Your Total: Php {{number_format($total_amount, 2)}}</h4>
                </div>
                <div class="py-2 px-3 mt-4">
                    <button class="btn btn-default w-100">CONFIRM BID</button>
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
            <p>Rankings | Total Bids: 16</p>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>100</td>
                        <td>2</td>
                        <td>Winning</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>90</td>
                        <td>3</td>
                        <td>Winning</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Jacob</td>
                        <td>80</td>
                        <td>4</td>
                        <td>Winning</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        $('.mask-money').mask("#,##0.00", {reverse: true});
        $('#quantity-2').val('{{$quantity}}');
        $('#bid-price').val('{{number_format($bid_price, 2)}}');
        
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

        var bid_price_interval = 100;
        quantityField('#bid-price', '#btn-bid-price-minus', '#btn-bid-price-plus', bid_price_interval);
        $(document).on('change', '#bid-price', function (){
            @this.call('set_bid_price', $('#bid-price').val())
        });
        $(document).on('change', '#bid-price', function (){
            @this.call('set_bid_price', $('#bid-price').val())
        });
        $(document).on('keyup', '#bid-price', function (){
            @this.call('set_bid_price', $('#bid-price').val())
        });
        $(document).on('click', '#btn-bid-price-minus', function () {
            @this.call('set_bid_price', $('#bid-price').val())
        });
        $(document).on('click', '#btn-bid-price-plus', function () {
            @this.call('set_bid_price', $('#bid-price').val())
        });
    });
</script>
@endpush