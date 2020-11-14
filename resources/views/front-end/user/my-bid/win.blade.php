@extends('front-end.layout')
@section('title','Change Password')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Win Bids',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Win Bids'],
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
        {{-- @livewire('front-end.user.my-bid.active') --}}
    </main> <!-- col.// -->
</div>

@endsection