<div>
    <div class="row">
        @for($x=0;$x < 4; $x++)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up">
                <div class="card mb-4 product-card">
                    <div class="text-center w-100">
                        <img class="card-img-top" src="{{asset('images/default-photo/product1.jpg')}}" alt="Card image cap">
                        <span class="ends-in">
                            <div class="countdown text-white">
                                <span class="fas fa-clock"></span> 4 hrs 2 mins
                            </div>
                        </span>
                        <div class="store-info p-1 mx-1 bg-transparent" style="margin-top: -30px;">
                            <div class="row">
                                <div class="col-6 text-white text-left">
                                    Elmer shop
                                </div>
                                <div class="col-6 text-right">
                                    <span class="fas fa-star text-warning"></span> 
                                    <span class="text-white">4.5</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-info p-2">
                            <div class="row">
                                <div class="col-6 font-weight-bold text-left">
                                    COCONUT OIL
                                </div>
                                <div class="col-6 text-right">
                                    3 left!
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-6 m-0 p-0">
                                <a href="javascript:void(0);">
                                    <button class="btn btn-sm btn-dark item-btn">
                                        <span class="font-weight-bold">Buy Now</span><br>
                                        <small class="text-white item-info">Php: 40.00 | 30%off</small>
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6 m-0 p-0">
                                <a href="javascript:void(0);">
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
