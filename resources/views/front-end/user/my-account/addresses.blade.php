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
          
<section class="section-content padding-y bg">
    <div class="container">
        <!-- =========================  COMPONENT MY PROFILE ========================= --> 
        <div class="row">
            <aside class="col-md-3">
                <!--   SIDEBAR   -->
                @include('front-end.includes.user.aside')
                <!--   SIDEBAR .//END   -->
            </aside>
            <main class="col-md-9">
                <div class="card">
                    <header class="card-header">
                        <strong class="d-inline-block mr-3">My Addresses</strong>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add_address">
                            <i class="fas fa-plus"></i> Add New
                        </button>
                    </header>
                    <div class="card-body">
                        @livewire('front-end.user.my-account.addresses.listing')
                    </div> <!-- card-body .// -->
                </div> <!-- card.// -->
            </main>
        </div> <!-- row.// -->
        <!-- =========================  COMPONENT MY PROFILE.// ========================= --> 
    </div> <!-- container .//  -->
</section>

<!-- Modal -->
<div class="modal fade" id="modal-add_address" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add New Address</h6>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Address</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @livewire('front-end.user.my-account.addresses.edit')
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button type="button" class="btn btn-flat btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-flat btn-primary" form="form-edit_address">Save</button>
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