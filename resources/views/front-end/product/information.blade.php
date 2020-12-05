@extends('front-end.layout')
@section('title', ucfirst($product->name))
@section('css')
    <!-- Glasscase css-->
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/glasscase.min.css')}}">
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
                                            <span class="p-2">BUY NOW</span>
                                            <label class="switch">
                                                <input type="checkbox" id="purchase-type-switch" @if($trigger_place_bid) checked="true" @endif>
                                                <span class="slider round"></span>
                                            </label>
                                            <span class="p-2">PLACE BID</span>
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
                        <div class="card widget-user-2 bg-white">
                            <div class="row ">
                                <div class="col-md-4">
                                    <div class="p-4">

                                        <div class="widget-user-header">
                                            <div class="widget-user-image">
                                              <img class="img-circle elevation-1 mr-3" src="{{$store_photo}}" alt="User Avatar">
                                            </div>
                                            <!-- /.widget-user-image -->
                                            <h5>Elmer shop</h5>
                                            <a href="{{route('front-end.profile.partner.index', ['slug' => $product->partner_slug ])}}" class="btn btn-outline-warning text-dark btn-sm">
                                                <span class="fas fa-store"></span> View Shop
                                            </a>
                                          </div>

                                        {{-- @livewire('front-end.profile.partner.follow-button', ['partner_id' => $product->partner_id ]) --}}
                                    </div>
                                </div>
                                <div class="col-md-4 pt-3">
                                    <div class="row widget-user-header">
                                        <div class="col-12">
                                            <label>
                                                <span class="fas fa-star"></span> 
                                                <span class="text-muted">Ratings :</span>
                                                <span class="text-warning">4.7</span>
                                                <small>(344 rating)</small>
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <label>
                                                <span class="fas fa-store"></span>
                                                <span class="text-muted">Products :</span>
                                                <span class="text-warning">{{number_format(Utility::count_products($product->partner_id) ,0)}}</span> 
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
                                <div class="col-md-4 pt-3">
                                    <div class="row widget-user-header">
                                        <div class="col-12">
                                            <label>
                                                <span class="fas fa-map-marker-alt"></span> 
                                                <span class="text-muted">Address :</span>
                                                {{$product->address}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Partner Ratings</a>
                                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">About Product</a>
                                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Other details</a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                                <div class="card-footer bg-white card-comments">
                                    @livewire('front-end.product.information.ratings')
                                </div>
                            </div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
                                <div class="card-footer bg-white card-comments">
                                    @livewire('front-end.product.information.about')
                                </div>
                            </div>
                            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> 
                                <div class="card-footer bg-white card-comments">
                                    @livewire('front-end.product.information.other-details')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h2 class="title" data-aos="fade-right">MORE LIKE THIS</h2>
            </div>
        </div>
        @livewire('front-end.product.information.more-like-this')
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
</script>
@endsection
