@extends('front-end.partner.layouts.layout')
@section('title','Activities')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Activities',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Past'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
@if (Auth::user()->is_blocked)
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger p-2" role="alert">
                <small>{{Utility::error_message('blocked_partner_error')}}</small>
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-12">
        @livewire('front-end.partner.activities.past.index')
    </div>
</div>
@endsection