@extends('back-end.layouts.layout')
@section('title','Dashboard')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Dashboard',
            'breadcrumbs' => [
                
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection