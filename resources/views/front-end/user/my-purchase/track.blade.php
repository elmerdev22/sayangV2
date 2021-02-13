@extends('front-end.layout')
@section('title', 'Purchase: '.$order_no)
@section('page_header')
    @php 
        $page_header = [
            'title'       => $order_no,
            'breadcrumbs' => [
                ['url' => route('front-end.user.my-purchase.list'), 'label' => 'Purchase List'],
                ['url' => '', 'label' => $order_no],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')

<section class="section-content padding-y bg">
    <div class="container">
        <!-- =========================  COMPONENT MY PROFILE ========================= --> 
        <div class="row">
            <aside class="col-md-3">
                <!--   SIDEBAR   -->
                @include('front-end.includes.user.sidebar')
                <!--   SIDEBAR .//END   -->
            </aside>
            <main class="col-md-9">
                <div class="card">
                    <header class="card-header">
                        <strong class="d-inline-block mr-3">Order ID: {{$order_no}} </strong>
                        @if($order->status == 'completed')
                            <span>Completed Date: {{date('F/d/Y h:i A', strtotime($order->date_completed))}}</span>
                        @else
                            <span>Order Date: {{date('F/d/Y h:i A', strtotime($order_date))}}</span>
                        @endif
                    </header>
                    <div class="card-body">
                        @if($order->status != 'cancelled')
                            <div class="row">
                                <div class="col-12">
                                    @livewire('front-end.user.my-purchase.track.status', ['order_no' => $order_no])
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                @livewire('front-end.user.my-purchase.track.information', ['order_no' => $order_no])
                            </div>
                        </div>
                        <div class="row mt-2 pt-2 border">
                            <div class="col-12">
                                @livewire('front-end.user.my-purchase.track.item', ['order_no' => $order_no])
                            </div>
                        </div>
                    </div> <!-- card-body .// -->
                </div> <!-- card.// --> 
            </main>
        </div> <!-- row.// -->
        <!-- =========================  COMPONENT MY PROFILE.// ========================= --> 
    </div> <!-- container .//  -->
</section>
<!-- Modal -->
<div class="modal fade" id="modal-qr_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order No. : <span id="modal-qr_code_order_no"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @livewire('front-end.user.my-purchase.qr-code')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@if($order->status == 'completed')
    <!-- Modal -->
    <div class="modal fade" id="modal-invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order No. : {{$order->order_no}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('front-end.user.my-purchase.track.invoice', ['order_no' => $order_no])
                </div>
            </div>
        </div>
    </div>
@endif

@if($order->status == 'order_placed')
    <!-- Modal -->
    <div class="modal fade" id="modal-cancel_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @livewire('front-end.user.my-purchase.track.cancel-order', ['order_no' => $order_no])
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-pay_now" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Payment Method</h4>
                </div>
                <div class="modal-body">
                    <div class="card box-shadow-none" id="card-payment_method">
                        <div class="card-body p-0">
                            @livewire('front-end.user.my-purchase.track.pay-now', ['order_no' => $order_no])
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-payment_3d_secure" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" id="modal-payment_3rd_secure_iframe">
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" href="{{route('front-end.user.my-purchase.track', ['id' => $order->order_no])}}">Cancel Payment</a>
                </div> 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endif

@endsection
@section('js')
    <script type="text/javascript">
        @if(Session::has('checkout_payment'))
            @php $checkout_status = Session::get('checkout_payment'); @endphp
            @if($checkout_status['success'])
                var config = {
                    position : 'center',
                    icon     : 'success',
                    title    : 'Order Successfully Processed'
                };
                Swal.fire(config);
            @else
                var config = {
                    position: 'center',
                    icon    : 'error',
                    title   : 'Order Failed To Process.',
                    html    : "{{$checkout_status['message']}}"
                };
                Swal.fire(config);
            @endif
        @endif
    </script>
    @if($order->status == 'completed')
        <script src="{{asset('template/assets/dist/js/window-document.js')}}"></script>
        <script type="text/javascript">
            $(function (){
                $(document).on('click', '.btn-print-invoice', function (){
                    var url     = "{{route('front-end.print-preview.invoice.index', ['invoice_no' => '|invoice_no|'])}}";
                        url     = url.replace('|invoice_no|', $(this).data('invoice_no'));
                    var filters = {};
                    window_frame(filters, url, 'Print Invoice: '+$(this).data('invoice_no'));
                });
            });
        </script>
    @endif
@endsection