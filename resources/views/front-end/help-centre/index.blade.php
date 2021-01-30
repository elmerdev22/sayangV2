@extends('front-end.layout')
@section('title','Help Centre')
@section('messenger')
   @include('front-end.includes.messenger') 
@endsection
@section('content')

<section class="content bg-dark">
    <div class="container">
        @livewire('front-end.help-centre.search')
    </div> 
</section>
<section class="content-header my-2">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Topics</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Help Centre</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        @livewire('front-end.help-centre.topics')
    </div> 
</section>
@endsection

@section('js')
<script src="{{asset('template/assets/dist/js/loadingoverlay.min.js')}}"></script>
<script src=""></script>  
<script>
    $.LoadingOverlaySetup({
        image          : "{{Utility::img_source('loading')}}",
    });
</script>
@endsection