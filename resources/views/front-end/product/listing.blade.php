@extends('front-end.layout')
@section('title','Product List')

@section('content')
    <section class="section-pagetop bg">
        <div class="container">
            <h2 class="title-page">Category products</h2>
            <!-- Breadcrumb -->
            @livewire('front-end.product.listing.breadcrumb', ['category' => $data['category'], 'sub_category' => $data['sub_category']])
            <!-- Breadcrumb.// -->
        </div> <!-- container //  -->
    </section>

    <section class="section-content padding-y">
        <div class="container">
            <div class="row">
                <aside class="col-md-3">
                    @livewire('front-end.product.listing.search-filter', ['search' => $data['search'], 'partner_id' => null ])
                </aside> <!-- col.// -->
                <main class="col-md-9">
                    @livewire('front-end.product.listing.listing', ['search' => $data['search'], 'partner_id' => null, 'category' => $data['category'], 'sub_category' => $data['sub_category'] ])
                </main> <!-- col.// -->
            </div>
        </div> <!-- container .//  -->
    </section>
    <!-- Breadcrumb -->
    {{-- @livewire('front-end.product.listing.breadcrumb', ['category' => $data['category'], 'sub_category' => $data['sub_category']]) --}}
    <!-- Breadcrumb.// -->

    {{-- <div class="row">
        <aside class="col-md-3">
            <div class="d-md-none d-lg-none d-xl-none">
                <button data-toggle="modal" data-target="#modal_aside_right" class="btn btn-warning w-100" type="button"> <span class="fas fa-filter"></span> Filter </button>
            </div>
            <div class="hidden-xs d-none d-md-block d-lg-block ">    
                <div class="card">
                    @livewire('front-end.product.listing.search-filter', ['search' => $data['search'], 'partner_id' => null ])
                </div> <!-- card.// -->
            </div>
        </aside> <!-- col.// -->

        <main class="col-md-9">
            <div class="row">
                <div class="col-12">
                    <div class="card no-box-shadow" id="card-product_listing">
                        <div class="card-body p-0">
                            @livewire('front-end.product.listing.listing', ['search' => $data['search'], 'partner_id' => null, 'category' => $data['category'], 'sub_category' => $data['sub_category'] ])
                        </div>
                    </div> <!-- card.// -->
                </div>
            </div>
        </main>
    </div>

    <div id="modal_aside_right" class="modal fixed-right fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0 m-0">
                    @livewire('front-end.product.listing.search-filter', ['search' => $data['search'] ])
                </div>
            </div>
        </div> <!-- modal-bialog .// -->
    </div> <!-- modal.// --> --}}

@endsection

@section('js')
<script src="{{asset('template/assets/plugins/money-mask/jquery.maskMoney.min.js')}}"></script>
<script src="{{asset('template/assets/dist/js/loadingoverlay.min.js')}}"></script>
<script>
    $.LoadingOverlaySetup({
        image: "{{Utility::img_source('loading')}}",
        imageAnimation: false,
    });
</script>
@endsection