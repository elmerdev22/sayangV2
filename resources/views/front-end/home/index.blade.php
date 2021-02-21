@extends('front-end.layout')
@section('title','Auctions for Every Juan!')
@section('content')
@section('css')
<!-- plugin: owl carousel  -->
<link href="plugins/owlcarousel/assets/owl.carousel.css" rel="stylesheet">
<link href="plugins/owlcarousel/assets/owl.theme.default.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection
<!-- ========================= SECTION HERO ========================= -->
<section class="section-intro ">
    <div style="background: url('https://image.freepik.com/free-photo/hand-watering-plants-female-hand-holding-tree-nature-field-grass-forest-conservation-concept_34998-384.jpg')" class="page-holder bg-cover">
        <div class="container centered-hero py-5" style="text-shadow: 2px 2px 5px #000000;">
            <header class="text-center text-white py-5">
                    <h1 class="display-3 font-weight-bold mb-4" >Nothing Goes to Waste</h1>
                    <p class="lead mb-0">Explore exciting deals near you.</p>
            </header>
            <div class="row justify-content-center align-items-center">
                <div class="col-8">
                    <form action="{{route('front-end.product.list.index')}}" method="GET">
                        <div class="input-group input-group-lg shadow-sm">
                            <input class="form-control form-control-navbar border-0" type="search" name="search" placeholder="Location or Products" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar bg-primary" type="submit">
                                    <i class="fas fa-search text-white"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <header class="section-heading">
                    <h3 class="section-title text-center text-white pt-5">Together we've Rescued</h3>
                </header><!-- sect-heading -->
                <div class="row text-center">
                    <div class="col-4 py-3">	
                        <figure class="item-feature">
                            <span class="text-primary"><i class="fa fa-2x fa-seedling"></i></span> 
                            <span class="text-white ">10,000 trees  </span>
                            {{-- <figcaption class="pt-3">
                                <h5 class="title">Trees</h5>
                                <p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore </p>
                            </figcaption> --}}
                        </figure> <!-- iconbox // -->
                    </div><!-- col // -->
                    <div class="col-4 py-3">
                        <figure  class="item-feature">
                            <span class="text-info"><i class="fa fa-2x fa-tint"></i></span>	
                            <span class="text-white">10 gal of water</span>
                            {{-- <figcaption class="pt-3">
                                <h5 class="title">Water</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    </p>
                            </figcaption> --}}
                        </figure> <!-- iconbox // -->
                    </div><!-- col // -->
                    <div class="col-4 py-3">
                        <figure  class="item-feature">
                            <span class="text-warning"><i class="fa fa-2x fa-bolt"></i></span>
                            <span class="text-white">10 kw of energry</span>
                            {{-- <figcaption class="pt-3">
                                <h5 class="title">Energy</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </figcaption> --}}
                        </figure> <!-- iconbox // -->
                    </div> <!-- col // -->
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- ========================= SECTION HERO END// ========================= -->

<!-- ========================= SECTION SPECIAL ========================= -->
{{-- <section class="section-specials padding-y border-bottom">
    <div class="container">	
        <header class="section-heading pb-2">
            <h3 class="section-title text-center">Together we've Rescued</h3>
        </header><!-- sect-heading -->
        <div class="row text-center">
            <div class="col-md-4 py-3">	
                <figure class="item-feature">
                    <span class="text-primary"><i class="fa fa-2x fa-seedling"></i></span>
                    <figcaption class="pt-3">
                        <h5 class="title">Trees</h5>
                        <p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore </p>
                    </figcaption>
                </figure> <!-- iconbox // -->
            </div><!-- col // -->
            <div class="col-md-4 py-3">
                <figure  class="item-feature">
                    <span class="text-info"><i class="fa fa-2x fa-tint"></i></span>	
                    <figcaption class="pt-3">
                        <h5 class="title">Water</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            </p>
                    </figcaption>
                </figure> <!-- iconbox // -->
            </div><!-- col // -->
            <div class="col-md-4 py-3">
                <figure  class="item-feature">
                    <span class="text-warning"><i class="fa fa-2x fa-bolt"></i></span>
                    <figcaption class="pt-3">
                        <h5 class="title">Energy</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                    </figcaption>
                </figure> <!-- iconbox // -->
            </div> <!-- col // -->
        </div>
    </div> <!-- container.// -->
</section> --}}
<!-- ========================= SECTION SPECIAL END// ========================= -->
        
<section class="section-content padding-y" style="background-color: #10093f">
    <div class="container">
        <header class="section-heading pb-2 text-center">
            <h3 class="section-title text-white" data-aos="fade-up">Everyday, thousands of products are locked up, never to be sold again</h3>
            <p class="text-muted" data-aos="fade-up" data-aos-delay="50"> Content Content Content Content Content Content Content Content Content</p>
        </header><!-- sect-heading -->
        <div class="row">
            <div class="col-md-4 py-3">
                <div class="card bg-dark" data-aos="zoom-in">
                    <img src="https://image.freepik.com/free-photo/farmer-hand-watering-young-baby-plants_35892-713.jpg" class="card-img opacity">
                    <div class="card-img-overlay text-white">
                        <h5 class="card-title">Trees</h5>
                        <p class="card-text">This is a wider card with a text below</p>
                        <a href="#" class="btn btn-light">Discover</a>
                    </div>
                </div> 
            </div> <!-- col.// -->
            <div class="col-md-4 py-3">
                <div class="card bg-dark" data-aos="zoom-in">
                    <img src="https://image.freepik.com/free-photo/plant-growing-ground_1150-19317.jpg" class="card-img opacity">
                    <div class="card-img-overlay text-white">
                        <h5 class="card-title">Water</h5>
                        <p class="card-text">This is a wider card with text below</p>
                        <a href="#" class="btn btn-light">Discover</a>
                    </div>
                </div>
            </div> <!-- col.// -->
            <div class="col-md-4 py-3">
                <div class="card bg-dark" data-aos="zoom-in">
                    <img src="https://image.freepik.com/free-photo/farmer-hand-watering-young-baby-plants_35892-713.jpg" class="card-img opacity">
                    <div class="card-img-overlay text-white">
                        <h5 class="card-title">Energy</h5>
                        <p class="card-text">This is a wider card with text below</p>
                        <a href="#" class="btn btn-light">Discover</a>
                    </div>
                </div>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- container .//  -->
</section>
        
<!-- ========================= SECTION  ========================= -->
<section class="section-name bg padding-y-sm">
    <div class="container">
        <header class="section-heading">
            <h5 class="section-title">Categories</h5>
        </header><!-- sect-heading -->
        <!-- ============== COMPONENT SLIDER ITEMS OWL  ============= -->
        @livewire('front-end.home.category')
        <!-- ============== COMPONENT SLIDER ITEMS OWL .end // ============= -->
    </div><!-- container // -->
</section>
        
<section class="section-name  padding-y-sm">
    <div class="container">
        <header class="section-heading">
            <a href="{{route('front-end.product.list.index')}}" class="btn btn-outline-primary float-right">See all</a>
            <h5 class="section-title">Help Us Rescue these products</h5>
        </header><!-- sect-heading -->
        @livewire('front-end.home.index.most-popular')
    </div><!-- container // -->
</section>

<section class="section-name padding-y-sm" style="background-color: #10093f">
    <div class="container">
        <div style="min-height:300px; ">
            <h1 class="display-3 font-weight-bold text-white" data-aos="fade-right" data-aos-delay="50">WAGING THE WAR<br>AGAINTS WASTE</h1>
            <p class="text-white" style="max-width: 600px" data-aos="fade-right" data-aos-delay="100">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
                tempor incididunt.
            </p>
            <a href="" class="btn btn-light" data-aos="fade-right" data-aos-delay="150">Join the movement now <span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
</section>
<section class="section-name padding-y-sm">
    <div class="container">
        <header class="section-heading">
            <a href="{{route('front-end.product.list.index')}}" class="btn btn-outline-primary float-right">See all</a>
            <h5 class="section-title">Hurry! Last chance to rescue these products! </h5>
        </header><!-- sect-heading -->

        @livewire('front-end.home.index.ending-soon')
    </div><!-- container // -->
</section>
<section class="section-name padding-y-sm">
    <div class="card-banner " style="min-height:300px; background-image: url('https://image.freepik.com/free-photo/two-confident-business-man-shaking-hands-during-meeting-office-success-dealing-greeting-partner-concept_1423-185.jpg'); border-radius: 0;">
        <div class="container">
            <div class="row py-3">
                <div class="col-12">
                    <div style="min-height:300px;">
                        <h1 class="display-3 text-white font-weight-bold" data-aos="fade-right" data-aos-delay="50">BECOME A PARTNER</h1>
                        <p class="card-text text-white" style="max-width: 600px" data-aos="fade-right" data-aos-delay="100">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididuntLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididuntLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt.
                        </p>
                        <a href="{{url('register/partner')}}" class="btn btn-light" data-aos="fade-right" data-aos-delay="150">Join the movement now <span class="fas fa-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= SECTION  END// ========================= -->
@endsection
@section('js')
<script src="plugins/owlcarousel/owl.carousel.min.js"></script>   
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 700, // values from 0 to 3000, with step 50ms
        once: true
    });
  </script>
<script type="text/javascript">
    // jquery ready start
    $(document).ready(function() {
        if ($('.slider-items-owl').length > 0) { // check if element exists
            $('.slider-items-owl').owlCarousel({
                loop:true,
                margin:5,
                nav:false,
                autoplay:true,
                autoplayTimeout:2000,
                autoplayHoverPause:true,
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                responsive:{
                    0:{
                        items:3
                    },
                    640:{
                        items:6
                    },
                    1024:{
                        items:8
                    }
                }
            })
        } 
    }); 
</script>
@endsection