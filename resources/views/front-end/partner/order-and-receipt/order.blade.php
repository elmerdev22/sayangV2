@extends('front-end.partner.layouts.layout')
@section('title','Order - {order_id}')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Order Information',
            'breadcrumbs' => [
                ['url' => route('front-end.partner.order-and-receipt.index'), 'label' => 'Orders & Receipts'],
                ['url' => '', 'label' => 'Order #{order_id}'],
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
                    <h5 class="card-title">Order #{order_id}</h5> 
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    
                </div>
            </div> <!-- card.// -->
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">

</script>
@endsection