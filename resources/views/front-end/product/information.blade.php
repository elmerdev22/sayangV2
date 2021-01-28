@extends('front-end.layout')
@section('title', ucfirst($product->name))
@section('css')
    <!-- Glasscase css-->
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/glasscase.min.css')}}">
    <link href="{{asset('template/assets/plugins/owl-carousel/css/owl.carousel.css')}}" rel="stylesheet" />
@endsection
@section('content')
<section class="content pb-5">
    <div class="container my-5">
        <!-- Default box -->
        <div class="card border-0 shadow-none">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-12 col-md-7">
                        @livewire('front-end.product.information.photo', ['product_id' => $product->product_id])
                    </div>
                    <div class="col-12 col-md-5">
                        @livewire('front-end.product.information.main-details', ['product_post_id' => $product->product_post_id, 'force_disabled' => $force_disabled])
                        <hr>
                        @if(!$force_disabled)
                            <div class="card text-center sticky">

                                <div class="card-header">
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
                                </div>
                                
                                <!-- Buy now -->
                                <div class="p-3" id="buy-now-section" @if($trigger_place_bid) style="display: none;" @endif>
                                    @livewire('front-end.product.information.buy-now', ['product_post_id' => $product->product_post_id])
                                </div>
                                <!-- End of Buy now -->

                                <!-- Place Bid -->
                                <div class="p-3" id="place-bid-section" @if(!$trigger_place_bid) style="display: none;" @endif>
                                    @livewire('front-end.product.information.place-bid', ['product_post_id' => $product->product_post_id])
                                </div>
                                <!-- End of Place Bid -->
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card widget-user-2">
                            
                            <div class="card-header bg-light">
                                <h4 class="card-title">
                                    About Seller
                                </h4>
                            </div>
                            <div class="card-body">

                                <div class="row text-muted text-sm">
                                    <div class="col-md-3">
                                        <div class="widget-user-header">
                                            <div class="widget-user-image">
                                                <img class="img-circle img-responsive elevation-1 mr-3 lazy" src="{{$store_photo}}" alt="Store photo" style="width: 50px; height: 50px;">
                                            </div>
                                            <!-- /.widget-user-image -->
                                            <h5>{{ucfirst($product->partner_name)}}</h5>
                                            <a href="{{route('front-end.profile.partner.index', ['slug' => $product->partner_slug ])}}" class="btn btn-outline-warning text-dark btn-sm">
                                                <span class="fas fa-store"></span> View Shop
                                            </a>
                                        </div>
                                            {{-- @livewire('front-end.profile.partner.follow-button', ['partner_id' => $product->partner_id ]) --}}
                                    </div>
                                    <div class="col-md-2">
                                        <div class="row widget-user-header ">
                                            <div class="col-12">
                                                <label>
                                                    <span class="fas fa-star"></span> 
                                                    <span class="text-muted">Ratings :</span>
                                                    <span class="text-warning">{{Utility::get_partner_ratings($product->partner_id)}}</span>
                                                </label>
                                            </div>
                                            <div class="col-12">
                                                <label>
                                                    <span class="fas fa-store"></span>
                                                    <span class="text-muted">Products :</span>
                                                    <span class="text-warning">{{number_format(Utility::count_products($product->partner_id) ,0)}}</span> 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row widget-user-header">
                                            <div class="col-12">
                                                <label>
                                                    <span class="fas fa-users"></span>
                                                    <span class="text-muted">Joined :</span>
                                                    <span class="">{{date('F d, Y', strtotime($product->joined))}}</span> 
                                                </label>
                                            </div>
                                            <div class="col-12">
                                                <label>
                                                    <span class="fas fa-users"></span>
                                                    <span class="text-muted">Followers :</span>
                                                    <span class="text-warning">{{Utility::count_followers($product->partner_id)}}</span> 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row widget-user-header">
                                            <div class="col-12">
                                                <label>
                                                    <span class="fas fa-map-marker-alt"></span> 
                                                    <span class="text-muted">Address :</span>
                                                    <p>{{$product->address}} <br> 
                                                        <span class="fas fa-hand-point-right"></span> 
                                                        <u>
                                                            <a href="{{$product->map_address_link}}" target="_blank" class="text-underline">Get Directions</a>
                                                        </u>
                                                    </p>
                                                    
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h4 class="card-title">
                                    About Products
                                </h4>
                            </div>
                            <div class="card-body">
                                {!! $product->about_product != null ? $product->about_product : 'No more about product.' !!}
                                {{-- @livewire('front-end.product.information.about') --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h4 class="card-title">
                                    Other Details
                                </h4>
                            </div>
                            <div class="card-body">
                                {!! $product->other_details != null ? $product->other_details : 'No Other Details.' !!}
                                {{-- @livewire('front-end.product.information.other-details') --}}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h4 class="card-title">
                                    Seller Ratings
                                </h4>
                            </div>
                            <div class="card-body">
                                @livewire('front-end.product.information.ratings', ['partner_id' => $product->partner_id])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="container">
        @livewire('front-end.product.information.more-like-this', ['product_category_id' => $product->category_id])
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="my-all-bids" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">My Bids in this Product</h5>
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
<!-- Go to www.addthis.com/dashboard to customize your tools -->
{{-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5fb151db1c817c52"></script> --}}

<!-- Glasscase -->
<script src="{{asset('template/assets/dist/js/glasscase.min.js')}}"></script>
<script src="{{asset('template/assets/plugins/money-mask/jquery.maskMoney.min.js')}}"></script>
<script src="{{asset('template/assets/plugins/owl-carousel/js/owl.carousel.js')}}"></script>
<script type="text/javascript">
    $(document).ready( function () {
        //If your <ul> has the id "glasscase"
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
    });
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        nav:false,
        loop: false,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:2,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    })
</script>
@endsection
