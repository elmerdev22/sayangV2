@extends('front-end.layout')
@section('title','Bids - Active')
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
    <aside class="col-md-3 mb-3">
        @include('front-end.includes.user.aside')
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