@extends('front-end.partner.layouts.layout')
@section('title','Start Sale')
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('template/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

@endsection
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Start a Sale',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Start a Sale'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @livewire('front-end.partner.my-products.start-sale.listing')
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-proceed_start_sale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Start Sale</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.partner.my-products.start-sale.proceed')
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('template/assets/plugins/money-mask/jquery.maskMoney.min.js')}}"></script>
<script src="{{asset('template/assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('template/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('template/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
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