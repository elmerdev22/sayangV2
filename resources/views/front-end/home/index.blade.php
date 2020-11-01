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