@extends('front-end.layout')
@section('title','Seller Profile')

@section('content')
<section class="section-name bg padding-y" style="background:linear-gradient(rgba(255,255,255,.3), rgba(255,255,255,.3)), url('{{$data['cover_photo']}}') no-repeat center center /cover;  background-attachment: fixed;">
    <div class="container">
        <div class="icontext mb-3">
            <img class="icon icon-lg rounded-circle" src="{{$data['store_photo']}}">
            <div class="text text-white">
                <h5 class="title pb-2" style="text-shadow: 2px 2px 5px #000000;">{{$data['store_name']}}</h5>
                @livewire('front-end.profile.partner.follow-button', ['partner_id' => $data['partner_id'] ])
            </div>
        </div>
    </div><!-- container // -->
</section>

<section class="section-content pt-4">
    <div class="container">
        <!-- ============================ COMPONENT 1 ================================= -->
        <div class="row">
            <div class="col-md-12">
                <article class="card-group">
                    <figure class="card bg">
                        <div class="p-3">
                             <h6 class="card-title">{{Utility::get_partner_ratings($data['partner_id'])}}</h6>
                            <span>Ratings</span>
                        </div>
                    </figure>
                    <figure class="card bg">
                        <div class="p-3">
                             <h6 class="card-title">{{number_format(Utility::count_products($data['partner_id']) ,0)}}</h6>
                            <span>Products</span>
                        </div>
                    </figure>
                    <figure class="card bg">
                        <div class="p-3">
                             <h6 class="card-title">{{Utility::count_followers($data['partner_id'])}}</h6>
                            <span>Followers</span>
                        </div>
                    </figure>
                    @php
                        $store_hours = Utility::store_hours($data['partner_id']);
                    @endphp
                    @if($store_hours['is_set'])
                        <figure class="card bg">
                            <div class="p-3">
                                <h6 class="card-title">
                                    {{$store_hours['open_time']}} - {{$store_hours['close_time']}}
                                </h6>
                                <span>Store Hours <small>({{$store_hours['status']}})</small></span>
                            </div>
                        </figure>
                    @endif
                    <figure class="card bg">
                        <div class="p-3">
                             <h6 class="card-title">{{date('F d, Y', strtotime($data['store_joined']))}}</h6>
                            <span>Joined</span>
                        </div>
                    </figure>
                    <figure class="card bg">
                        <div class="p-3">
                             <h6 class="card-title">
                                <span class="fas fa-hand-point-right"></span> 
                                <u>
                                    <a href="{{$data['map_address_link']}}" target="_blank" class="text-underline">Get Directions</a>
                                </u>
                            </h6>
                            <span>Address</span>
                        </div>
                    </figure>
                </article>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
        <!-- ============================ COMPONENT 1 END .// ================================= -->
    </div> <!-- container .//  -->
</section>
<section class="section-content padding-y-sm">
    <div class="container">
        <!-- ============================ COMPONENT 1 ================================= -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item w-50 text-center bg">
                        <a class="nav-link active" id="products-tab" data-toggle="pill" href="#products" role="tab" aria-controls="products" aria-selected="true">
                            Products
                        </a>
                    </li>
                    <li class="nav-item w-50 text-center bg">
                        <a class="nav-link" id="ratings-tab" data-toggle="pill" href="#ratings" role="tab" aria-controls="ratings" aria-selected="false">
                            Ratings
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
                        <div class="row">
                            <aside class="col-md-3">
                                <div class="d-md-none d-lg-none d-xl-none">
                                    <button data-toggle="modal" data-target="#modal_aside_right" class="btn btn-primary btn-block mb-2" type="button"> Filter </button>
                                </div>
                                <div class="hidden-xs d-none d-md-block d-lg-block ">    
                                    <div class="card">
                                        @livewire('front-end.product.listing.search-filter', ['search' => null, 'partner_id' => $data['partner_id']])
                                    </div> <!-- card.// -->
                                </div>
                            </aside> <!-- col.// -->
                            <main class="col-md-9">
                                @livewire('front-end.product.listing.listing', ['search' => null, 'partner_id' => $data['partner_id']])
                            </main> <!-- col.// -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ratings" role="tabpanel" aria-labelledby="ratings-tab">
                        @livewire('front-end.product.information.ratings', ['partner_id' => $data['partner_id'] ])
                    </div>
                </div>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
        <!-- ============================ COMPONENT 1 END .// ================================= -->
    </div> <!-- container .//  -->
</section>
<div id="modal_aside_right" class="modal fixed-right fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">{{$data['store_name']}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 m-0">
                @livewire('front-end.product.listing.search-filter', ['search' => null, 'partner_id' => $data['partner_id']])
            </div>
        </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->
@endsection
@section('js')
<script src="{{asset('template/assets/dist/js/loadingoverlay.min.js')}}"></script>
<script>
    $.LoadingOverlaySetup({
        image: "{{Utility::img_source('loading')}}",
        imageAnimation: false,
    });
</script>
@endsection
