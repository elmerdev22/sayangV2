@extends('back-end.layouts.layout')
@section('title','Payout - To Receive')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - To Receive',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - To Receive'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.payout.to-receive.listing')
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection