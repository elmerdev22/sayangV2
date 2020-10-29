@extends('front-end.layout')
@section('title','Seller Profile')
@section('css')

<style>
    #seller-bg {
        border: 1px whitesmoke;
        /* padding: 25px; */
        background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR1aer_eK_rutTokxSeU5gTiW1q9eUKPvpTyw&usqp=CAU');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
    
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row ">
                <div class="col-md-6">
                    <!-- Profile Image -->
                    <div class="card card-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="p-4" id="seller-bg">
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2 mr-3" style="height: 80px; width: auto;" src="https://upload.wikimedia.org/wikipedia/en/thumb/8/84/Jollibee_2011_logo.svg/1200px-Jollibee_2011_logo.svg.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="text-white">Jollibee Malolos</h3>
                            <button class="btn btn-warning btn-sm">
                                <span class="fas fa-plus"></span> Follow
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 pl-5 pt-3">
                    <div class="row">
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
                                <span class="text-warning">57</span> 
                            </label>
                        </div>
                        <div class="col-12">
                            <label>
                                <span class="fas fa-users"></span>
                                <span class="text-muted">Followers :</span>
                                <span class="text-warning">57</span> 
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 pl-5 pt-3">
                    <div class="row">
                        <div class="col-12">
                            <label>
                                <span class="fas fa-map-marker-alt"></span> 
                                <span class="text-muted">Address :</span>
                                Malolos, Bulacan
                            </label>
                        </div>
                        <div class="col-12">
                            <label>
                                <span class="fas fa-calendar"></span>
                                <span class="text-muted">Joined :</span>
                                January 01, 3001
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="true">Products</a>
                            <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Ratings</a>
                            <a class="nav-item nav-link" id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false">Location</a>
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
                                @livewire('front-end.product.information.ratings')
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
