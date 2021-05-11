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
                ['url' => '', 'label' => 'Home Page'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.setting.home.advocacy-section.index')
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.setting.home.advocacy-section2.index')
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.setting.home.featured-partners.index')
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.setting.home.become-a-partner-section.index')
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection