@extends('front-end.layout')
@section('title','Help Centre')
@section('messenger')
   @include('front-end.includes.messenger') 
@endsection
@section('content')
<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-primary">
    <div class="container">
        @livewire('front-end.help-centre.search')
    </div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->
    
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">    
        @livewire('front-end.help-centre.topics')
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
@section('js')
<script src="{{asset('template/assets/dist/js/loadingoverlay.min.js')}}"></script>
<script>
    $.LoadingOverlaySetup({
        image: "{{Utility::img_source('loading')}}",
        imageAnimation: false,
    });
</script>
@endsection