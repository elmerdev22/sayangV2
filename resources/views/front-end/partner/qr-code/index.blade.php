@extends('front-end.partner.layouts.layout')
@section('title','QR Code')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Scan QR Code',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Scan QR Code'],
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
                    <h5 class="card-title"><span class="fas fa-lock"></span> Scan QR-Code</h5> 
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div id="qr-reader" class="w-100"></div>
                            <div id="qr-reader-results"></div>
                            <div id="reader" class="w-100"></div>
                        </div>
                    </div>
                </div> <!-- card-body .// -->
            </div> <!-- card.// -->
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="order-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order No. : 00000123456</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label>Buyer name : Juan Dela Cruz</label>
                        </div>
                        <div class="col-12">
                            <label>Date purchase : October/29/2020</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Products : 3 items</label>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                        </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 3; $i++)
                                            <tr>
                                                <td>Product name</td>
                                                <td>{{number_format(rand(1000,9999),2)}}</td>
                                                <td>{{number_format(rand(1,99),0)}}</td>
                                                <td>{{number_format(rand(1000,9999),2)}}</td>
                                            </tr>
                                        @endfor
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td colspan="1">{{number_format(rand(1000,9999),2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" onclick="confirm()">Confirm Order</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('template/assets/dist/js/html5-qrcode.min.js') }}"></script>
<script type="text/javascript">

    function confirm(){
        $('#order-details').modal("hide");
        Swal.fire({
            icon: 'success',
            title: 'Order Confirmed!',
            text: 'Order no. 000012345 completed.',
        })
    }
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(qrCodeMessage) {
            $('#order-details').modal("show");
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
@endsection