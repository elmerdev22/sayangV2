@extends('front-end.partner.layouts.layout')
@section('title','Products List')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'My Products',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'My Products'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
@if (Auth::user()->is_blocked)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger p-2" role="alert">
                <small>{{Utility::error_message('blocked_partner_error')}}</small>
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-12">
        @livewire('front-end.partner.my-products.index.listing')
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-import_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{route('front-end.partner.my-products.list.import')}}" enctype="multipart/form-data" id="form">
                @method('POST')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            Download sample format: <a href="{{asset('files/Import_products_format.xlsx')}}" download class="btn-link">click here</a> <i class="fas fa-hand-point-left"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="file">File* <small>.csv,.xlsx,.xls</small></label>
                                <div>
                                    <input type="file" class="@error('file') is-invalid @enderror" id="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    @error('file') 
                                        <span class="invalid-feedback">
                                            <span>{{$message}}</span>
                                        </span> 
                                    @enderror
                                </div>
                            </div> 
                        </div>    
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit">Import <span id="loading" style="display: none;" class="fas fa-spinner fa-spin"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    @error('file')
        $('#modal-import_product').modal('show');
    @enderror
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Yay!',
            text: "{{session('success')}}",
        })
    @endif
    $('#form').on('submit', function(){
        $('#submit').attr('disabled', true);
        $('#loading').show();
    })

    function deleteProduct(){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
        })
    }
</script>
@endsection