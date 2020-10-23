@extends('front-end.partner.layouts.layout')
@section('title','Order - {order_id}')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Order Information',
            'breadcrumbs' => [
                ['url' => route('front-end.partner.order-and-receipt.index'), 'label' => 'Orders & Receipts'],
                ['url' => '', 'label' => 'Order #{order_id}'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title">Order #{order_id}</h5> 
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
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
                        <div class="col-12">
                            View Invoice : <a class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#invoice"><span class=" fas fa-file-invoice"></span></a>
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
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order ID : 00001234567</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                                    <small class="float-right">Date: 2/10/2014</small>
                                </h4>
                            </div>
                        <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>Admin, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    Phone: (804) 123-5432<br>
                                    Email: info@almasaeedstudio.com
                                </address>
                            </div>
                        <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                <strong>John Doe</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    Phone: (555) 539-1037<br>
                                    Email: john.doe@example.com
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #007612</b><br>
                                <br>
                                <b>Order ID:</b> 4F3S8J<br>
                                <b>Payment Due:</b> 2/22/2014<br>
                                <b>Account:</b> 968-34567
                            </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
        
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product</th>
                                            <th>Serial #</th>
                                            <th>Description</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Call of Duty</td>
                                            <td>455-981-221</td>
                                            <td>El snort testosterone trophy driving gloves handsome</td>
                                            <td>$64.50</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Need for Speed IV</td>
                                            <td>247-925-726</td>
                                            <td>Wes Anderson umami biodiesel</td>
                                            <td>$50.00</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Monsters DVD</td>
                                            <td>735-845-642</td>
                                            <td>Terry Richardson helvetica tousled street art master</td>
                                            <td>$10.70</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Grown Ups Blue Ray</td>
                                            <td>422-568-642</td>
                                            <td>Tousled lomo letterpress</td>
                                            <td>$25.99</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
        
                        <div class="row">
                        <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Payment Methods:</p>
                                <img src="{{asset('images/default-photo/payments.png')}}" alt="Visa">
            
                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                plugg
                                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                </p>
                            </div>
                        <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Amount Due 2/22/2014</p>
            
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>$250.30</td>
                                            </tr>
                                            <tr>
                                                <th>Tax (9.3%)</th>
                                                <td>$10.34</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td>$5.80</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>$265.24</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
        
                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="#" target="_blank" class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-danger float-right"><i class="far fa-credit-card"></i>
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">

</script>
@endsection