@extends('front-end.partner.layouts.layout')
@section('title','Payout - To Pay')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - To Pay',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - To Pay'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('front-end.partner.payout.to-pay.listing')
        </div>
    </div>
@endsection