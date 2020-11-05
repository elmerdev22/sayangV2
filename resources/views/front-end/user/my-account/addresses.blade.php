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
                        <i class="fas fa-plus"></i> Add New Address
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

<!-- Modal -->
<div class="modal fade" id="modal-add_address" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Address</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.user.my-account.addresses.add')
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="modal-edit_address" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Address</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @livewire('front-end.user.my-account.addresses.edit')
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button type="button" class="btn btn-flat btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-flat btn-sm btn-success" form="form-edit_address"><i class="fas fa-check"></i> Save</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection
@section('js')

@endsection