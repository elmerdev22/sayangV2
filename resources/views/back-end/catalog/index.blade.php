@extends('back-end.layouts.layout')
@section('title','Catalogs')
@section('css')
<!-- Dropify -->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/plugins/dropify/dist/css/dropify.min.css') }}"> --}}
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
    <div class="row">
        <div class="col-md-4">
            <!-- CONTENT HERE -->
            @livewire('back-end.catalog.form')
        </div>
        <div class="col-md-8">
            <!-- CONTENT HERE -->
            @livewire('back-end.catalog.content')
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')
<!-- Dropify -->
{{-- <script src="{{ asset('template/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script> --}}
<script>
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>
@endsection