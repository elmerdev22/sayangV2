@extends('back-end.layouts.layout')
@section('title','Catalogs')
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/dist/css/custom_inputs.css')}}">
@endsection
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Catalogs',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Catalogs'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- CONTENT HERE -->
            @livewire('back-end.catalog.edit', ['key_token' => $key_token])
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection