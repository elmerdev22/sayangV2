@extends('front-end.partner.layouts.layout')
@section('title','Orders & Receipts')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Orders & Receipts',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Orders & Receipts'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('front-end.partner.order-and-receipt.to-receive.index')
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-order_items" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order No. : <span id="modal-order_no"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    @livewire('front-end.partner.order-and-receipt.order-items.index')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection