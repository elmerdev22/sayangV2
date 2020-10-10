@extends('front-end.layout')
@section('title','My Addresses')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'My Addresses',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'My Addresses'],
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
                <h5 class="card-title">My Addresses</h5> 
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-add_address">
                        <i class="fas fa-plus"></i> Add Address
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                
                @livewire('front-end.user.my-account.addresses.listing')

            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

@endsection
@section('js')

@endsection