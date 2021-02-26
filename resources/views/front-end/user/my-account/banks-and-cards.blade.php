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

<section class="section-content padding-y bg">
    <div class="container">
        <!-- =========================  COMPONENT MY PROFILE ========================= --> 
        <div class="row">
            <aside class="col-md-3">
                <!--   SIDEBAR   -->
                @include('front-end.includes.user.sidebar')
                <!--   SIDEBAR .//END   -->
            </aside>
            <main class="col-md-9">
                @if($enabled_bank_account)
                    <div class="card">
                        
                        <header class="card-header">
                            <strong class="d-inline-block mr-3">My Bank Accounts</strong>
                            
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add_bank">
                                <i class="fas fa-plus"></i> Add New
                            </button>
                        </header>
                        <div class="card-body">
                            @livewire('front-end.user.my-account.banks.listing')
                        </div> <!-- card-body .// -->
                    </div> <!-- card.// -->
                @endif
        
                @if($enabled_debit_credit_card)
                    <div class="card">
                        <div class="card-header">
                            <strong class="d-inline-block mr-3">My Debit/Credit Cards</strong>

                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add_credit_card">
                                <i class="fas fa-plus"></i> Add New
                            </button>
                        </div>
                        <div class="card-body">
                            @livewire('front-end.user.my-account.credit-card.listing')
                        </div> <!-- card-body .// -->
                    </div> <!-- card.// -->
                @endif
            </main>
        </div> <!-- row.// -->
        <!-- =========================  COMPONENT MY PROFILE.// ========================= --> 
    </div> <!-- container .//  -->
</section>    
@if($enabled_bank_account)
    <!-- Modal -->
    <div class="modal fade" id="modal-add_bank" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add New Bank Account</h6>
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
@endif
@if($enabled_debit_credit_card)
    <!-- Modal -->
    <div class="modal fade" id="modal-add_credit_card" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add New Debit/Credit Card</h6>
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
@endif
@endsection
@section('js')
<script src="{{asset('template/assets/plugins/money-mask/jquery.maskMoney.min.js')}}"></script>
@endsection