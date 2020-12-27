@extends('back-end.layouts.layout')
@section('title','Products')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Products',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Products'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.products.index.listing')
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection