@extends('front-end.layout')
@section('title','Notifications - Activity')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Activity',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Activity'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
          
<div class="row">
    <aside class="col-md-3">
        <!-- menu -->
        <div id="MainMenu">
            @include('front-end.includes.user.sidebar')
        </div>
    </aside> <!-- col.// -->
    <main class="col-md-9">
        @livewire('front-end.user.notifications.activity')
    </main> <!-- col.// -->
</div>

@endsection