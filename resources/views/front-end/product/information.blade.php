@extends('front-end.layout')
@section('title', ucfirst($product->name))
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/dist/css/glasscase.min.css')}}">

@endsection
@section('content')
<section class="section-content padding-y bg">
    <div class="container">
        <!-- ============================ PRODUCT DETAILS ================================= -->
        <div class="card">
            <div class="row no-gutters">
                <aside class="col-md-6">
                    <article class="gallery-wrap pt-2"> 
                        <div class="col-12">
                            <ul id="glasscase" class="gc-start">
                                @for ($i = 0; $i < 10; $i++)
                                <li><img src="https://cf.shopee.ph/file/9c351aa6daa7481e95dad5cca896e15c" alt="Photo"/></li>
                                <li><img src="https://cf.shopee.ph/file/9c351aa6daa7481e95dad5cca896e15c" alt="Photo"/></li>
                                @endfor
                            </ul>
                        </div>
                    </article> <!-- gallery-wrap .end// -->
                    <div class="row p-4">
                        <div class="col-12">
                            <h5>Few Reminders</h5>
                            <p>Virgil Abloh’s Off-White is a streetwear-inspired collection that continues to break away from the conventions of mainstream fashion. Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p>
                        </div>
                    </div>
                </aside>
                <main class="col-md-6 border-left">
                    <article class="content-body">
                        @livewire('front-end.product.information.main-details', ['product_post_id' => $product->product_post_id, 'force_disabled' => $force_disabled])
                    
                    <hr>
                    {{-- @if(!$force_disabled) --}}
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
                    {{-- @endif --}}
                    </article> <!-- product-info-aside .// -->
                </main> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->
        <!-- ============================ PRODUCT DETAILS END .// ================================= -->
    </div> <!-- container .//  -->
    
</section>
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
    });
</script>
@endsection
