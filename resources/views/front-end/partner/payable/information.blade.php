@extends('front-end.partner.layouts.layout')
@section('title','Payout - #'.$payout_no)
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - #'.$payout_no,
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - #'.$payout_no],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->

            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title">Payout #{{$payout_no}}</h5>
                </div>
                <div class="card-body">
                    @livewire('front-end.partner.payable.information.index', ['payout_id' => $payout->id])
                    <hr>
                    <h4 class="text-lead">Order List</h4>
                    @livewire('front-end.partner.payable.information.order-listing', ['payout_id' => $payout->id])
                </div>
            </div>
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection