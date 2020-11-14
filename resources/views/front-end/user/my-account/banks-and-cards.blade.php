@extends('front-end.layout')
@section('title','Banks & Cards')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Banks & Cards',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Banks & Cards'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
          
<div class="row">
    <aside class="col-md-3">
        <!-- menu -->
        <div id="MainMenu">
            @include('front-end.includes.user.sidebar')
        </div>
    </aside> <!-- col.// -->
    <main class="col-md-9">
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title">My Bank Accounts</h5> 
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-add_bank">
                        <i class="fas fa-plus"></i> Add New Bank Account
                    </button>
                </div>
            </div>
            <div class="card-body">
                @livewire('front-end.user.my-account.banks.listing')
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->

        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title">My Debit/Credit Cards</h5> 
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-add_credit_card">
                        <i class="fas fa-plus"></i> Add New Debit/Credit Cards
                    </button>
                </div>
            </div>
            <div class="card-body">
                @livewire('front-end.user.my-account.credit-card.listing')
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>


<!-- Modal -->
<div class="modal fade" id="modal-add_bank" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Bank Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.user.my-account.banks.add')
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="modal-add_credit_card" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Debit/Credit Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.user.my-account.credit-card.add')
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