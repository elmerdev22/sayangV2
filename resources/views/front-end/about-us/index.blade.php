@extends('front-end.layout')
@section('title','About Us')
@section('css')
<link href="{{asset('template/assets/plugins/aos/aos.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-primary">
    <div class="container">
        <h2 class="title-page text-white">About Us</h2>
    </div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->
    
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">      
        <div class="row" data-aos="fade-right">
            <div class="col-md-6">
                <h1 class="text-primary display-3 mb-5 font-weight-bolder">We are <br> dreamers</h1>
                <p>
                    We dream of a world where no perfectly good, consumable, or usable product goes to waste.
                </p>
                <p>
                    Our spending habits and standards inadvertently lead to waste. Groceries adhere to strict aesthetic guidelines for their fresh produce where a fruit with a minuscule brown spot will be thrown away instead of being sold. Traditional ecommerce sites require very long remaining shelf life, leading to the disposal of perfectly good products even if it is just a few days past the cut-off.
                </p>
                <p class="mb-3">
                    We believe that by creating a platform for manufacturers and users alike will help reduce and eventually get rid of this unnecessary waste.
                </p>
            </div> 
            <div class="col-md-6">
                <img class="img-fluid img-responsive px-5" src="{{asset('images/default-photo/about-us/1.jpeg')}}">
            </div> 
        </div>
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y" style="background-color: #10093f">
    <div class="container">
        <div class="row">
            <div class="col-md-4 py-3">
                <article class="card-body">
                    <figure class="text-white">
                        <span>
                            <img class="icon icon-lg rounded-circle" src="{{asset('images/default-photo/about-us/2.png')}}">
                        </span>
                        <figcaption class="pt-4">
                        <h5 class="title">Discountinued Items</h5>
                        <p class="">As our partners continue to innovate and refresh their product portfolio,  unsold previous variants remain in their warehouses, waiting to expire and be disposed.</p>
                        </figcaption>
                    </figure> <!-- iconbox // -->
                </article>
            </div> <!-- col.// -->
            <div class="col-md-4 py-3">
                <article class="card-body aos-init aos-animate" data-aos="fade-up">
                    <figure class="text-white">
                        <span>
                            <img class="icon icon-lg rounded-circle" src="{{asset('images/default-photo/about-us/3.png')}}">
                        </span>
                        <figcaption class="pt-4">
                        <h5 class="title">Near Expiry Stocks</h5>
                        <p class="">Groceries and ecommerce sites require strict remaining shelf life for all their products. These can range from 6 month up to 1 year. This means that anything with a shelf life of below the requirement will not be sold by our partners to traditional channels.</p>
                        </figcaption>
                    </figure> <!-- iconbox // -->
                </article>
            </div> <!-- col.// -->
            <div class="col-md-4 py-3">
                <article class="card-body aos-init aos-animate" data-aos="fade-up">
                    <figure class="text-white">
                        <span>
                            <img class="icon icon-lg rounded-circle" src="{{asset('images/default-photo/about-us/4.png')}}">
                        </span>
                        <figcaption class="pt-4">
                        <h5 class="title">Overstocks</h5>
                        <p class="">Due to changing demand patterns and consumer needs, certain products will low demand remain in the warehouse for a long period of time.</p>
                        </figcaption>
                    </figure> <!-- iconbox // -->
                </article>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
    
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">      
        <div class="row" data-aos="fade-up">
            <div class="col-md-6">
                <img class="img-fluid img-responsive px-5" src="{{asset('images/default-photo/about-us/5.jpeg')}}">
            </div> 
            <div class="col-md-6">
                <h1 class="text-primary display-4 mb-5 font-weight-bolder">About Us</h1>
                <p>
                    Our team is Our purpose is to be part of solutions that tackle our world's biggest problems, and what better way to drive this purpose than helping eliminate waste and improve lives and businesses in the process?
                </p>
                <p>
                    Our team is composed of young, passionate professionals turned entrepreneurs. As each one of us were previously based in Metro Manila, we witnessed first hand how wastes affect people, businesses, and the planet.
                </p>
            </div> 
        </div>                    
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
    
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">      
        <div class="row" data-aos="fade-up">
            <div class="col-md-6">
                <h1 class="text-primary display-4 mb-5 font-weight-bolder">Our Story</h1>
                <p>
                    Our idea was borne out of necessity. While the pandemic raged on last 2020, we witnessed people and businesses struggling to make ends meet.
                </p>
                <p>
                    We witnessed both large and small businesses alike come up with different schemes to sell their excess inventory. Top fast food companies tried going retail, FMCGs turned to ecommerce promos, and small businesses tried their luck with online selling. Despite these huge efforts, we still saw the devastating financial impact of the pandemic as their products remain unsold.
                </p>
                <p>
                    On the other hand, people were lining up for hours to receive their much needed relief, some of whom have not earned anything for days due to the lockdowns.
                </p>
                <p class="mb-3">
                    We find it unjust that while products expire in our partners' warehouses, the most vulnerable cannot get their hands on much needed essentials due to lack of cash.
                </p>
            </div> 
            <div class="col-md-6">
                <img class="img-fluid img-responsive px-5" src="{{asset('images/default-photo/about-us/6.jpeg')}}">
            </div> 
        </div>                    
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">      
        <div class="row" data-aos="fade-up">
            <div class="col-md-6">
                <img class="img-fluid img-responsive px-5" src="{{asset('images/default-photo/about-us/7.jpeg')}}">
            </div> 
            <div class="col-md-6">
                <h1 class="text-primary display-4 mb-5 font-weight-bolder">NOTHING GOES TO WASTE</h1>
                <p>
                    We believe that by creating a platform for these products, we can help eliminate waste, help businesses, and help people all at the same time.
                </p>
            </div> 
        </div>                    
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y" style="background-color: #10093f">
    <div class="container padding-y">
        <div class="row text-white text-center">
            <div class="col-md-6">
                <h1>Join the Movement Now</h1>
            </div>
            <div class="col-md-6">
                <a href="{{Auth::check() ? '/about-us' : '/register'}}" class="btn btn-primary btn-flat btn-lg">REGISTER TODAY</a>
            </div>
        </div>
    </div><!-- container // -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
@section('js')
<script src="{{asset('template/assets/plugins/aos/aos.min.js')}}"></script>
<script>
    AOS.init({
        duration: 700, // values from 0 to 3000, with step 50ms
        once: true
    });
</script>
@endsection
