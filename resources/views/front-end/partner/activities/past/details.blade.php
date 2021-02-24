@extends('front-end.partner.layouts.layout')
@section('title','Activities')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Activities',
            'breadcrumbs' => [
                ['url' => 'javascript:void(0);', 'label' => 'Activities'],
                ['url' => '', 'label' => 'View Product Post'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @livewire('front-end.partner.activities.past.details', ['product_post_id' => $product_post_id])
    </div>
</div>

@endsection
@section('js')
<!-- Countdown JS -->
<script src="{{asset('template/assets/dist/js/countdown.js')}}"></script>
@endsection