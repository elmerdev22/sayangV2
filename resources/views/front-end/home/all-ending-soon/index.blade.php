@extends('front-end.layout')

@section('title','All Ending Soon')

@section('content')
<div class="py-3">
    <div class="container">
        @livewire('front-end.home.all-ending-soon.index')
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('template/assets/dist/js/loadingoverlay.min.js')}}"></script>
<script>
    $.LoadingOverlaySetup({
        image: "{{Utility::img_source('loading')}}",
    });
</script>
@endsection