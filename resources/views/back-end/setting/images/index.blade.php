@extends('back-end.layouts.layout')
@section('title','Settings')
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/dist/css/custom_inputs.css')}}">
@endsection
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Settings',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Settings'],
                ['url' => '', 'label' => 'Images'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.setting.images.home-carousel-slider.index')
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection