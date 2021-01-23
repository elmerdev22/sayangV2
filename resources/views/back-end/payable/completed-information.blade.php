@extends('back-end.layouts.layout')
@section('title','Payout - Completed - '.ucfirst($partner->name))
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - Completed',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - Completed'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.payable.completed-information.payable.listing', ['partner_id' => $partner->id])
            @livewire('back-end.payable.completed-information.receivable.listing', ['partner_id' => $partner->id])
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection