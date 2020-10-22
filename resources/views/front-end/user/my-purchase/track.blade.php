@extends('front-end.layout')
@section('title','Order number')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Order number',
            'breadcrumbs' => [
                ['url' => route('front-end.user.my-purchase.list'), 'label' => 'Purchase List'],
                ['url' => '', 'label' => 'Order number'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
          
<div class="row">
    <aside class="col-md-3">
        <!-- menu -->
        <div id="MainMenu">
            @include('front-end.includes.user.sidebar')
        </div>
    </aside> <!-- col.// -->
    <main class="col-md-9">
        <div class="card card-outline card-sayang mb-3">
            <header class="card-header">
                <strong class="d-inline-block mr-3">Order ID: 6123456789 </strong>
                <span>Order Date: 16 December 2018</span>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="track w-100">
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                    </div>
                </div>
                <div class="row border p-2 pt-4"> 
                    <div class="col-md-8">
                        <h6 class="text-muted">Delivery to</h6>
                        <p>Michael Jackson <br>  
                        Phone +1234567890 Email: myname@pixsellz.com <br>
                        Location: Home number, Building name, Street 123,  Tashkent, UZB <br> 
                        P.O. Box: 100123
                            </p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Payment</h6>
                        <span class="text-success">
                            <i class="fab fa-lg fa-cc-visa"></i>
                            Visa  **** 4216  
                        </span>
                        <p>Subtotal: ₱1506.00 <br>
                            Shipping fee:  ₱50.00 <br> 
                            <span class="b">Total:  ₱2900.00 </span>
                        </p>
                    </div>
                    <div class="col-md-12">
                        QR Code : <a class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#qrcode"><span class=" fas fa-qrcode"></span></a>
                    </div>
                </div> <!-- row.// -->
            </div> <!-- card-body .// -->
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                @for ($i = 0; $i < 3; $i++)
                                    <tr>
                                        <td width="60">
                                            <img style="height: 50px; width: auto;" src="{{asset('images/default-photo/product1.jpg')}}" class="img-sm border">
                                        </td>
                                        <td> 
                                            <p class="title mb-0">Product name goes here </p>
                                            <small class="price text-muted">₱315.20 x 5</small>
                                        </td>
                                        <td> ₱236.00 </td>
                                        <td width="250"> 
                                            <a href="#" class="btn btn-warning btn-sm">Details</a> 
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div> <!-- table-responsive .end// -->
                </div>
            </div>
        </div> <!-- card.// --> 
    </main> <!-- col.// -->
</div>

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
                {!! QrCode::size(200)->generate('Elmer Lang Malakas!'); !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection