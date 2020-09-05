@extends('front-end.layout')
@section('title','Product Name')
@section('content')

<section class="content-header py-4">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-shopping-cart"></i> My Cart <small>(22)</small></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">My Cart</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content pb-5">
    
  <div class="container">

    <div class="row">
      <main class="col-md-9">
        <div class="card">
          <table class="table table-borderless table-shopping-cart">
          <thead >
            <tr>
              <th scope="col">Product/Items</th>
              <th scope="col" width="100">Quantity</th>
              <th scope="col" width="100">Price</th>
              <th scope="col" class="text-right" width="100">Remove</th>
            </tr>
          </thead>
          <tbody>
            @for($x=0;$x < 3 ; $x++)
            <tr>
              <td>
                <figure class="itemside">
                  <div class="aside"><img src="{{asset('images/default-photo/prod1.jpg')}}" class="img-md mr-2"></div>
                  <figcaption class="info ml-2">
                    <a href="#" class="title text-dark">Some name of item goes here nice</a>
                    <p class="text-muted small">Category: Foods</p>
                  </figcaption>
                </figure>
              </td>
              <td> 
                <select class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                </select>
                {{-- <input type="number" name="" class="form-control" value="2" min="1"> --}}
              </td>
              <td> 
                <div class="price-wrap"> 
                  <span class="price">₱1156.00</span> 
                  <small class="text-muted"> ₱315.20 each </small> 
                </div> <!-- price-wrap .// -->
              </td>
              <td class="text-right"> 
              
              <a href="" class="btn btn-outline-danger"> <span class=" fas fa-trash"></span></a>
              </td>
            </tr>
            @endfor
          </tbody>
          </table>
          <div class="row justify-content-center mb-3">
            <ul class="pagination pagination m-0 float-right">
              <li class="page-item"><a class="page-link" href="#">«</a></li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
          </div>
          <div class="card-body border-top">
            <a href="#" class="btn btn-warning  text-white float-md-right"> Make Purchase <i class="fa fa-chevron-right"></i> </a>
            <a href="/" class="btn btn-default"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
          </div>  
        </div> <!-- card.// -->

        </main> <!-- col.// -->

        <aside class="col-md-3">
          <div class="card mb-3">
            <div class="card-body">
            <form>
              <div class="form-group">
                <label>Have coupon?</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="" placeholder="Coupon code">
                  <span class="input-group-append"> 
                    <button class="btn btn-warning text-white">Apply</button>
                  </span>
                </div>
              </div>
            </form>
            </div> <!-- card-body.// -->
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <dt>Total price:</dt>
                </div>
                <div class="col-6">
                  <dd class="text-right">PHP 2,000</dd>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <dt>Discount:</dt>
                </div>
                <div class="col-6">
                  <dd class="text-right">PHP 200</dd>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <dt>Total:</dt>
                </div>
                <div class="col-6">
                  <dd class="text-right h5"><strong>₱1,800</strong></dd>
                </div>
              </div>
              <hr>
              <p class="text-center mb-3">
                <img src="{{asset('images/default-photo/payments.png')}}" height="26">
                {{-- <span class="fab fa-cc-visa fa-2x"></span>
                <span class="fab fa-cc-stripe fa-2x"></span>
                <span class="fab fa-cc-paypal fa-2x"></span>
                <span class="fab fa-cc-mastercard fa-2x"></span>
                <span class="fab fa-cc-amex fa-2x"></span> --}}
              </p>  
            </div> <!-- card-body.// -->
          </div>  <!-- card .// -->
        </aside> <!-- col.// -->
    </div>

    <div class="mt-4">
      @livewire('front-end.button')
    </div>
  </div> <!-- container .//  -->
</section>

<section class="section-content padding-y">
<div class="container">

<div class="row">
  <aside class="col-md-3">
    
<div class="card">
  <article class="filter-group">
    <header class="card-header border-top">
      <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="text-dark">
        
        <h6 class="title"><span class="fa fa-chevron-down"></span> Product type</h6>
      </a>
    </header>
    <div class="filter-content collapse show" id="collapse_1" style="">
      <div class="card-body">
        <form class="pb-3">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search">
          <div class="input-group-append">
            <button class="btn btn-warning" type="button"><i class="fa fa-search"></i></button>
          </div>
        </div>
        </form>
        
        <ul class="list-menu">
        <li><a href="#">People  </a></li>
        <li><a href="#">Watches </a></li>
        <li><a href="#">Cinema  </a></li>
        <li><a href="#">Clothes  </a></li>
        <li><a href="#">Home items </a></li>
        <li><a href="#">Animals</a></li>
        <li><a href="#">People </a></li>
        </ul>

      </div> <!-- card-body.// -->
    </div>
  </article> <!-- filter-group  .// -->
  <article class="filter-group">
    <header class="card-header border-top">
      <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="text-dark">
        <h6 class="title"><span class="fa fa-chevron-down"></span> Brands</h6>
      </a>
    </header>
    <div class="filter-content collapse show" id="collapse_2" style="">
      <div class="card-body">
        <label class="custom-control custom-checkbox">
          <input type="checkbox" checked="" class="custom-control-input">
          <div class="custom-control-label">Mercedes  
            <b class="badge badge-pill badge-warning float-right">120</b>  </div>
        </label>
        <label class="custom-control custom-checkbox">
          <input type="checkbox" checked="" class="custom-control-input">
          <div class="custom-control-label">Toyota 
            <b class="badge badge-pill badge-warning float-right">15</b>  </div>
        </label>
        <label class="custom-control custom-checkbox">
          <input type="checkbox" checked="" class="custom-control-input">
          <div class="custom-control-label">Mitsubishi 
            <b class="badge badge-pill badge-warning float-right">35</b> </div>
        </label>
        <label class="custom-control custom-checkbox">
          <input type="checkbox" checked="" class="custom-control-input">
          <div class="custom-control-label">Nissan 
            <b class="badge badge-pill badge-warning float-right">89</b> </div>
        </label>
        <label class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input">
          <div class="custom-control-label">Honda 
            <b class="badge badge-pill badge-warning float-right">30</b>  </div>
        </label>
  </div> <!-- card-body.// -->
    </div>
  </article> <!-- filter-group .// -->
  <article class="filter-group">
    <header class="card-header border-top">
      <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="text-dark">
        <h6 class="title"><span class="fa fa-chevron-down"></span> Price Range</h6>
      </a>
    </header>
    <div class="filter-content collapse show" id="collapse_3" style="">
      <div class="card-body">
        <input type="range" class="custom-range" min="0" max="100" name="">
        <div class="form-row">
        <div class="form-group col-md-6">
          <label>Min</label>
          <input class="form-control" placeholder="₱0" type="number">
        </div>
        <div class="form-group text-right col-md-6">
          <label>Max</label>
          <input class="form-control" placeholder="₱1,0000" type="number">
        </div>
        </div> <!-- form-row.// -->
        <button class="btn btn-block btn-warning">Apply</button>
      </div><!-- card-body.// -->
    </div>
  </article> <!-- filter-group .// -->
  <article class="filter-group">
    <header class="card-header border-top">
      <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true" class="text-dark">
        <h6 class="title"><span class="fa fa-chevron-down"></span> Sizes</h6>
      </a>
    </header>
    <div class="filter-content collapse show" id="collapse_4" style="">
      <div class="card-body">
        <label class="checkbox-btn p-2">
          <input type="checkbox">
          <span class="btn btn-warning btn-sm"> XS </span>
        </label>

        <label class="checkbox-btn p-2">
          <input type="checkbox">
          <span class="btn btn-warning btn-sm"> SM </span>
        </label>

        <label class="checkbox-btn p-2">
          <input type="checkbox">
          <span class="btn btn-warning btn-sm"> LG </span>
        </label>

        <label class="checkbox-btn p-2">
          <input type="checkbox">
          <span class="btn btn-warning btn-sm"> XXL </span>
        </label>
    </div><!-- card-body.// -->
    </div>
  </article> <!-- filter-group .// -->
  <article class="filter-group">
    <header class="card-header border-top">
      <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" class="text-dark">
        <h6 class="title"><span class="fa fa-chevron-down"></span> More Filter</h6>
      </a>
    </header>
    <div class="filter-content in collapse" id="collapse_5" style="">
      <div class="card-body">
        <label class="custom-control custom-radio">
          <input type="radio" name="myfilter_radio" checked="" class="custom-control-input">
          <div class="custom-control-label">Any condition</div>
        </label>

        <label class="custom-control custom-radio">
          <input type="radio" name="myfilter_radio" class="custom-control-input">
          <div class="custom-control-label">Brand new </div>
        </label>

        <label class="custom-control custom-radio">
          <input type="radio" name="myfilter_radio" class="custom-control-input">
          <div class="custom-control-label">Used items</div>
        </label>

        <label class="custom-control custom-radio">
          <input type="radio" name="myfilter_radio" class="custom-control-input">
          <div class="custom-control-label">Very old</div>
        </label>
      </div><!-- card-body.// -->
    </div>
  </article> <!-- filter-group .// -->
</div> <!-- card.// -->

</aside> <!-- col.// -->

  <main class="col-md-9">

    <header class="border-bottom mb-4 pb-3">
        <div class="form-inline">
          <span class="mr-md-auto">32 Items found </span>
          <select class="mr-2 form-control">
            <option>Latest items</option>
            <option>Trending</option>
            <option>Most Popular</option>
            <option>Cheapest</option>
          </select>
          <div class="btn-group">
            <a href="#" class="btn btn-outline-warning active" data-toggle="tooltip" title="" data-original-title="List view"> 
              <i class="fa fa-bars"></i></a>
            <a href="#" class="btn  btn-outline-warning" data-toggle="tooltip" title="" data-original-title="Grid view"> 
              <i class="fa fa-th"></i></a>
          </div>
        </div>
    </header><!-- sect-heading -->

    @for($x=0;$x<5;$x++)
      <article class="card card-product-list">
        <div class="row no-gutters p-2">
          <aside class="col-3">
            <a href="#" class="img-wrap">
              <img class="card-img-top" src="{{asset('images/default-photo/w2.jpg')}}" alt="Card image cap">
              <span class="ends-in"><div class="countdown text-white"><span class="fas fa-clock"></span> 4 hrs 2 mins</div></span>
            </a>
          </aside> <!-- col.// -->
          <div class="col-6 pl-3">
            <div class="info-main">
              <a href="#" class="h5 title"> Great product name goes here  </a>
              <div class="rating-wrap mb-3">
                <p>Gordon Ramcey <span class="fas fa-star text-warning"></span> 4.5</p>
              </div> <!-- rating-wrap.// -->
              
              <p> Take it as demo specs, ipsum dolor sit amet, consectetuer adipiscing elit, Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Ut wisi enim ad minim veniam </p>
            </div> <!-- info-main.// -->
          </div> <!-- col.// -->
          <aside class="col-3">
            <div class="info-aside">
              <p class="text-danger">3 LEFT!</p>
              <p>
                <a href="{{route('selected.product', ['slug' => 'Product-name'])}}">
                  <button class="btn btn-sm btn-dark item-btn">
                    <span class="font-weight-bold">Buy Now</span><br>
                    <small class="text-white item-info">Php: 40.00 | 30%off</small>
                  </button>
                </a>
                <a href="{{route('selected.product', ['slug' => 'Product-name'])}}">
                  <button class="btn btn-sm btn-outline-warning text-dark item-btn">
                  <span class="font-weight-bold">Place Bid</span><br>
                  <small class="item-info">Bids: 5 | Top: 250.00</small>
                  </button>
                </a>
              </p>
            </div> <!-- info-aside.// -->
          </aside> <!-- col.// -->
        </div> <!-- row.// -->
      </article> <!-- card-product .// -->
    @endfor
    <nav aria-label="Page navigation sample">
      <div class="row justify-content-center">
        <ul class="pagination">
          <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">»</a></li>
      </ul>
      </div>
    </nav>

  </main> <!-- col.// -->

</div>

</div> <!-- container .//  -->
</section>
@endsection
