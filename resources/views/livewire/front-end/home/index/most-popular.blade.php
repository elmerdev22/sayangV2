<div>
    <hr>
    <div class="row">
        <div class="col-12 mb-3 bg-light pt-2">
            <h3 class="title" data-aos="fade-right">MOST POPULAR</h3>
        </div>
        @foreach($data as $row)
        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="card mb-4 product-card">
                <div class="w-100 text-center">
                    <div class="overflow-hidden position-relative">
                        <img class="card-img-top sayang-card-img-listing img-preloader" src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}" alt="Card image cap">
                        {{-- <span class="img-loader-span loader-span loader-quart"></span> --}}
                    </div>
                    <span class="ends-in">
                        <div class="countdown text-white">
                            <span class="fas fa-clock"></span>
                            <span class="countdown">{{$component->datetime_format($row->date_end)}}</span>
                        </div>
                    </span>
                    <div class="store-info p-1 mx-1 bg-transparent" style="margin-top: -30px; text-shadow: 0 0 3px black">
                        <div class="row">
                            <div class="col-9 text-white text-left text-ellipsis">
                                {{ucfirst($row->partner_name)}}
                            </div>
                            <div class="col-3 text-right">
                                <span class="fas fa-star text-warning"></span> 
                                <span class="text-white">4.5</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-info p-2">
                        <div class="row">
                            <div class="col-8 font-weight-bold text-left text-ellipsis">
                                {{ucfirst($row->product_name)}}
                            </div>
                            <div class="col-4 text-right">
                                {{number_format($row->quantity)}} left
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="col-md-6 m-0 p-0">
                            <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now'])}}">
                                <button class="btn btn-sm btn-dark item-btn">
                                    <span class="font-weight-bold">Buy Now</span><br>
                                    <small class="text-white item-info">
                                        PHP {{number_format($row->buy_now_price, 2)}} | 
                                        {{Utility::price_percentage($row->regular_price, $row->buy_now_price)['discount_percent']}}% off
                                    </small>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6 m-0 p-0">
                            <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'place_bid'])}}">
                                <button class="btn btn-sm btn-outline-warning text-dark item-btn">
                                    <span class="font-weight-bold">Place Bid</span><br>
                                    <small class="item-info">Bids: {{Utility::bid_details($row->id, 'count')}} | Top: {{Utility::bid_details($row->id, 'top')}}</small>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @if ($data->total() > 12)
            <div class="col-12 mb-3 text-center">
                <div class="row justify-content-center">
                    <div class="col-3">
                        <a href="{{route('front-end.home.all-most-popular')}}" class="btn btn-warning w-100">See More <span wire:loading wire:target="see_more" class="fas fa-spinner fa-spin"></span></a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <hr>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.hook('beforeDomUpdate', () => {
        $('.countdown').countdown("destroy");
    });
    window.livewire.hook('afterDomUpdate', () => {
        $('.countdown').countdown("start");
    });
    $('.countdown').countdown({
        end: function() {
            @this.call('render')
        }
    });
</script>
@endpush