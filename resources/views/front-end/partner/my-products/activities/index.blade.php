@extends('front-end.partner.layouts.layout')
@section('title','Activities')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Activities',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Activities'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @livewire('front-end.partner.my-products.activities.active.index')
    </div>
</div>
<div class="row">
    <div class="col-12">
        @livewire('front-end.partner.my-products.activities.past.index')
    </div>
</div>
<div class="row">
    <div class="col-12">
        @livewire('front-end.partner.my-products.activities.cancelled.index')
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript">

</script>
@endsection