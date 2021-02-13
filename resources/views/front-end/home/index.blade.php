@extends('front-end.layout')
@section('title','Auctions for Every Juan!')
@section('content')
@section('css')
<!-- plugin: owl carousel  -->
<link href="plugins/owlcarousel/assets/owl.carousel.css" rel="stylesheet">
<link href="plugins/owlcarousel/assets/owl.theme.default.css" rel="stylesheet">
@endsection
<!-- ========================= SECTION HERO ========================= -->
<section class="section-intro ">
    <div style="background: url('https://image.freepik.com/free-photo/hand-watering-plants-female-hand-holding-tree-nature-field-grass-forest-conservation-concept_34998-384.jpg')" class="page-holder bg-cover">
        <div class="container centered-hero py-5"  style="text-shadow: 2px 2px 5px #000000;">
            <header class="text-center text-white py-5">
                    <h1 class="display-3 font-weight-bold mb-4" >Nothing Goes to Waste</h1>
                    <p class="lead mb-0">Explore exciting deals near you.</p>
            </header>
            <div class="row justify-content-center align-items-center">
                <div class="col-8">
                    <form>
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
            
            <header class="section-heading">
                <h3 class="section-title text-center text-white pt-5">Together we've Rescued</h3>
            </header><!-- sect-heading -->
            <div class="row text-center">
                <div class="col-4 py-3">	
                    <figure class="item-feature">
                        <span class="text-primary"><i class="fa fa-2x fa-seedling"></i></span> 
                        <span class="text-white ">10,000 trees</span>
                        {{-- <figcaption class="pt-3">
                            <h5 class="title">Trees</h5>
                            <p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore </p>
                        </figcaption> --}}
                    </figure> <!-- iconbox // -->
                </div><!-- col // -->
                <div class="col-4 py-3">
                    <figure  class="item-feature">
                        <span class="text-info"><i class="fa fa-2x fa-tint"></i></span>	
                        <span class="text-white">10 Cm gallons of water</span>
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
                        <span class="text-white">10 GW of energry</span>
                        {{-- <figcaption class="pt-3">
                            <h5 class="title">Energy</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                        </figcaption> --}}
                    </figure> <!-- iconbox // -->
                </div> <!-- col // -->
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
            <h3 class="section-title text-white">Everyday, thousands of products are locked up, never to be sold again</h3>
            <p class="text-muted"> Content Content Content Content Content Content Content Content Content</p>
        </header><!-- sect-heading -->
        <div class="row">
            <div class="col-md-4 py-3">
                <div class="card bg-dark">
                    <img src="https://image.freepik.com/free-photo/farmer-hand-watering-young-baby-plants_35892-713.jpg" class="card-img opacity">
                    <div class="card-img-overlay text-white">
                        <h5 class="card-title">Trees</h5>
                        <p class="card-text">This is a wider card with a text below</p>
                        <a href="#" class="btn btn-light">Discover</a>
                    </div>
                </div> 
            </div> <!-- col.// -->
            <div class="col-md-4 py-3">
                <div class="card bg-dark">
                    <img src="https://image.freepik.com/free-photo/plant-growing-ground_1150-19317.jpg" class="card-img opacity">
                    <div class="card-img-overlay text-white">
                        <h5 class="card-title">Water</h5>
                        <p class="card-text">This is a wider card with text below</p>
                        <a href="#" class="btn btn-light">Discover</a>
                    </div>
                </div>
            </div> <!-- col.// -->
            <div class="col-md-4 py-3">
                <div class="card bg-dark">
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
            <h3 class="section-title">Categories</h3>
        </header><!-- sect-heading -->
        <!-- ============== COMPONENT SLIDER ITEMS OWL  ============= -->
        <div class="slider-items-owl owl-carousel owl-theme">
            @for ($i = 0; $i < 12; $i++)
                <div class="item-slide">
                    <figure class="box item-logo">
                        <a href="#"><img src="https://sayang-ph.com/storage/catalog/category-photo/13/conversions/Beverages-thumb.jpg"></a>
                        <figcaption class="border-top pt-2">36 Products</figcaption>
                    </figure> <!-- item-logo.// -->
                </div>
            @endfor
        </div>
        <!-- ============== COMPONENT SLIDER ITEMS OWL .end // ============= -->
    </div><!-- container // -->
</section>
        
<section class="section-name  padding-y-sm">
    <div class="container">
        <header class="section-heading">
            <a href="#" class="btn btn-outline-primary float-right">See all</a>
            <h3 class="section-title">Popular products</h3>
        </header><!-- sect-heading -->

        <div class="row">
            @for ($i = 0; $i < 8; $i++)
                <div class="col-6 col-md-4 col-lg-3">
                    <div href="#" class="card card-product-grid">
                        <a href="#" class="img-wrap"> <img src="https://cf.shopee.ph/file/9c351aa6daa7481e95dad5cca896e15c"> </a>
                        <span class="topbar">
                            <span class="badge badge-primary p-2">
                                <span class="fa fa-clock"></span>
                                3d 14h 25m 38s
                            </span>
                            {{-- <span class="float-right">50% off</span> --}}
                        </span>
                        <figcaption class="info-wrap">
                            
                            <div class="mt-2">
                                <var class="title">Product name</var> <!-- price-wrap.// -->
                                <span class="float-right">3 LEFT</span>
                            </div> <!-- action-wrap.end -->
                            <div class="mt-2">
                                <var class="price">₱150.00 <small><del>₱200.00</small></del></var> <!-- price-wrap.// -->
                                <a href="#" class="btn btn-sm btn-primary float-right">Buy now</a>
                            </div> <!-- action-wrap.end -->
                            <div class="mt-2">
                                <var class="price">₱100.00 <small>Bid: 3</small></var> <!-- price-wrap.// -->
                                <a href="#" class="btn btn-sm btn-outline-primary float-right">Bid now</a>
                            </div> <!-- action-wrap.end -->
                            <div class="mt-3">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <span class="text-primary">
                                            <i class="fa fa-seedling"></i>
                                        </span>
                                        <small>0.5</small>
                                    </div>
                                    <div class="col-4">
                                        <span class="text-info">
                                            <i class="fa fa-tint"></i>
                                        </span>
                                        <small>2.3</small>
                                    </div>
                                    <div class="col-4">
                                        <span class="text-warning">
                                            <i class="fa fa-bolt"></i>
                                        </span>
                                        <small>4</small>
                                    </div>
                                </div>
                            </div> <!-- action-wrap.end -->
                        </figcaption>
                    </div>
                </div> <!-- col.// -->
            @endfor
        </div> <!-- row.// -->
    </div><!-- container // -->
</section>

<!-- ========================= SECTION  END// ========================= -->
@endsection
@section('js')
<script src="plugins/owlcarousel/owl.carousel.min.js"></script>   
<script type="text/javascript">
    // jquery ready start
    $(document).ready(function() {
        if ($('.slider-items-owl').length > 0) { // check if element exists
            $('.slider-items-owl').owlCarousel({
                loop:true,
                margin:5,
                nav:true,
                autoplay:true,
                autoplayTimeout:2000,
                autoplayHoverPause:true,
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                responsive:{
                    0:{
                        items:4
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