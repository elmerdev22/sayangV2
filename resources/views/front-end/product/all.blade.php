@extends('front-end.layout')
@section('title','Product Name')
@section('content')

<section class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Products</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
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

      <header class="border-bottom border-top mb-4 py-3">
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

      @for($x=0;$x<4;$x++)
        <article class="card card-product-list">
          <div class="row no-gutters p-2">
            <aside class="col-5">
              <a href="#" class="img-wrap">
                <img class="card-img-top" src="{{asset('images/default-photo/w2.jpg')}}" alt="Card image cap">
                <span class="ends-in"><div class="countdown text-white"><span class="fas fa-clock"></span> 4 hrs 2 mins</div></span>
              </a>
            </aside> <!-- col.// -->
            <div class="col-7 pl-3">
              <div class="info-main">
                <div class="row">
                    <div class="col-6 font-weight-bold text-left">
                        <span class="h5 title">COCONUT OIL</span>
                    </div>
                    <div class="col-6 text-right">
                        <p class="text-danger">3 LEFT!</p>
                    </div>
                </div>
                
                <div class="rating-wrap mb-3">
                  <a href="{{url('/merchant/profile')}}">
                    <p>Gordon Ramcey <span class="fas fa-star text-warning"></span> 4.5</p>
                  </a>
                </div> <!-- rating-wrap.// -->
                
                <p> Take it as demo specs, ipsum dolor sit amet, consectetuer adipiscing elit, Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Ut wisi enim ad minim veniam... </p>
                <div class="row">
                  <div class="col-md-6">
                    <a href="{{route('selected.product', ['slug' => 'product-name'])}}">
                      <button class="btn btn-sm btn-dark item-btn">
                        <span class="font-weight-bold">Buy Now</span><br>
                        <small class="text-white item-info">Php: 40.00 | 30%off</small>
                      </button>
                    </a>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('selected.product', ['slug' => 'Product-name'])}}">
                      <button class="btn btn-sm btn-outline-warning text-dark item-btn">
                      <span class="font-weight-bold">Place Bid</span><br>
                      <small class="item-info">Bids: 5 | Top: 250.00</small>
                      </button>
                    </a>
                  </div>
                </div>
              </div> <!-- info-main.// -->
            </div> <!-- col.// -->
            {{-- <aside class="col-3">
              <div class="info-aside">
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
            </aside> --}} <!-- col.// -->
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
