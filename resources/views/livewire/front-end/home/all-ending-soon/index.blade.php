<div>
    <div class="row">
        <div class="col-12 mb-3 shadow-sm pt-2 text-center">
            <h4 class="title p-2">ALL ENDING SOON</h4>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 mb-3 pt-2">
            <div class="row">
                @foreach($data as $row)
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="card mb-4 product-card">
                        <div class="w-100 text-center">
                            <div class="overflow-hidden position-relative">
                                <img class="card-img-top sayang-card-img-listing img-preloader" src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}">
                            </div>
                            <span class="ends-in rounded-left">
                                <div class="countdown text-white">
                                    <span class="fas fa-clock"></span>
                                    <span class="countdown">{{$component->datetime_format($row->date_end)}}</span>
                                </div>
                            </span>
                            <div class="store-info p-1 mx-1 bg-transparent" style="margin-top: -30px; text-shadow: 0 0 1px black">
                                <div class="row">
                                    <div class="col-7 text-white text-left text-ellipsis">
                                        <small>{{ucfirst($row->partner_name)}}</small>
                                    </div>
                                    <div class="col-5 text-right">
                                        @if(Utility::get_partner_ratings($row->partner_id))
                                            <small class="fas fa-star text-warning"></small> 
                                            <small class="text-white">{{Utility::get_partner_ratings($row->partner_id)}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="product-info p-2">
                                <div class="row">
                                    <div class="col-7 font-weight-bold text-left text-ellipsis">
                                        {{ucfirst($row->product_name)}}
                                    </div>
                                    <div class="col-5 text-right text-ellipsis">
                                        {{number_format($row->quantity)}} left
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="col-6 m-0 p-0">
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
                                <div class="col-6 m-0 p-0">
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
                <div class="col-12 mb-3 text-center">
                    <div class="row justify-content-center">
                        @if ($data->total() > 12 && $data->total() > $limit)
                            <div class="col-12 mb-3 text-center">
                                <button wire:click="load_more" class="btn btn-warning" style="width: 200px;">Load More <span class="" wire:loading.class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.hook('beforeDomUpdate', () => {
        $('.countdown').countdown("destroy");
        $.LoadingOverlay("show");
    });
    window.livewire.hook('afterDomUpdate', () => {
        $('.countdown').countdown("start");
        $.LoadingOverlay("hide");
    });
    $('.countdown').countdown({
        end: function() {
            @this.call('render')
        }
    });
</script>
@endpush