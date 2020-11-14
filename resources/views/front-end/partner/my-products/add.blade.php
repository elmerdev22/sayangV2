@extends('front-end.partner.layouts.layout')
@section('title','Add Products')
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/plugins/select2/css/select2.min.css')}}"> 
<link rel="stylesheet" href="{{asset('template/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> 
@endsection
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Add Product',
            'breadcrumbs' => [
                ['url' => route('front-end.partner.my-products.list.index'), 'label' => 'List'],
                ['url' => '', 'label' => 'Add Product'],
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
                    <h5 class="card-title">Add Product Requirement</h5> 
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                @livewire('front-end.partner.my-products.add')                
            </div> <!-- card.// -->
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('template/assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('template/assets/dist/js/custom-select2.js')}}"></script>
    <script src="{{asset('template/assets/plugins/money-mask/jquery.maskMoney.min.js')}}"></script>
@endsection