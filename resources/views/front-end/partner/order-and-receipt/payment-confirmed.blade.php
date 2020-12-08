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
            @livewire('front-end.partner.order-and-receipt.payment-confirmed.index')
        </div>
    </div>
@endsection