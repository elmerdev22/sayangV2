@extends('front-end.partner.layouts.layout')
@section('title','Payout - To Receive')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - To Receive',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - To Receive'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- @livewire('front-end.partner.payout.to-receive.listing') -->
        </div>
    </div>
@endsection