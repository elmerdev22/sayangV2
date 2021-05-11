@extends('front-end.layout')
@section('title','Partner List')

@section('content')
<section class="section-pagetop bg-primary">
    <div class="container">
        <h2 class="title-page text-white">Partner List</h2>
        <!-- Breadcrumb -->
        {{-- @livewire('front-end.product.listing.breadcrumb', ['category' => $data['category'], 'sub_category' => $data['sub_category']]) --}}
        <!-- Breadcrumb.// -->
    </div> <!-- container //  -->
</section>

<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <div class="d-md-none d-lg-none d-xl-none">
                    <button data-toggle="modal" data-target="#modal_aside_right" class="btn btn-primary btn-block mb-2" type="button"> Filter </button>
                </div>
                <div class="hidden-xs d-none d-md-block d-lg-block ">    
                    <div class="card">
                        @livewire('front-end.home.partners.filter')
                    </div> <!-- card.// -->
                </div>
            </aside> <!-- col.// -->
            <main class="col-md-9">
                @livewire('front-end.home.partners.index')
            </main> <!-- col.// -->
        </div>
    </div> <!-- container .//  -->
</section>

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