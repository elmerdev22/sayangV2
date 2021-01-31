@extends('back-end.layouts.layout')
@section('title','Product - '.$data->product_name.' ')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Products',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Products'],
                ['url' => '', 'label' => $data->product_name],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.products.details.index', ['product_post_id' => $data->product_post_id, 'user_id' => $data->user_id ])
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')
<!-- Countdown JS -->
<script src="{{asset('template/assets/dist/js/countdown.js')}}"></script>
@endsection