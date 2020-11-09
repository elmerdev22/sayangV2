@extends('front-end.layout')
@section('title','Check Out')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Checkout',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Checkout'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')

<div class="container">

    <div class="row">
        <main class="col-md-8">
            <h4 class="mb-3"><i class="fas fa-file-invoice"></i> Billing address</h4>
            <div class="card card-sayang" id="card-billing">
                <div class="card-body">
                    @livewire('front-end.user.check-out.index.billing')
                    <hr class="mb-4">
                    @livewire('front-end.user.check-out.index.payment-method')
                    <hr class="mb-4">
                    @livewire('front-end.user.check-out.index.continue-to-check-out')
                </div>
            </div> <!-- card.// -->
        </main> <!-- col.// -->

        <aside class="col-md-4 order-md-2 mb-4">
            @livewire('front-end.user.check-out.index.my-cart')

            {{-- <form class="card p-2">
                <div class="card-body">
                    <div class="form-group">
                        <label>Get a voucher?</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="" placeholder="Enter code here">
                            <span class="input-group-append"> 
                            <button type="button" class="btn btn-warning text-white">Apply</button>
                            </span>
                        </div>
                    </div>
                </div> <!-- card-body.// -->
            </form> --}}
        </aside> <!-- col.// -->
    </div>

</div> <!-- container .//  -->

<!-- Modal -->
<div class="modal fade" id="modal-select_other_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @livewire('front-end.user.check-out.index.select-other-address')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fas fa-times"></span> Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add_new_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Address</h5>
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
                <h4 class="modal-title">Add New Bank Account</h4>
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
                <h4 class="modal-title">Add New Debit/Credit Card</h4>
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
@endsection

@section('js')
<script src="{{asset('template/assets/plugins/money-mask/jquery.maskMoney.min.js')}}"></script>
@endsection
