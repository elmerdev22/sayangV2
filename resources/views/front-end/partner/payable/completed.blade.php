@extends('front-end.partner.layouts.layout')
@section('title','Payout - Completed')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - Completed',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - Completed'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('messenger')
   @include('front-end.includes.messenger') 
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('front-end.partner.payable.completed.receivable-listing')
            @livewire('front-end.partner.payable.completed.payable-listing')
        </div>
    </div>
@endsection