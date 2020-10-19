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
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-add_address">
                        <i class="fas fa-plus"></i> Add New Bank Account
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p class="text-center">You don't have credit cards yet.</p>
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->

        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title">My Debit/Credit Cards</h5> 
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-add_address">
                        <i class="fas fa-plus"></i> Add New Debit/Credit Cards
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p class="text-center">You don't have credit cards yet.</p>
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

@endsection
@section('js')

@endsection