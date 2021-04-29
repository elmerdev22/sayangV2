@extends('front-end.layout')
@section('title','Product List')

@section('content')
<section class="section-pagetop bg-primary">
    <div class="container">
        <h2 class="title-page text-white">Category products</h2>
        <!-- Breadcrumb -->
        @livewire('front-end.product.listing.breadcrumb', ['category' => $data['category'], 'sub_category' => $data['sub_category']])
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
                        @livewire('front-end.product.listing.search-filter', ['search' => $data['search'], 'partner_id' => null ])
                    </div> <!-- card.// -->
                </div>
            </aside> <!-- col.// -->
            <main class="col-md-9">
                @livewire('front-end.product.listing.listing', ['search' => $data['search'], 'partner_id' => null, 'category' => $data['category'], 'sub_category' => $data['sub_category'] ])
            </main> <!-- col.// -->
        </div>
    </div> <!-- container .//  -->
</section>
<div id="modal_aside_right" class="modal fixed-right fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 m-0">
                @livewire('front-end.product.listing.search-filter', ['search' => $data['search'], 'partner_id' => null ])
            </div>
        </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// --> 
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