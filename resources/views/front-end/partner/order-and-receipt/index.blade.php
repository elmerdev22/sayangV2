@extends('front-end.partner.layouts.layout')
@section('title','Orders & Receipts')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Orders & Receipts',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Orders & Receipts'],
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
                    <h5 class="card-title">Orders & Receipts</h5> 
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