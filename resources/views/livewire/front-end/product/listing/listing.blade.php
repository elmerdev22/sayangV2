<div>
    <header class="border-bottom border-top mb-4 py-3">
        <div class="form-inline">
            <span class="mr-md-auto my-1" id="total-item_found">{{number_format($total_items,0)}} Items found </span>
            <select class="mr-2 form-control my-1" id="sort-by" wire:model="sort_by">
                <option value="latest_items">Latest items</option>
                <option value="cheapest">Cheapest</option>
                <!-- <option value="most_popular">Most Popular</option> -->
                <!-- <option value="trending">Trending</option> -->
            </select>
            <div class="btn-group my-1">
                <a href="#" class="btn btn-outline-warning @if($view_by == 'grid_view') active @endif" @if($view_by != 'grid_view') onclick="view_by('grid_view')" @endif>
                    <i class="fa fa-th"></i>
                </a>
                <a href="#" class="btn btn-outline-warning @if($view_by == 'list_view') active @endif" @if($view_by != 'list_view') onclick="view_by('list_view')" @endif> 
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </header><!-- sect-heading -->

    <div class="row">
        @forelse($data as $row)
            @if($view_by == 'grid_view')
                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    
                    <div class="card mb-4 product-card">
                        <div class="w-100 text-center">
                            <div class="overflow-hidden position-relative">
                                <img class="card-img-top sayang-card-img-listing img-preloader" data-src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}">
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
                                        <small class="fas fa-star text-warning"></small> 
                                        <small class="text-white">{{Utility::get_partner_ratings($row->partner_id)}}</small>
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
            @else
            <div class="col-12">
                <div class="card mb-4 product-card">
                    <div class="row">
                        <div class="col-sm-4 overflow-hidden product-card-img-list">
                            <div class="overflow-hidden position-relative">
                                <img class="card-img-top sayang-card-img-listing img-preloader" data-src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}" alt="Card image cap">
                            </div>
                        </div>
                        <div class="col-sm-8 overflow-hidden">
                            <div class="product-card-list-information">
                                <div class="mb-3 product-card-countdown">
                                    <span class="ends-in" style="position: relative !important;">
                                        <div class="countdown text-white">
                                            <span class="fas fa-clock"></span>
                                            <span class="countdown">{{$component->datetime_format($row->date_end)}}</span>
                                        </div>
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <div class="store-info bg-transparent">
                                        <div class="text-left text-ellipsis">
                                            {{ucfirst($row->partner_name)}} 
                                            <small class="fas fa-star text-warning"></small> 
                                            <small class="text-dark">{{Utility::get_partner_ratings($row->partner_id)}}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="product-info">
                                        <div class="font-weight-bold text-left text-ellipsis">
                                            {{ucfirst($row->product_name)}} ({{number_format($row->quantity)}} left)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row product-card-btn-purchase">
                                <div class="col-6 product-card-buy-now col-sm-5">
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
                                <div class="col-6 product-card-place-bid col-sm-5">
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
            </div>
            @endif
        @empty
            <div class="col-12 text-center">
                <img style="width: 30%" src="{{asset('images/default-photo/no-search.jpg')}}">
                <h4 class="text-center">No Item Found</h4>
            </div>
        @endforelse    
    </div>

    <div class="row text-center">
        <div class="col-12">
            {{$data->render()}}
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
 
    });

    function view_by(type){
        @this.call('view_by', type)
    }

    window.livewire.hook('beforeDomUpdate', () => {
        $('.countdown').countdown("destroy");
        $.LoadingOverlay("show");
    });
    window.livewire.hook('afterDomUpdate', () => {
        $.LoadingOverlay("hide");
        $('.countdown').countdown("start");
        $(".sayang-card-img-listing").lazyload({effect : "fadeIn"});
    });
    $('.countdown').countdown({
        end: function() {
            @this.call('render')
        }
    });

</script>
@endpush