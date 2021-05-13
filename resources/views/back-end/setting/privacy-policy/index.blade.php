@extends('back-end.layouts.layout')
@section('title','Settings')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Settings',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Settings'],
                ['url' => '', 'label' => 'Privacy Policy'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/plugins/summernote/summernote-bs4.css')}}">    
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.setting.privacy-policy.index')
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')
<script src="{{asset('template/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
@endsection