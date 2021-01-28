@extends('front-end.partner.layouts.layout')
@section('title','Payout - Payable')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - Payable',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - Payable'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('front-end.partner.payable.payable.listing')
        </div>
    </div>
@endsection