@extends('front-end.layout')
@section('title','Product Name')
@section('content')
<section class="content-header py-4">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-shopping-cart"></i> My Cart <span class="badge badge-warning badge-pill">3</span>
                </h1>
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
            <div class="card card-sayang">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-shopping-cart">
                        <thead>
                            <tr class="border-bottom">
                                <th scope="col" width="10" class="text-center">
                                    <span class="icheck-warning">
                                        <input type="checkbox" id="check_all">
                                        <label for="check_all"></label>
                                    </span>
                                </th>
                                <th scope="col">PRODUCTS</th>
                                <th scope="col" width="100">QUANTITY</th>
                                <th scope="col" width="100">PRICE</th>
                                <th scope="col" class="text-right" width="100">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border">
                                <td colspan="1">
                                    <span class="icheck-warning">
                                        <input type="checkbox" id="check_store">
                                        <label for="check_store"></label>
                                    </span>
                                </td>
                                <td colspan="4">
                                    <span class="fas fa-store"></span> ELMER SHOP
                                </td>
                            </tr>
                            @for($x=0;$x < 3 ; $x++)
                            <tr>
                                <td class="text-center">
                                    <span class="icheck-warning">
                                        <input type="checkbox" id="check-{{$x}}">
                                        <label for="check-{{$x}}"></label>
                                    </span>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img style="height: 60px; width: auto;" src="{{asset('images/default-photo/product1.jpg')}}" class="img-sm border">
                                        </div>
                                        <div class="col-md-10 text-left">
                                            <p class="title mb-0">Product name goes here </p>
                                            <small class="bg-danger p-1"> <span class="fas fa-clock"></span> 4 hrs 3 mins </small> 
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <select class="form-control form-control-sm" width="20">
                                        <option selected>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                    <span>
                                        <small class="text-muted"> 3 LEFT </small> 
                                    </span>
                                </td>
                                <td>
                                    <div class="price-wrap"> 
                                        <div class="price">₱1,156.00</div> 
                                        <small class="text-muted"> ₱315.20 each </small> 
                                    </div> <!-- price-wrap .// -->
                                </td>
                                <td class="text-right"> 
                                    <a href="" class="btn btn-outline-danger btn-sm"> <span class="fas fa-trash"></span></a> 
                                </td>
                            </tr>
                            @endfor

                            <tr class="border">
                                <td colspan="1">
                                    <span class="icheck-warning">
                                        <input type="checkbox" id="check_store2">
                                        <label for="check_store2"></label>
                                    </span>
                                </td>
                                <td colspan="4">
                                    <span class="fas fa-store"></span> TORRES SHOP
                                </td>
                            </tr>
                            @for($z=0;$z < 3 ; $z++)
                            <tr>
                                <td class="text-center">
                                    <span class="icheck-warning">
                                        <input type="checkbox" id="check2-{{$z}}">
                                        <label for="check2-{{$z}}"></label>
                                    </span>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img style="height: 60px; width: auto;" src="{{asset('images/default-photo/product2.jpg')}}" class="img-sm border">
                                        </div>
                                        <div class="col-md-10 text-left">
                                            <p class="title mb-0">Product name goes here </p>
                                            <small class="bg-danger p-1"> <span class="fas fa-clock"></span> 4 hrs 3 mins </small> 
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <select class="form-control form-control-sm" width="20">
                                        <option selected>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                    <span>
                                        <small class="text-muted"> 3 LEFT </small> 
                                    </span>
                                </td>
                                <td>
                                    <div class="price-wrap"> 
                                        <div class="price">₱1,156.00</div> 
                                        <small class="text-muted"> ₱315.20 each </small> 
                                    </div> <!-- price-wrap .// -->
                                </td>
                                <td class="text-right"> 
                                    <a href="" class="btn btn-outline-danger btn-sm"> <span class="fas fa-trash"></span></a> 
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="card-body border-top">
                    <div class="row cart-footer">
                        <div class="col-sm-6">
                            <a href="/" class="btn btn-default"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{route('account.checkout')}}" class="btn btn-warning text-white float-right"> Make Purchase <i class="fa fa-chevron-right"></i> </a>
                        </div>
                    </div>
                </div>  
            </div> <!-- card.// -->

        </main> <!-- col.// -->

        <aside class="col-md-3">
            <div class="card card-sayang mb-3">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>Get a voucher?</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="" placeholder="Enter code here">
                                <span class="input-group-append"> 
                                <button class="btn btn-warning text-white">Apply</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div> <!-- card-body.// -->
            </div>
            <div class="card card-sayang sticky">
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

  </div> <!-- container .//  -->
</section>
@endsection
