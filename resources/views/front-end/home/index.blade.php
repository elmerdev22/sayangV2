@extends('front-end.layout')
@section('title', Utility::settings('home_title'))
@section('content')
@section('css')
<!-- plugin: owl carousel  -->
<link href="plugins/owlcarousel/assets/owl.carousel.css" rel="stylesheet">
<link href="plugins/owlcarousel/assets/owl.theme.default.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection
<!-- ========================= SECTION HERO ========================= -->
<section class="section-intro ">
    <div style="background: url('{{Utility::home_background_random()}}'); background-attachment: fixed; text-shadow: 2px 2px 5px #383636;" class="page-holder bg-cover">
        <div class="container">
            <div class="row padding-y">
                <div class="col-12">
                    <header class="text-center text-white py-5">
                        <h1 class="display-3 font-weight-bold mb-4" >NOTHING GOES TO WASTE</h1>
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
                </div>
            </div>
            <div style="position: absolute; bottom: 0; left: 50%;">
                <div style="position: relative; left: -50%;">
                    <div class="row">
                        <div class="col-12">
                            <header>
                                <h3 class="text-center text-white pt-5">Together, we’ve rescued</h3>
                            </header><!-- sect-heading -->
                        </div>
                        <div class="col-12">
                            <div class="row text-center">
                                <div class="col-4 pt-3">	
                                    <figure class="item-feature">
                                        <span class="text-primary"><i class="fa fa-2x fa-seedling"></i></span> 
                                        <span class="text-white ">10,000 trees  </span>
                                    </figure> <!-- iconbox // -->
                                </div><!-- col // -->
                                <div class="col-4 pt-3">
                                    <figure  class="item-feature">
                                        <span class="text-info"><i class="fa fa-2x fa-tint"></i></span>	
                                        <span class="text-white">10 gal of water</span>
                                    </figure> <!-- iconbox // -->
                                </div><!-- col // -->
                                <div class="col-4 pt-3">
                                    <figure  class="item-feature">
                                        <span class="text-warning"><i class="fa fa-2x fa-bolt"></i></span>
                                        <span class="text-white">10 kw of energry</span>
                                    </figure> <!-- iconbox // -->
                                </div> <!-- col // -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container centered-hero py-5" style="text-shadow: 2px 2px 5px #000000;">
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
                        </figure> <!-- iconbox // -->
                    </div><!-- col // -->
                    <div class="col-4 py-3">
                        <figure  class="item-feature">
                            <span class="text-info"><i class="fa fa-2x fa-tint"></i></span>	
                            <span class="text-white">10 gal of water</span>
                        </figure> <!-- iconbox // -->
                    </div><!-- col // -->
                    <div class="col-4 py-3">
                        <figure  class="item-feature">
                            <span class="text-warning"><i class="fa fa-2x fa-bolt"></i></span>
                            <span class="text-white">10 kw of energry</span>
                        </figure> <!-- iconbox // -->
                    </div> <!-- col // -->
                </div>
            </div>
        </div> --}}
        
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
            <h3 class="section-title text-white" data-aos="fade-up">{{Utility::description_settings('header')->settings_value}}</h3>
            <p class="text-muted" data-aos="fade-up" data-aos-delay="50"> {{Utility::description_settings('sub_header')->settings_value}}</p>
        </header><!-- sect-heading -->
        <div class="row">
            @foreach ($data['advocacy_section_card'] as $row)
                <div class="col-md-4 py-3">
                    <div class="card bg-dark" data-aos="zoom-in">
                        <img src="{{UploadUtility::image_setting($row->id, 'advocacy-section')}}" class="card-img opacity">
                        <div class="card-img-overlay text-white">
                            <h5 class="card-title">{{$row->settings_name}}</h5>
                            <p class="card-text">{{$row->description}}</p>
                            <a href="{{$row->redirect}}" class="btn btn-light">Discover</a>
                        </div>
                    </div> 
                </div> <!-- col.// -->
            @endforeach
        </div> <!-- row.// -->
    </div> <!-- container .//  -->
</section>
        
<!-- ========================= SECTION  ========================= -->
<section class="section-name padding-y-sm">
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
            <h1 class="display-3 font-weight-bold text-white" data-aos="fade-right" data-aos-delay="50">
                {{$data['advocacy_section_2']['settings_name']}}
            </h1>
            <p class="text-white" style="max-width: 600px" data-aos="fade-right" data-aos-delay="100">
                {!! $data['advocacy_section_2']['description'] !!}
            </p>
            @php
                $url = Auth::check() ? '/' : '/register';
            @endphp
            <a href="{{$url}}" class="btn btn-light" data-aos="fade-right" data-aos-delay="150">Join the movement now <span class="fas fa-arrow-right"></span></a>
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
<section class="section-name pt-2">
    <div class="card-banner " style="min-height:300px; background-image: url('{{UploadUtility::image_setting($data['become_a_partner_section']['id'], 'become-a-partner')}}'); border-radius: 0;  background-attachment: fixed; ">
        <div class="container">
            <div class="row py-3">
                <div class="col-12">
                    <div style="min-height:300px; ">
                        <h1 class="display-3 font-weight-bold text-white" data-aos="fade-right" data-aos-delay="50">
                            {{$data['become_a_partner_section']['settings_name']}}
                        </h1>
                        <p class="text-white" style="max-width: 600px" data-aos="fade-right" data-aos-delay="100">
                            {!! $data['become_a_partner_section']['description'] !!}
                        </p>
                        @php
                            $url = Auth::check() ? '/' : '/register/partner';
                        @endphp
                        <a href="{{$url}}" class="btn btn-light" data-aos="fade-right" data-aos-delay="150">Join the movement now <span class="fas fa-arrow-right"></span></a>
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
                dots:false,
                autoplayTimeout:2000,
                autoplayHoverPause:true,
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