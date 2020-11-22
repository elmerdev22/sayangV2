@extends('front-end.layout')
@section('title','Product List')
@section('page_header')
    @php 
        $page_header = [
            'title'       => '',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Products'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <aside class="col-md-3">
            <div class="card">
                @livewire('front-end.product.listing.search-filter')
            </div> <!-- card.// -->
        </aside> <!-- col.// -->

        <main class="col-md-9">
            <div class="row">
                <div class="col-12">
                    @livewire('front-end.product.listing.listing')
                </div>
            </div>
        </main>
    </div>
@endsection
@section('js')
<script src="{{asset('template/assets/plugins/money-mask/jquery.maskMoney.min.js')}}"></script>
<script type="text/javascript"></script> 
@endsection