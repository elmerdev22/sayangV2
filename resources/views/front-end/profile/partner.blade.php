@extends('front-end.layout')
@section('title','Seller Profile')

@section('content')

    <!-- Main content -->
    <section class="content">
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
                                    <h4>{{$data['store_name']}}</h4>
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
                            <div class="card-footer bg-white card-comments">
                                <div class="row">
                                    <div class="col-md-3">
                                        
                                    </div>
                                </div>
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
    </section>
    <!-- /.content -->

@endsection
