@extends('front-end.layout')
@section('title','Check Out')
@section('page_header')
    @php 
        $page_header = [
            'title'       => '<small>Checkout</small>',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Checkout'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
<section class="section-content padding-y bg">
    <div class="container">
        <!-- ============================ COMPONENT 2 ================================= -->
        <div class="row">
            <main class="col-md-8">
                <article class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Review cart</h4>
                        @livewire('front-end.user.check-out.index.my-cart')
                    </div> <!-- card-body.// -->
                </article> <!-- card.// -->

                <article class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Billing Address</h4>
                        @livewire('front-end.user.check-out.index.billing')
                    </div> <!-- card-body.// -->
                </article> <!-- card.// -->

                <h4 class="mb-3">Payment Method</h4>
                @livewire('front-end.user.check-out.index.payment-method')

                <div class="row pt-4">
                    <div class="col-md-12">        
                        @livewire('front-end.user.check-out.index.continue-to-check-out')
                    </div>
                </div>
                <!-- accordion end.// -->
            </main> <!-- col.// -->
            <aside class="col-md-4">
                @livewire('front-end.user.check-out.index.overview')
            </aside> <!-- col.// -->
        </div> <!-- row.// -->
        <!-- ============================ COMPONENT 2 END//  ================================= -->
    </div> <!-- container .//  -->
</section>
<!-- Modal -->
<div class="modal fade" id="modal-select_other_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Change Billing Address</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @livewire('front-end.user.check-out.index.select-other-address')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add_new_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add New Address</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.user.my-account.addresses.add', ['is_checkout_page' => true])
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add_bank" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add New Bank Account</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.user.my-account.banks.add', ['is_checkout_page' => true])
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-add_credit_card" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add New Debit/Credit Card</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.user.my-account.credit-card.add', ['is_checkout_page' => true])
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-payment_3d_secure" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modal-payment_3rd_secure_iframe">
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" href="{{route('front-end.user.my-purchase.list')}}">Cancel Payment</a>
            </div> 
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@section('js')
<script src="{{asset('template/assets/dist/js/loadingoverlay.min.js')}}"></script>
<script src="{{asset('template/assets/plugins/money-mask/jquery.maskMoney.min.js')}}"></script>
<script>
    $.LoadingOverlaySetup({
        image: "{{Utility::img_source('loading')}}",
        imageAnimation: false,
    });
</script>
@endsection
