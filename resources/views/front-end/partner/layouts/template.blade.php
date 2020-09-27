@extends('front-end.partner.layouts.layout')
@section('title','Browser/Page Title Here...')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Page Title Here...',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'BreadCrumbs Title'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
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