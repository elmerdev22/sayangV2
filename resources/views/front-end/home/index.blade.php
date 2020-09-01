@extends('front-end.layout')
@section('title','Auctions for Every Juan!')
@section('content')
<div id="welcome">
    <section class="jumbotron">
      <div class="container-fluid">
        <h1 class="jumbotron-heading display-4 text-white" data-aos="fade-right" data-aos-duration="500">
          <b>Nothing goes to waste.</b>
        </h1>
        <p class="lead text-white" data-aos="fade-right" data-aos-duration="700">Explore exciting deals near you.</p>
        <p>

        <form>
          <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
              <div class="input-group input-group-lg">
                <input class="form-control form-control-navbar border-0" type="search" placeholder="Location or Products" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar bg-white" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
        </p>
      </div>
    </section>
</div>
<div class="py-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h4 data-aos="fade-right">MOST POPULAR</h4>
      </div>
    </div>
    <hr>
    <div class="row">
      @for($x=0;$x < 9; $x++)
      <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up">
        <div class="card mb-4 product-card">
          <div style="width:100%; text-align:center">
            <img class="card-img-top" src="{{asset('images/default-photo/w2.jpg')}}" alt="Card image cap">
            <span class="ends-in"><div class="countdown text-white"><span class="fas fa-clock"></span> 4 hrs 2 mins</div></span>
            {{-- <div class="store-info p-1 bg-light">
                <div class="row">
                    <div class="col-6">
                        Elmer shop
                    </div>
                    <div class="col-6">
                        <span class="fas fa-star text-warning"></span> 4.5
                    </div>
                </div>
            </div> --}}
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
                    <a href="{{route('selected.product', ['slug' => 'Product-name'])}}">
                      <button class="btn btn-sm btn-dark item-btn">
                        <span class="font-weight-bold">Buy Now</span><br>
                        <small class="text-white item-info">Php: 40.00 | 30%off</small>
                      </button>
                    </a>
                </div>
                <div class="col-md-6 m-0 p-0">
                    <a href="{{route('selected.product', ['slug' => 'Product-name'])}}">
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

@endsection
