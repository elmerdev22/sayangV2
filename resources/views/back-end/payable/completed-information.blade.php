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
            <div class="card mb-3">
                <div class="card-body">
                    PARTNER: <a href="{{route('back-end.partner.profile', ['key_token' => $partner->user_account->key_token])}}" class="text-blue" title="Click here to visit partner profile">{{ucfirst($partner->name)}}</a>
                </div>        
            </div>
            @livewire('back-end.payable.completed-information.payable.listing', ['partner_id' => $partner->id])
            @livewire('back-end.payable.completed-information.receivable.listing', ['partner_id' => $partner->id])

            <div class="row">
                <div class="col-sm-5 col-md-4 col-lg-3">
                    
                </div>
                <div class="col-sm-7 col-md-8 col-lg-9">
    
                </div>
            </div>
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection