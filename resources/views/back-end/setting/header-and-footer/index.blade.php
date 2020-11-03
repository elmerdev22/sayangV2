@extends('back-end.layouts.layout')
@section('title','Settings')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Settings',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Settings'],
                ['url' => '', 'label' => 'Header & Footer'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.setting.header-and-footer.index')
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection