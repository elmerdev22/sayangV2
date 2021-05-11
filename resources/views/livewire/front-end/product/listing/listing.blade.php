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
        @forelse($data as $row)
            @if($view_by == 'grid_view')
                <div class="col-12 col-md-6 col-lg-4">
                    @component('front-end.components.product.grid')
                        @slot('featured', $component->product_featured_photo($row->product_id, $row->partner_id))
                        @slot('countdown', $component->datetime_format($row->date_end))
                        @slot('discount_percentage', Utility::price_percentage($row->regular_price, $row->buy_now_price)['discount_percent'])

                        @slot('buy_now', route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now']))
                        @slot('bid_now', route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'place_bid']))

                        @slot('product_name', ucfirst($row->product_name))
                        @slot('quantity_left', number_format($row->quantity, 0))
                        @slot('buy_now_price', Utility::currency_code().''.number_format($row->buy_now_price, 2))
                        @slot('regular_price', Utility::currency_code().''.number_format($row->regular_price, 2))
                        @slot('bid_details_top', Utility::bid_details($row->id, 'top'))
                        @slot('bid_details_top_price', Utility::currency_code().''.Utility::bid_details($row->id, 'top'))
                        @slot('bid_details_count', Utility::bid_details($row->id, 'count'))

                        @slot('elements_trees', Utility::elements_multiplier($row->id)['trees'])
                        @slot('elements_water', Utility::elements_multiplier($row->id)['water'])
                        @slot('elements_energy', Utility::elements_multiplier($row->id)['energy'])
                    @endcomponent
                </div> <!-- col.// -->
            @else
                <div class="col-12">
                    <article class="card card-product-list">
                        <div class="row no-gutters">
                            <aside class="col-md-3">
                                <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now'])}}" class="img-wrap">
                                    <span class="badge badge-danger p-2" >
                                        {{Utility::price_percentage($row->regular_price, $row->buy_now_price)['discount_percent']}}% OFF
                                    </span>
                                    <img src="{{$component->product_featured_photo($row->product_id, $row->partner_id)}}">
                                </a>
                            </aside> <!-- col.// -->
                            <div class="col-md-6">
                                <div class="info-main">
                                    <a href="{{route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now'])}}" class="h5 title text-truncate">{{ucfirst($row->product_name)}}</a>
                                    <div>
                                        <span class="badge badge-primary p-2" style="position: static">
                                            <span class="fa fa-clock"></span>
                                            <span class="countdown">{{$component->datetime_format($row->date_end)}}</span>
                                        </span>
                                    </div>
                                    <p class="py-3"> 
                                        {{ucfirst(Str::limit($row->product_description, 160, ' ...'))}}
                                    </p>
                                    <div class="row ">
                                        <div class="col-4">
                                            <span class="text-primary">
                                                <i class="fa fa-seedling"></i>
                                            </span>
                                            <small>{{Utility::elements_multiplier($row->id)['trees']}}</small>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-info">
                                                <i class="fa fa-tint"></i>
                                            </span>
                                            <small>{{Utility::elements_multiplier($row->id)['water']}}</small>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-warning">
                                                <i class="fa fa-bolt"></i>
                                            </span>
                                            <small>{{Utility::elements_multiplier($row->id)['energy']}}</small>
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
        @empty
            <div class="col-12 text-center">
                <img style="width: 30%" src="{{asset('images/default-photo/no-search.jpg')}}">
                <h5 class="text-center font-weight-light">No Item(s) Found</h5>
            </div>
        @endforelse   
    </div> <!-- row.// -->
    
    <div class="row justify-content-center">
        @if ($data->total() > 6 && $data->total() > $limit)
            <div class="col-12 mb-3 text-center">
                <button wire:click="load_more" class="btn btn-primary" style="width: 200px;">Load More <span class="" wire:loading.class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span></button>
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
        // $.LoadingOverlay("show");
    });
    
    window.livewire.hook('afterDomUpdate', () => {
        // $.LoadingOverlay("hide");
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