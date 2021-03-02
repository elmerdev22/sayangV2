@extends('front-end.layout')
@section('title', ucfirst($product->name))
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/dist/css/glasscase.min.css')}}">
<link href="{{asset('template/assets/plugins/owl-carousel/css/owl.carousel.css')}}" rel="stylesheet" />
@endsection
@section('content')
<section class="section-content padding-y bg">
    <div class="container">
        <!-- ============================ PRODUCT DETAILS ================================= -->
        <div class="card">
            <div class="row no-gutters">
                <aside class="col-md-6">
                    <article class="gallery-wrap pt-2"> 
                        @livewire('front-end.product.information.photo', ['product_id' => $product->product_id])
                    </article> <!-- gallery-wrap .end// -->
                    @if($product->reminders)
                        <div class="row p-4">
                            <div class="col-12">
                                <h5>Few Reminders</h5>
                                <p>{!! $product->reminders !!}</p>
                            </div>
                        </div>
                    @endif
                </aside>
                <main class="col-md-6 border-left">
                    <article class="content-body">
                        @livewire('front-end.product.information.main-details', ['product_post_id' => $product->product_post_id, 'force_disabled' => $force_disabled])
                    <hr>
                    @if(!$force_disabled)
                        <div class="text-center">
                            <div class="col-12">
                                <h5 class="p-0 m-0">
                                    <small class="p-2 font-weight-bold">BUY NOW</small>
                                    <label class="switch">
                                        <input type="checkbox" id="purchase-type-switch" @if($trigger_place_bid) checked="true" @endif>
                                        <span class="slider round"></span>
                                    </label>
                                    <small class="p-2 font-weight-bold">PLACE BID</small>
                                </h5>
                            </div>
                            
                            <!-- Buy now -->
                            <div class="py-3" id="buy-now-section" @if($trigger_place_bid) style="display: none;" @endif>
                                @livewire('front-end.product.information.buy-now', ['product_post_id' => $product->product_post_id])
                            </div>
                            <!-- End of Buy now -->

                            <!-- Place Bid -->
                            <div class="py-3" id="place-bid-section" @if(!$trigger_place_bid) style="display: none;" @endif>
                                @livewire('front-end.product.information.place-bid', ['product_post_id' => $product->product_post_id])
                            </div>
                            <!-- End of Place Bid -->
                        </div>
                    @endif
                    </article> <!-- product-info-aside .// -->
                </main> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->
        <!-- ============================ PRODUCT DETAILS END .// ================================= -->
    </div> <!-- container .//  -->
    
</section>
<section class="section-content pb-3 bg">
    <div class="container">
        <!-- ============================ COMPONENT 1 ================================= -->
        <div class="row">
            <div class="col-md-12">
                <article class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <figure class="icontext mb-2">
                                <div class="icon">
                                    <img class="rounded-circle img-sm border" src="{{$store_photo}}">
                                </div>
                                <div class="text">
                                    <div class="mb-2">
                                        <strong> {{ucfirst($product->partner_name)}} </strong>
                                    </div>
                                    <a href="{{route('front-end.profile.partner.index', ['slug' => $product->partner_slug ])}}" class="btn btn-sm btn-outline-primary"><span class="fas fa-store"></span> View Shop</a>
                                    @php
                                        $store_hours = Utility::store_hours($product->partner_id);
                                    @endphp
                                    @if($store_hours['is_set'])
                                    
                                        <div class="text-muted">
                                            <small>{{$store_hours['open_time']}} - {{$store_hours['close_time']}}</small>
                                        </div>
                                        <div class="text-muted">
                                            <small>({{$store_hours['status']}})</small>
                                        </div>
                                    @endif
                                </div>
                            </figure>
                        </div>
                        <div class="col-md-8 pt-3">
                            <div class="row">
                                <div class="col-lg-4 col-6 p-1">
                                    <span class="font-weight-bold">Ratings</span>
                                    <span>{{Utility::get_partner_ratings($product->partner_id)}}</span>
                                </div>
                                <div class="col-lg-4 col-6 p-1">
                                    <span class="font-weight-bold">Products</span>
                                    <span>{{number_format(Utility::count_products($product->partner_id) ,0)}}</span>
                                </div>
                                <div class="col-lg-4 col-6 p-1">
                                    <span class="font-weight-bold">Followers</span>
                                    <span>{{Utility::count_followers($product->partner_id)}}</span>
                                </div>
                                <div class="col-lg-4 col-6 p-1">
                                    <span class="font-weight-bold">Joined</span>
                                    <span>{{date('F d, Y', strtotime($product->joined))}}</span>
                                </div>
                                <div class="col-lg-8 col-12 p-1">
                                    <span class="font-weight-bold">Address</span>
                                    <span>{{$product->address}}</span>
                                    <br>
                                    <span class="fas fa-hand-point-right text-muted"></span> 
                                    <u>
                                        <a href="{{$product->map_address_link}}" target="_blank" class="text-underline">Get Directions</a>
                                    </u>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </article>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
        <!-- ============================ COMPONENT 1 END .// ================================= -->
    </div> <!-- container .//  -->
</section>
<section class="section-content pb-3 bg">
    <div class="container">
        <!-- ============================ COMPONENT 1 ================================= -->
        <div class="row">
            <div class="col-md-12">
                <article class="card">
                    <div class="card-body">
                        <div class="row">
                            <aside class="col-md-6">
                                <h5>Dimensions</h5>
                                <dl class="row">
                                    <dt class="col-sm-3">Length</dt>
                                    <dd class="col-sm-9">{{$product->length ? $product->length : 'Not set'}}</dd>
                
                                    <dt class="col-sm-3">Width</dt>
                                    <dd class="col-sm-9">{{$product->width ? $product->width : 'Not set'}}</dd>
                
                                    <dt class="col-sm-3">Height</dt>
                                    <dd class="col-sm-9">{{$product->height ? $product->height : 'Not set'}}</dd>
                
                                </dl>
                            </aside>
                            
                            @if($product->paper_packaging)
                                <aside class="col-md-6">
                                    <h5>Packaging</h5>
                                    <ul class="list-check">
                                        <li>Paper packaging</li>
                                    </ul>
                                </aside>
                            @endif
                        </div> <!-- row.// -->
                        @if ($product->about_product)
                            <hr>
                            <p>
                                {!! $product->about_product !!}
                            </p>
                        @endif
                    </div>
                </article>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
        <!-- ============================ COMPONENT 1 END .// ================================= -->
    </div> <!-- container .//  -->
</section>
<section class="section-content pb-3 bg">
    <div class="container">
        @livewire('front-end.product.information.ratings', ['partner_id' => $product->partner_id])
    </div>
</section>

<!-- More Like This -->
    @livewire('front-end.product.information.more-like-this', ['product_category_id' => $product->category_id, 'product_post_id' => $product->product_post_id])
<!-- More Like This .//end -->

<!-- Modal -->
<div class="modal fade" id="my-all-bids" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">My Bids in this Product</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (Auth::check() && Auth::user()->type == 'user')
                    @livewire('front-end.product.information.all-my-bids',  ['product_post_id' => $product->product_post_id])
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('template/assets/dist/js/glasscase.min.js')}}"></script>
<script src="{{asset('template/assets/plugins/owl-carousel/js/owl.carousel.js')}}"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#glasscase').glassCase({ 'thumbsPosition': 'bottom'});
        $(document).on('change', '#purchase-type-switch', function () {
            if($(this).is(':checked')){
                place_bid = true;
            }else{
                place_bid = false;
            }

            if(place_bid){
                $(document).find('#place-bid-section').show();
                $(document).find('#buy-now-section').hide();
            }else{
                $(document).find('#place-bid-section').hide();
                $(document).find('#buy-now-section').show();
            }
        });
        $('.owl-carousel').owlCarousel({
            margin:10,
            responsiveClass:true,
            loop: false,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                1000:{
                    items:4,
                }
            }
        })
    });
</script>
@endsection
