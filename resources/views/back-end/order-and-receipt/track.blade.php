@extends('back-end.layouts.layout')
@section('title','Order - '.$order->order_no)
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Orders Information',
            'breadcrumbs' => [
                ['url' => route('back-end.order-and-receipt.index'), 'label' => 'Orders & Receipts'],
                ['url' => '', 'label' => 'Order #'.$order->order_no],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-sayang mb-3">
            <header class="card-header">
                <strong class="d-inline-block mr-3">Order ID: {{$order->order_no}} </strong>
                @if($order->status == 'completed')
                    <span>Completed Date: {{date('F/d/Y', strtotime($order->date_completed))}}</span>
                @else
                    <span>Order Date: {{date('F/d/Y', strtotime($order->created_at))}}</span>
                @endif
            </header>
            <div class="card-body">
                @if($order->status != 'cancelled')
                    <div class="row">
                        <div class="col-12">
                            @livewire('back-end.order-and-receipt.track.status', ['order_no' => $order->order_no])
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        @livewire('back-end.order-and-receipt.track.information', ['order_no' => $order->order_no])
                    </div>
                </div>
                <div class="row mt-2 pt-2 border">
                    <div class="col-12">
                        @livewire('back-end.order-and-receipt.track.item', ['order_no' => $order->order_no])
                    </div>
                </div>
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </div>
</div>
<!-- 
    NOTE: Always wrap the content in .row > .col-* 
-->
    
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
                @livewire('back-end.order-and-receipt.track.qr-code')
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
                    @livewire('back-end.order-and-receipt.track.invoice', ['order_no' => $order->order_no])
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
@section('js')
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