@extends('front-end.layout')
@section('title','Product Name')
@section('content')
@section('css')
<!-- Glasscase css-->
<link rel="stylesheet" href="{{asset('template/assets/dist/css/glasscase.min.css')}}">
@endsection
<section class="content pb-5">
  <div class="container my-5">
    <!-- Default box -->
    <div class="card border-0 shadow-none">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-12 col-md-7">
            <div class="col-12">
              <ul id="glasscase" class="gc-start">
                  <li><img src="{{asset('images/default-photo/prod2.jpg')}}" alt="Text" {{-- data-gc-caption="Your caption text"  --}}/></li>
                  <li><img src="{{asset('images/default-photo/prod1.jpg')}}" alt="Text" /></li>
              </ul>
            </div>
            <div class="col-12">
              <h5 class="pt-3">Few Reminders</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem.  Aliquam erat volutpat. Donec placerat nisl magna, et faucibus arcu condimentum sed.</p>
            </div>
          </div>
          <div class="col-12 col-md-5">
            <div class="row">
              <div class="col-lg-8">
                <h3 class="my-2">LOWA Men’s Renegade Boots</h3>
              </div>
              
              <div class="col-lg-4">
                <h3 class="my-2 text-danger float-right">3 LEFT!</h3>
              </div>

            </div>

            <a href="{{url('/profile/partner-name')}}">
              <p>Gordon Ramcey <span class="fas fa-star text-warning"></span> 4.5</p>
            </a>
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
            <div class="bg-danger p-2 w-50 text-center">
              <span class="fas fa-clock"></span> 4 hrs 3 mins
            </div>
            <hr>

            <div class="card text-center">
              @livewire('front-end.product.details')
            </div>
        
          </div>
        </div>
        <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Partner Ratings</a>
              <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">About Product</a>
              <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Other details</a>
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus. </div>
            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>


  <div class="container">
    <div class="row">
      <div class="col-12 mb-3">
        <h2 class="title" data-aos="fade-right">MORE LIKE THIS</h2>
      </div>
    </div>
    <div class="row">
      @for($x=0;$x < 4; $x++)
      <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up">
        <div class="card mb-4 product-card">
          <div style="width:100%; text-align:center">
            <img class="card-img-top" src="{{asset('images/default-photo/w2.jpg')}}" alt="Card image cap">
            <span class="ends-in"><div class="countdown text-white"><span class="fas fa-clock"></span> 4 hrs 2 mins</div></span>
            {{-- <div class="store-info p-1 bg-light">
                <div class="row">
                    <div class="col-6">
                        Elmer shop
                    </div>
                    <div class="col-6">
                        <span class="fas fa-star text-warning"></span> 4.5
                    </div>
                </div>
            </div> --}}
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
</section>
@endsection
@section('js')
<!-- Glasscase -->
<script src="{{asset('template/assets/dist/js/glasscase.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready( function () {
        //If your <ul> has the id "glasscase"
        $('#glasscase').glassCase({ 'thumbsPosition': 'bottom'});
    });
</script>
@endsection
