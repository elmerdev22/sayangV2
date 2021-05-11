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
    <div style="background: url('{{Utility::home_background_random()}}'); text-shadow: 2px 2px 5px #383636;" class="page-holder bg-cover">
        <div class="container">
            <div class="row pt-4">
                <div class="col-12">
                    <header class="text-center text-white py-5">
                        <h1 class="display-2 mb-4 home-title">NOTHING GOES TO <br> WASTE</h1>
                    </header>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-10 col-lg-5">
                            <form action="{{route('front-end.product.list.index')}}" method="GET">
                                <div class="input-group input-group-lg">
                                    <input class="form-control form-control-navbar border-none shadow-none" type="search" name="search" placeholder="Type in your location or search for a product" aria-label="Search">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row w-100" style="bottom: 0%; left: 0%; right: 0%; position: absolute;">
                <div class="col-12 mb-2">
                    <header>
                        <h3 class="text-center text-white subheader">Together, we’ve rescued</h3>
                    </header><!-- sect-heading -->
                </div>
                <div class="col-12">
                    <div class="row text-center">
                        <div class="col-4">	
                            <figure class="item-feature item-feature-home">
                                <span class="text-primary"><i class="fa fa-2x fa-seedling"></i></span> 
                                <span class="text-white ">{{$data['element_trees']}} trees  </span>
                            </figure> <!-- iconbox // -->
                        </div><!-- col // -->
                        <div class="col-4">
                            <figure class="item-feature item-feature-home">
                                <span class="text-info"><i class="fa fa-2x fa-tint"></i></span>	
                                <span class="text-white">{{$data['element_water']}} gal of water</span>
                            </figure> <!-- iconbox // -->
                        </div><!-- col // -->
                        <div class="col-4">
                            <figure class="item-feature item-feature-home">
                                <span class="text-warning"><i class="fa fa-2x fa-bolt"></i></span>
                                <span class="text-white">{{$data['element_energy']}} kw of energy</span>
                            </figure> <!-- iconbox // -->
                        </div> <!-- col // -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= SECTION HERO END// ========================= -->
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
                        <img src="{{UploadUtility::image_setting($row->id, 'advocacy-section')}}" class="card-img opacity" style="height: 230px; width: auto; object-fit: cover;">
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

@if ($data['featured_partners']->count() > 0)
    <section class="section-name  padding-y-sm">
        <div class="container">
            <header class="section-heading">
                <a href="{{route('front-end.home.partners')}}" class="btn btn-outline-primary float-right">See all</a>
                <h5 class="section-title">Featured Partners</h5>
            </header><!-- sect-heading -->
            <div class="row">
                @foreach ($data['featured_partners'] as $partner)
                    @php
                        $photo = UploadUtility::account_photo($partner->user_key_token , 'business-information/store-photo', 'store_photo');
                    @endphp
                    <div class="col-md-3">
                        @component('front-end.components.partners.grid')
                            @slot('link', route('front-end.profile.partner.index', ['slug' => $partner->slug ]))
                            @slot('photo', $photo)
                            @slot('name', ucfirst($partner->name))
                            @slot('ratings', Utility::get_partner_ratings($partner->id))
                            @slot('products', number_format(Utility::count_products($partner->id) ,0))
                        @endcomponent
                    </div>
                @endforeach
            </div>
        </div><!-- container // -->
    </section>
@endif
        
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
                $url = Auth::check() ? '/about-us' : '/register';
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
<section class="section-name padding-y-sm">
    <div class="container">
        <header class="section-heading">
            <h5 class="section-title">How it works  </h5>
        </header><!-- sect-heading -->
        <div class="row">
            <div class="col-md-4">
                <article class="card-body" data-aos="fade-up">
                    <figure class="text-center">
                        <span>
                            <img class="icon icon-lg rounded-circle" src="{{asset('images/default-photo/how-it-wroks/1.png')}}">
                        </span>
                        <figcaption class="pt-4">
                        <h5 class="title">Register</h5>
                        <p class="text-justify">Register for an account with us or login via Facebook or Google. No sign-up fees required!</p>
                        </figcaption>
                    </figure> <!-- iconbox // -->
                </article> <!-- panel-lg.// -->
            </div><!-- col // -->
            <div class="col-md-4">
                <article class="card-body" data-aos="fade-up">
                    <figure class="text-center">
                        <span>
                            <img class="icon icon-lg rounded-circle" src="{{asset('images/default-photo/how-it-wroks/2.png')}}">
                        </span>
                        <figcaption class="pt-4">
                        <h5 class="title">Buy or Bid</h5>
                        <p class="text-justify">You can either directly buy or bid on a product. "Buy now" guarantees you the item by paying at a fixed price. On the otherhand, bids give you the chance to get the item at a lower price.</p>
                        </figcaption>
                    </figure> <!-- iconbox // -->
                </article> <!-- panel-lg.// -->
            </div> <!-- col // -->
            <div class="col-md-4">
                <article class="card-body" data-aos="fade-up">
                    <figure class="text-center">
                        <span>
                            <img class="icon icon-lg rounded-circle" src="{{asset('images/default-photo/how-it-wroks/3.png')}}">
                        </span>
                        <figcaption class="pt-4">
                        <h5 class="title">Pay and Pickup</h5>
                        <p class="text-justify">Whether you chose the buy or bid, you will be able to use our array of payment options to complete the transaction. It's now time to pickup the item at your earliest convenience.</p>
                        </figcaption>
                    </figure> <!-- iconbox // -->
                </article> <!-- panel-lg.// -->
            </div> <!-- col // -->
        </div>    
    </div><!-- container // -->
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