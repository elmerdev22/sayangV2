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
        <img class="d-block w-100" src="https://png.pngtree.com/thumb_back/fw800/background/20190220/ourmid/pngtree-food-table-cloth-fresh-and-literary-red-image_5750.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://png.pngtree.com/thumb_back/fw800/background/20190221/ourmid/pngtree-blue-literary-fresh-food-image_15045.jpg" alt="Second slide">
      </div>
      <div class="carousel-item active">
        <img class="d-block w-100" src="https://png.pngtree.com/thumb_back/fw800/background/20190221/ourmid/pngtree-afternoon-tea-blue-green-background-literary-beautiful-image_12325.jpg" alt="Third slide">
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
  <div class="main-text hidden-xs d-none d-lg-block ">
    <div class="col-md-12">
      <section class="jumbotron bg-transparent ">
        <div class="container">
          <h1 class="jumbotron-heading">
            <b>Nothing goes to waste.</b>
          </h1>
          <p class="lead">Explore exciting deals near you.</p>
          <form action="{{route('front-end.product.list.index')}}" method="GET">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="input-group input-group-lg shadow-sm">
                  <input class="form-control form-control-navbar border-0" type="search" name="search" placeholder="Location or Products" aria-label="Search">
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
    <div class="card shadow-sm">
      <div class="card-body p-2">
        @livewire('front-end.home.category')
      </div>
    </div>
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
    margin:5,
    dots: false,
    nav: false,
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:6,
            margin:0,
        },
        600:{
            items:8
        },
        1000:{
            items:12
        }
    }
})

</script>
@endsection