@extends('front-end.layout')
@section('title','My Cart')
@section('page_header')
    @php 
        $page_header = [
            'title'       => '<i class="fas fa-shopping-cart"></i> My Cart <span class="badge badge-warning badge-pill badge-total-item-in-cart">'.Utility::total_cart_item().'</span>',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'My Cart'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')

<div class="container">
    <div class="row">
        <main class="col-md-9">
            <div class="card card-sayang">
                <div class="table-responsive">
                    @livewire('front-end.user.my-cart.index.listing')
                </div>
                <div class="card-body border-top">
                    <div class="row cart-footer">
                        <div class="col-sm-6">
                            <a href="/" class="btn btn-default"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
                        </div>
                        <div class="col-sm-6">
                            {{-- <a href="{{route('account.checkout')}}" class="btn btn-warning text-white float-right"> Make Purchase <i class="fa fa-chevron-right"></i> </a> --}}
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
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="{{route('account.checkout')}}" class="btn btn-warning w-100"> Check Out </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">
                            <img src="{{asset('images/default-photo/payments.png')}}" height="26">
                                {{-- <span class="fab fa-cc-visa fa-2x"></span>
                                <span class="fab fa-cc-stripe fa-2x"></span>
                                <span class="fab fa-cc-paypal fa-2x"></span>
                                <span class="fab fa-cc-mastercard fa-2x"></span>
                                <span class="fab fa-cc-amex fa-2x"></span> --}}
                            </p>  
                        </div>
                    </div>
                </div> <!-- card-body.// -->
            </div>  <!-- card .// -->
        </aside> <!-- col.// -->
    </div>
</div>

@endsection
