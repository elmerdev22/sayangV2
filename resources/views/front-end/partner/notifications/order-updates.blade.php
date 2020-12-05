@extends('front-end.partner.layouts.layout')
@section('title','Notifications - Order Updates')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Notifications',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Notifications'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('front-end.partner.notifications.order-updates')
        </div>
    </div>
@endsection