<div>
    
    <header class="border-bottom mb-4 pb-2">
        <div class="form-inline">
            <span class="mr-md-auto my-1">{{number_format($total_items,0)}} Items found </span>
            
            <div class="input-group my-1 mr-2">
                <input type="search" class="form-control" id="search" placeholder="Search">
                <div class="input-group-prepend">
                    <button class="btn btn-primary rounded-right" onclick="search()">
                        <span class="fas fa-search"></span>
                    </button>
                </div>
            </div>
            <select class="form-control mr-2 my-1 " id="sort-by" wire:model="sort_by">
                <option value="">Sort by</option>
                <option value="lowest_price">Lowest Price</option>
                <option value="highest_price">Highest Price</option>
                <option value="ending_soon">Ending Soon</option>
                <option value="recently_added">Recently Added</option>
            </select>
            <div class="btn-group my-1">
                <a href="javascript:void(0);" class="btn btn-outline-secondary @if($view_by == 'grid_view') active @endif" @if($view_by != 'grid_view') onclick="view_by('grid_view')" @endif>
                    <i class="fa fa-th"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-outline-secondary @if($view_by == 'list_view') active @endif" @if($view_by != 'list_view') onclick="view_by('list_view')" @endif> 
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </header><!-- sect-heading -->
    
    <div class="row">
        @foreach($data as $row)
            @if($view_by == 'grid_view')
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-product-grid" >
                        <div class="img-wrap"> 
                            <img src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}">
                            <span class="topbar">
                                <span class="badge badge-primary p-2" style="position: static">
                                    <span class="fa fa-clock"></span>
                                    <span class="countdown">{{$component->datetime_format($row->date_end)}}</span>
                                </span>
                                <span class="badge badge-danger p-2 float-right" style="position: static">
                                    {{Utility::price_percentage($row->regular_price, $row->buy_now_price)['discount_percent']}}% OFF
                                </span>
                            </span>
                            <a class="btn-overlay" href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now'])}}">
                                <i class="fa fa-search-plus"></i> Quick view
                            </a>
                        </div>
                        <figcaption class="info-wrap">
                            <div class="mt-2">
                                <div class="row">
                                    <div class="col-7 text-truncate"><var class="title">{{ucfirst($row->product_name)}}</var></div>
                                    <div class="col-5"><span class="float-right text-ellipsis">{{number_format($row->quantity, 0)}} LEFT</span></div>
                                </div>
                            </div> <!-- action-wrap.end -->
                            <div class="mt-2">
                                <div></div>
                                <var class="price">{{Utility::currency_code()}}{{number_format($row->buy_now_price, 2)}} <small><del>{{Utility::currency_code()}}{{number_format($row->regular_price, 2)}}</small></del></var> <!-- price-wrap.// -->
                                <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now'])}}" class="btn btn-sm btn-primary float-right" style="width: 70px;">Buy now</a>
                            </div> <!-- action-wrap.end -->
                            <div class="mt-2">
                                @if(Utility::bid_details($row->id, 'top') != 'None')
                                    <var class="price">{{Utility::currency_code()}}{{Utility::bid_details($row->id, 'top')}} 
                                @endif
                                <small>Bids: {{Utility::bid_details($row->id, 'count')}}</small></var> <!-- price-wrap.// -->
                                <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'place_bid'])}}" class="btn btn-sm btn-light float-right" style="width: 70px;">Bid now</a>
                            </div> <!-- action-wrap.end -->
                            <div class="mt-3">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <span class="text-primary">
                                            <i class="fa fa-seedling"></i>
                                        </span>
                                        <small>0.5</small>
                                    </div>
                                    <div class="col-4">
                                        <span class="text-info">
                                            <i class="fa fa-tint"></i>
                                        </span>
                                        <small>2.3</small>
                                    </div>
                                    <div class="col-4">
                                        <span class="text-warning">
                                            <i class="fa fa-bolt"></i>
                                        </span>
                                        <small>4</small>
                                    </div>
                                </div>
                            </div> <!-- action-wrap.end -->
                        </figcaption>
                    </div>
                </div> <!-- col.// -->
            @else
                <div class="col-12">
                    <article class="card card-product-list">
                        <div class="row no-gutters">
                            <aside class="col-md-3">
                                <a href="#" class="img-wrap">
                                    <span class="badge badge-danger p-2" >
                                        {{Utility::price_percentage($row->regular_price, $row->buy_now_price)['discount_percent']}}% OFF
                                    </span>
                                    <img src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}">
                                </a>
                            </aside> <!-- col.// -->
                            <div class="col-md-6">
                                <div class="info-main">
                                    <a href="#" class="h5 title text-truncate">{{ucfirst($row->product_name)}}</a>
                                    <div>
                                        <span class="badge badge-primary p-2" style="position: static">
                                            <span class="fa fa-clock"></span>
                                            <span class="countdown">{{$component->datetime_format($row->date_end)}}</span>
                                        </span>
                                    </div>
                                    <p class="py-3"> Take it as demo specs, ipsum dolor sit amet, consectetuer adipiscing elit, Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Ut wisi enim ad minim veniam </p>
                                    <div class="row ">
                                        <div class="col-4">
                                            <span class="text-primary">
                                                <i class="fa fa-seedling"></i>
                                            </span>
                                            <small>0.5</small>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-info">
                                                <i class="fa fa-tint"></i>
                                            </span>
                                            <small>2.3</small>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-warning">
                                                <i class="fa fa-bolt"></i>
                                            </span>
                                            <small>4</small>
                                        </div>
                                    </div>
                                </div> <!-- info-main.// -->
                            </div> <!-- col.// -->
                            <aside class="col-sm-3">
                                <div class="info-aside">
                                    <br>
                                    <p>
                                        <div class="price-wrap">
                                            <span class="price h5">{{Utility::currency_code()}}{{number_format($row->buy_now_price, 2)}}</span>	
                                            <del class="price-old"> {{Utility::currency_code()}}{{number_format($row->regular_price, 2)}}</del>
                                        </div>
                                        <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now'])}}" class="btn btn-primary btn-block"> Buy now </a>
                                    </p>
                                    <br>
                                    <p>
                                        <div class="price-wrap">
                                            @if(Utility::bid_details($row->id, 'top') != 'None')
                                                <span class="price h5">{{Utility::currency_code()}}{{Utility::bid_details($row->id, 'top')}}</span>
                                            @endif
                                            <small class="text-muted ml-1">Bids: {{Utility::bid_details($row->id, 'count')}}</small>
                                        </div> 
                                        <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'place_bid'])}}" class="btn btn-light btn-block"> Bid now </a>
                                    </p>
                                </div> <!-- info-aside.// -->
                            </aside> <!-- col.// -->
                        </div> <!-- row.// -->
                    </article>
                </div>
            @endif
        @endforeach
    </div> <!-- row.// -->
{{-- 
    <div class="row">
        @forelse($data as $row)
            @if($view_by == 'grid_view')
                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    
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
                                        @if(Utility::get_partner_ratings($row->partner_id) != 'No Ratings')
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
            @else
            <div class="col-12">
                <div class="card mb-4 product-card">
                    <div class="row">
                        <div class="col-5 col-md-4 overflow-hidden product-card-img-list">
                            <div class="overflow-hidden position-relative">
                                <img class="card-img-top sayang-card-img-listing img-preloader" src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}" alt="Card image cap">
                            </div>
                        </div>
                        <div class="col-7 col-md-8 overflow-hidden">
                            <div class="product-card-list-information">
                                <div class="mb-3 product-card-countdown">
                                    <span class="ends-in rounded" style="position: relative !important;">
                                        <div class="countdown text-white">
                                            <span class="fas fa-clock"></span>
                                            <span class="countdown">{{$component->datetime_format($row->date_end)}}</span>
                                        </div>
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <div class="store-info bg-transparent">
                                        <div class="text-left text-sm text-ellipsis">
                                            {{ucfirst($row->partner_name)}} 
                                            @if(Utility::get_partner_ratings($row->partner_id) != 'No Ratings')
                                                <small class="fas fa-star text-warning"></small> 
                                                <small>{{Utility::get_partner_ratings($row->partner_id)}}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="product-info">
                                        <div class="text-left text-ellipsis">
                                            {{ucfirst($row->product_name)}} <small>({{number_format($row->quantity)}} left)</small>
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
                <h5 class="text-center">No Item Found</h5>
            </div>
        @endforelse    
    </div> --}}

    <div class="row justify-content-center">
        @if ($data->total() > 12 && $data->total() > $limit)
            <div class="col-12 mb-3 text-center">
                <button wire:click="load_more" class="btn btn-warning" style="width: 200px;">Load More <span class="" wire:loading.class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span></button>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        $('#search').val('{{$search}}')
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
    });
    
    $('.countdown').countdown({
        end: function() {
            @this.call('render')
        }
    });

    $("#search").keyup(function(event) {
        if (event.keyCode === 13) {
            search();
        }
    });
    
    function search(){
        var search = $('#search').val();
        var url    = '?search='+search;
        history.pushState(null, null, url);
        @this.set('search', search)
    }
</script>
@endpush