@extends('front-end.layout')

@section('title','All Most Popular')

@section('content')
<div class="py-3">
    <div class="container">
        @livewire('front-end.home.all-most-popular.index')
    </div>
</div>
@endsection