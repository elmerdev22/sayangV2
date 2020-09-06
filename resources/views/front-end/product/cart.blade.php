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
          <div class="table-responsive">
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
                    <div class="aside cart-img"><img src="{{asset('images/default-photo/prod1.jpg')}}" class="img-md mr-2"></div>
                    <figcaption class="info ml-2">
                      <a href="#" class="title text-dark">Some name of item goes here nice</a>
                      <p class="text-muted small">Category: Foods</p>
                    </figcaption>
                  </figure>
                </td>
                <td> 
                  {{-- <select class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                  </select> --}}
                  <input type="number" name="" class="form-control" value="2" min="1">
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
          </div>
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
            <div class="row cart-footer">
              <div class="col-sm-6">
                <a href="/" class="btn btn-default"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
              </div>
              <div class="col-sm-6">
                <a href="#" class="btn btn-warning text-white float-right"> Make Purchase <i class="fa fa-chevron-right"></i> </a>
              </div>
            </div>
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
@endsection
