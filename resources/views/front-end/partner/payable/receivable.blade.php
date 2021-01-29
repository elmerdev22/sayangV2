@extends('front-end.partner.layouts.layout')
@section('title','Payout - Receivable')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - Receivable',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - Receivable'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('front-end.partner.payable.receivable.pending')
            @livewire('front-end.partner.payable.receivable.listing')
        </div>
    </div>
@endsection