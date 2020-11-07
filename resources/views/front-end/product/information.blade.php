@extends('front-end.layout')
@section('title', ucfirst($product->name))
@section('content')
@section('css')
    <!-- Glasscase css-->
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/glasscase.min.css')}}">
@endsection
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
                <div class="row mt-4">
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
@endsection
@section('js')
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
