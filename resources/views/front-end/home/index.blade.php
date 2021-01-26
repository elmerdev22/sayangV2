@extends('front-end.layout')
@section('title','Auctions for Every Juan!')
@section('css')
<link href="{{asset('template/assets/plugins/owl-carousel/css/owl.carousel.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <!-- Home Carousel Slider Banner-->
    @livewire('front-end.home.carousel-slider')
    <!-- .End Home Carousel Slider Banner-->
    <div class="hidden-xs d-none d-lg-block " style="position: absolute; top: 80px;">
        <div class="col-md-12">
            <section class="jumbotron bg-transparent ">
                <div class="container">
                    <h1 class="jumbotron-heading">
                        <b>Nothing goes to waste.</b>
                    </h1>
                    <p class="lead font-weight-normal">Explore exciting deals near you.</p>
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
<script src="{{asset('template/assets/plugins/owl-carousel/js/owl.carousel.js')}}"></script>
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

$('.product-owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        nav:false,
        loop: false,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:2,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    })
</script>
@endsection