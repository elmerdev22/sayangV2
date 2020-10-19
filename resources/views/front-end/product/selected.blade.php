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
                  <li><img src="{{asset('images/default-photo/product1.jpg')}}" alt="Text" {{-- data-gc-caption="Your caption text"  --}}/></li>
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
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
              <div class="card-footer bg-white card-comments">
                @for ($i = 0; $i < 5; $i++)
                  <div class="post clearfix">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm mr-3" style="width: 50px; height: 50px;" src="{{asset('images/default-photo/elmer.jpg')}}" alt="User Image">
                      <span class="username">
                        <a href="#">Sarah Ross</a>
                        <a href="#" class="float-right btn-tool">3 days ago</a>
                      </span>
                      <span class="description">
                        @php $star = rand(1,5) @endphp
                        @for ($s = 0; $s < $star ; $s++)
                          <span class="fas fa-star text-warning"></span>
                        @endfor
                        @for ($n = $star; $n < 5 ; $n++)
                          <span class="fas fa-star"></span>
                        @endfor
                      </span>
                    </div>
                    <!-- /.user-block -->
                    <p class="w-100">
                      Lorem ipsum represents a long-held tradition for designers,
                      typographers and the like. Some people hate it and argue for
                      its demise, but others ignore the hate as they create awesome
                      tools to help create filler text for everyone from bacon lovers
                      to Charlie Sheen fans.
                    </p>
                    @php $pic = rand(1,5) @endphp
                    @for ($p = 0; $p < $pic ; $p++)
                      <img class="" style="width: auto; height: 50px;" src="{{asset('images/default-photo/product1.jpg')}}" alt="User Image">
                    @endfor

                    <div class="card-footer card-comments mt-3">
                      <div class="replied">
                        <span class="fas fa-reply"></span> Replied
                      </div>
                      <div class="card-comment">
                        <!-- User image -->
                        <img class="img-circle img-sm" src="{{asset('images/default-photo/store.png')}}" alt="store Image">
      
                        <div class="comment-text">
                          <span class="username">
                            Elmer Shop
                            <span class="text-muted float-right">8:03 PM Today</span>
                          </span><!-- /.username -->
                          Thank you! 
                        </div>
                        <!-- /.comment-text -->
                      </div>
                      <!-- /.card-comment -->
                    </div>

                  </div>
                  
                  <!-- /.card-comment -->
                @endfor
                <div class="row float-right mt-3">
                  <ul class="pagination pagination m-0">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <hr>
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
            <img class="card-img-top" src="{{asset('images/default-photo/product1.jpg')}}" alt="Card image cap">
            <span class="ends-in"><div class="countdown text-white"><span class="fas fa-clock"></span> 4 hrs 2 mins</div></span>
            <div class="store-info p-1 mx-1 bg-transparent" style="margin-top: -30px;">
              <div class="row">
                  <div class="col-6 text-white text-left">
                      Elmer shop
                  </div>
                  <div class="col-6 text-right">
                      <span class="fas fa-star text-warning"></span> 
                      <span class="text-white">4.5</span>
                  </div>
              </div>
          </div>
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
