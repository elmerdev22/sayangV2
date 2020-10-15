@extends('front-end.layout')
@section('title','Auctions for Every Juan!')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <section class="jumbotron" style=" background:url('{{asset('images/default-photo/banner1.png')}}') center no-repeat">
      <div class="container">
        <h1 class="jumbotron-heading display-4" data-aos="fade-right" data-aos-duration="500">
          <b>Nothing goes to waste.</b>
        </h1>
        <p class="lead " data-aos="fade-right" data-aos-duration="700">Explore exciting deals near you.</p>
        <p>

        <form>
          <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
              <div class="input-group input-group-lg">
                <input class="form-control form-control-navbar border-0" type="search" placeholder="Location or Products" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar bg-warning" type="submit">
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
  <div class="container">
    <div class="row">
      <div class="col-12">    
        <div class="owl-carousel owl-theme">
              
          @for($x=0;$x < 8; $x++)
          <div class="item">
            <div class="card text-center shadow-none" style="width: auto;">
              <div class="card-body category-icon">
                <img class="card-img-top display-inline img-fluid img-circle shadow-sm border " src="{{asset('images/icons/icon'.$x.'.png')}}" alt="Card image cap">
              </div>
            </div>
          </div>
          @endfor
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mb-3">
        <h3 class="title" data-aos="fade-right">MOST POPULAR</h3>
      </div>
      @for($x=0;$x < 9; $x++)
      <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up">
        <div class="card mb-4 product-card">
          <div style="width:100%; text-align:center">
            <img class="card-img-top" src="{{asset('images/default-photo/product1.jpg')}}" alt="Card image cap">
            <span class="ends-in"><div class="countdown text-white"><span class="fas fa-clock"></span> 4 hrs 2 mins</div></span>
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
                    <a href="{{route('selected.product', ['slug' => 'Product-name'])}}">
                      <button class="btn btn-sm btn-dark item-btn">
                        <span class="font-weight-bold">Buy Now</span><br>
                        <small class="text-white item-info">Php: 40.00 | 30%off</small>
                      </button>
                    </a>
                </div>
                <div class="col-md-6 m-0 p-0">
                    <a href="{{route('selected.product', ['slug' => 'product-name'])}}">
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
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
<script>
$('.owl-carousel').owlCarousel({
    center: false,
    loop:true,
    margin:10,
    dots: true,
    nav: false,
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:4
        },
        600:{
            items:6
        },
        1000:{
            items:8
        }
    }
})
</script>
@endsection