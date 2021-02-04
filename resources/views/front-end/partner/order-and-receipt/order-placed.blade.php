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
            @livewire('front-end.partner.order-and-receipt.order-placed.index')
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-cancel_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @livewire('front-end.partner.order-and-receipt.track.cancel-order')
                </div>
            </div>
        </div>
    </div>
@endsection