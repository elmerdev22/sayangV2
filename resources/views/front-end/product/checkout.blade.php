@extends('front-end.layout')
@section('title','Product Name')
@section('content')

<section class="content-header py-4">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Checkout</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content pb-5">
    
  <div class="container">

    <div class="row">
        <main class="col-md-8">
            <form>
                <h4 class="mb-3"><i class="fas fa-file-invoice"></i> Billing address</h4>
                <div class="card card-sayang">
                    <div class="card-body">
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>
                    
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="text" class="form-control" id="username" placeholder="Username" required>
                                    <div class="invalid-feedback" style="width: 100%;">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>
                    
                            <div class="mb-3">
                                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                    
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                    
                            <div class="mb-3">
                                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                            </div>
                    
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country</label>
                                    <select class="custom-select d-block w-100" id="country" required>
                                        <option value="">Choose...</option>
                                        <option>United States</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">State</label>
                                    <select class="custom-select d-block w-100" id="state" required>
                                        <option value="">Choose...</option>
                                        <option>California</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" id="zip" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">
                                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next time</label>
                            </div>
                            <hr class="mb-4">
                    
                        
                            <h4 class="mb-3">Payment Options</h4>
                            <img src="{{asset('images/default-photo/payments.png')}}" height="26">
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Credit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="debit">Debit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="paypal">PayPal</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                    <small class="text-muted">Full name as displayed on card</small>
                                    <div class="invalid-feedback">
                                        Name on card is required
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Credit card number is required
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Expiration date required
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-cvv">CVV</label>
                                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Security code required
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <button class="btn btn-warning btn-block" type="button" data-toggle="modal" data-target="#qrcode">Continue to checkout</button>
                        </form> 
                    </div>
                </div> <!-- card.// -->
            </form>
        </main> <!-- col.// -->

        <aside class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span>
                    <i class="fas fa-shopping-cart"></i> My Cart 
                    <span class="badge badge-warning badge-pill">3</span>
                </span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">₱315.20 x 5</small>
                    </div>
                    <span>₱236.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Second product</h6>
                        <small class="text-muted">₱315.20 x 5</small>
                    </div>
                    <span>₱546.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Third item</h6>
                        <small class="text-muted">₱315.20 x 5</small>
                    </div>
                    <span>₱1,156.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-dark">
                        <h6 class="my-0">Voucher code</h6>
                        <small>EXAMPLECODE</small>
                    </div>
                    <span class="text-dark">-₱50</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>TOTAL (PHP)</span>
                    <strong>₱4,216.00</strong>
                </li>
            </ul>
      
            <form class="card p-2">
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
            </form>
        </aside> <!-- col.// -->
    </div>

  </div> <!-- container .//  -->
</section>

<!-- Modal -->
<div class="modal fade" id="qrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order ID : 00001234567</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="row pb-2">
                    <div class="col-12">
                        <h4>Purchased Completed!</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {!! QrCode::size(200)->generate('Elmer Lang Malakas!'); !!}
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-12">
                        <a href="{{route('front-end.user.my-purchase.orders')}}" class=""><u>Go to my purchased</u> </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection
