@extends('front-end.layout')
@section('title','Auctions for Every Juan!')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet" />
<style>
.main-text
{
    position: absolute;
    top: 80px;
}
</style>
@endsection
@section('content')
<div class="container">
  <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item">
        <img class="d-block w-100" src="http://127.0.0.1:8000/images/default-photo/banner1.png" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="http://127.0.0.1:8000/images/default-photo/banner1.png" alt="Second slide">
      </div>
      <div class="carousel-item active">
        <img class="d-block w-100" src="http://127.0.0.1:8000/images/default-photo/banner1.png" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <div class="main-text hidden-xs">
    <div class="col-md-12">
      <section class="jumbotron bg-transparent">
        <div class="container">
          <h1 class="jumbotron-heading">
            <b>Nothing goes to waste.</b>
          </h1>
          <p class="lead">Explore exciting deals near you.</p>
          <form>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
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
</div>
</div>
<div class="py-3">
  <div class="container">
    @livewire('front-end.home.category')
    @livewire('front-end.home.index.most-popular')
    @livewire('front-end.home.index.recently-added')
    @livewire('front-end.home.index.ending-soon')
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
            items:6
        },
        600:{
            items:8
        },
        1000:{
            items:10
        }
    }
})

</script>
@endsection