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
                                <div class="widget-user-header text-white" style="background: url('{{$data['cover_photo']}}'); background-repeat: no-repeat; background-size: cover;">
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle" style="width: auto; height: 100px;" src="{{$data['store_photo']}}" alt="Card image cap">
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
                                                <span class="text-sm">{{$data['ratings']}}</span>
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <label>
                                                <span class="fas fa-store"></span>
                                                <span class="text-muted">Products :</span>
                                                <span class="text-sm">{{number_format($data['products'], 0)}}</span> 
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
                                                <span class="text-sm">{{number_format($data['followers'], 0)}}</span> 
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
                                                <p>
                                                    {{$data['store_address']}}</p>
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
                            <a class="nav-item nav-link active col-4" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="true">Products</a>
                            <a class="nav-item nav-link col-4 " id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Ratings</a>
                            <a class="nav-item nav-link col-4 " id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false">Location</a>
                        </div>
                    </nav>
                    
                    <div class="tab-content py-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
                            <div class="card-footer bg-white card-comments">
                                <div class="row">
                                    @for($x=0;$x < 9; $x++)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                            <div class="card mb-4 product-card">
                                                <div style="width:100%; text-align:center">
                                                    <img class="card-img-top" src="https://images.summitmedia-digital.com/spotph/images/2019/03/19/chickenjoydelivery-1552988282.jpg" alt="Card image cap">
                                                    <span class="ends-in"><div class="countdown text-white"><span class="fas fa-clock"></span> 4 hrs 2 mins</div></span>
                                                    <div class="store-info p-1 mx-1 bg-transparent" style="margin-top: -30px;">
                                                        <div class="row">
                                                            <div class="col-8 text-white text-left">
                                                                Jollibee Malolos
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <span class="fas fa-star text-warning"></span> 
                                                                <span class="text-white">4.5</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-info p-2">
                                                        <div class="row">
                                                            <div class="col-6 font-weight-bold text-left">
                                                                Noodles
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                3 left!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-0 p-0">
                                                        <div class="col-md-6 m-0 p-0">
                                                            <a href="">
                                                            <button class="btn btn-sm btn-dark item-btn">
                                                                <span class="font-weight-bold">Buy Now</span><br>
                                                                <small class="text-white item-info">Php: 40.00 | 30%off</small>
                                                            </button>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 m-0 p-0">
                                                            <a href="">
                                                            <button class="btn btn-sm btn-outline-warning text-dark item-btn">
                                                            <span class="font-weight-bold">Place Bid</span><br>
                                                            <small class="item-info">Bids: 5 | Top: 250.00</small>
                                                            </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> 
                            <div class="card-footer bg-white card-comments">
                                @livewire('front-end.product.information.ratings', ['partner_id' => $data['partner_id'] ])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab"> 
                            <div class="card-footer bg-white card-comments">
                                Google map here 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
