@extends('front-end.layout')
@section('title','Change Password')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Active Bids',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Active Bids'],
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
        @livewire('front-end.user.my-bid.active')
    </main> <!-- col.// -->
</div>

@endsection
@section('js')
<!-- Countdown JS -->
<script src="{{asset('template/assets/dist/js/countdown.js')}}"></script>
@endsection