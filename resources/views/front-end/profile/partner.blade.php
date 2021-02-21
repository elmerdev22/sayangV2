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
                             <h5 class="card-title">{{Utility::get_partner_ratings($data['partner_id'])}}</h5>
                            <span>Products</span>
                        </div>
                    </figure>
                    <figure class="card bg">
                        <div class="p-3">
                             <h5 class="card-title">{{number_format(Utility::count_products($data['partner_id']) ,0)}}</h5>
                            <span>Ratings</span>
                        </div>
                    </figure>
                    <figure class="card bg">
                        <div class="p-3">
                             <h5 class="card-title">{{Utility::count_followers($data['partner_id'])}}</h5>
                            <span>Followers</span>
                        </div>
                    </figure>
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
                                @livewire('front-end.product.listing.search-filter', ['search' => null, 'partner_id' => $data['partner_id']])
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
    <!-- Main content -->
    {{-- <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-widget widget-user">
                        <div class="row">
                            <div class="col-12">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header text-white lazy" data-src="{{$data['cover_photo']}}"  style="background-repeat: no-repeat; background-size: cover;">
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle" style="width: 100px; height: 100px;" src="{{$data['store_photo']}}" alt="Card image cap">
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <div class="row mt-5 text-muted text-sm">
                                <div class="col-md-3">
                                    <!-- /.widget-user-image -->
                                    <h5>{{$data['store_name']}}</h5>
                                    @livewire('front-end.profile.partner.follow-button', ['partner_id' => $data['partner_id'] ])
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>
                                                <span class="fas fa-star"></span> 
                                                <span class="text-muted">Ratings :</span>
                                                <span class="text-warning">{{$data['ratings']}}</span>
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <label>
                                                <span class="fas fa-store"></span>
                                                <span class="text-muted">Products :</span>
                                                <span class="text-warning">{{number_format($data['products'], 0)}}</span> 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>
                                                <span class="fas fa-calendar"></span>
                                                <span class="text-muted">Joined :</span>
                                                {{date('F d, Y', strtotime($data['store_joined']))}}
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <label>
                                                <span class="fas fa-users"></span>
                                                <span class="text-muted">Followers :</span>
                                                <span class="text-warning">{{number_format($data['followers'], 0)}}</span> 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>
                                                <span class="fas fa-map-marker-alt"></span> 
                                                <span class="text-muted">Address :</span>
                                                <p>{{$data['store_address']}} <br> 
                                                    <span class="fas fa-hand-point-right"></span> 
                                                    <u>
                                                        <a href="{{$data['map_address_link']}}" target="_blank" class="text-underline">Get Directions</a>
                                                    </u>
                                                </p>
                                                <p>
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
                    <nav class="w-100">
                        <div class="nav nav-tabs text-center text-uppercase border-0 bg-light" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active col-6" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="true">Products</a>
                            <a class="nav-item nav-link col-6 " id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Ratings</a>
                        </div>
                    </nav>
                    
                    <div class="tab-content py-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
                            <div class="row">
                                <aside class="col-md-3">
                                    <div class="d-md-none d-lg-none d-xl-none">
                                        <button data-toggle="modal" data-target="#modal_aside_right" class="btn btn-warning w-100" type="button"> <span class="fas fa-filter"></span> Filter </button>
                                    </div>
                                    <div class="hidden-xs d-none d-md-block d-lg-block ">    
                                        <div class="card">
                                            @livewire('front-end.product.listing.search-filter', ['search' => null, 'partner_id' => $data['partner_id']])
                                        </div> <!-- card.// -->
                                    </div>
                                </aside> <!-- col.// -->

                                <main class="col-md-9">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card no-box-shadow" id="card-product_listing">
                                                <div class="card-body p-0">
                                                    @livewire('front-end.product.listing.listing', ['search' => null, 'partner_id' => $data['partner_id']])
                                                </div>
                                            </div> <!-- card.// -->
                                        </div>
                                    </div>
                                </main>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> 
                            <div class="card-footer bg-white card-comments">
                                @livewire('front-end.product.information.ratings', ['partner_id' => $data['partner_id'] ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section> --}}
    <!-- /.content -->
    
    <div id="modal_aside_right" class="modal fixed-right fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
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
