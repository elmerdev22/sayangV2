@extends('front-end.partner.layouts.layout')
@section('title','Edit Product')
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/plugins/select2/css/select2.min.css')}}"> 
<link rel="stylesheet" href="{{asset('template/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> 
@endsection
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Edit Product',
            'breadcrumbs' => [
                ['url' => route('front-end.partner.my-products.list.index'), 'label' => 'List'],
                ['url' => '', 'label' => 'Edit Product'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title">Edit Product Information</h5> 
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                @livewire('front-end.partner.my-products.edit.information', ['product_id' => $product_id])
            </div> <!-- card.// -->
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title">Product Photos</h5> 
                    <div class="card-tools">
                        <button type="button" data-toggle="modal" data-target="#modal-upload_photo" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Upload Photo </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                @livewire('front-end.partner.my-products.edit.photo', ['product_id' => $product_id])
            </div> <!-- card.// -->
        </div>
    </div>

    <!-- Modal -->
    <div id="modal-upload_photo" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload New Photos</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @livewire('front-end.partner.my-products.edit.upload-photo', ['product_id' => $product_id])
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('template/assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('template/assets/dist/js/custom-select2.js')}}"></script>
    <script src="{{asset('template/assets/plugins/money-mask/jquery.maskMoney.min.js')}}"></script>
@endsection