@extends('front-end.layout')

@section('title','All Recently Added')

@section('content')
<div class="py-3">
    <div class="container">
        @livewire('front-end.home.all-recently-added.index')
    </div>
</div>
@endsection