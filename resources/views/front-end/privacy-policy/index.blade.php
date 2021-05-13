@extends('front-end.layout')
@section('title','Privacy Policy')
@section('content')
<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-primary">
    <div class="container">
        <h2 class="title-page text-white">Privacy Policy</h2>
    </div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->
    
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">      
        @if (Utility::description_settings('privacy_policy'))
            {!! Utility::description_settings('privacy_policy')->settings_value !!}
        @else 
            <div class="row">
                <div class="col-12 text-center">
                    <img class="img-thumbnail border-0" src="{{Utility::img_source('not_found')}}">
                </div> 
            </div>
        @endif                          
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
