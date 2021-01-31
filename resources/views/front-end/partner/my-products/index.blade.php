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
@endsection
@section('js')
<script type="text/javascript">
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