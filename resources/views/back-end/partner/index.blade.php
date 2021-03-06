@extends('back-end.layouts.layout')
@section('title','Partners')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Partners',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Partners'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.partner.index.listing')
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection