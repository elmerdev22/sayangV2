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
                <strong class="d-inline-block mr-3">Order ID: {{$order_no}} </strong>
                <span>Order Date: {{date('F/d/Y', strtotime($order_date))}}</span>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @livewire('front-end.user.my-purchase.track.status', ['order_no' => $order_no])
                    </div>
                </div>
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
    </main> <!-- col.// -->
</div>

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
@endsection
@section('js')

@endsection