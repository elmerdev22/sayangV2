@extends('back-end.layouts.layout')
@section('title', ucwords($data->first_name.' '.$data->last_name).' - Partner Profile')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Partner Profile',
            'breadcrumbs' => [
                ['url' => route('back-end.partner.index'), 'label' => 'Partners'],
                ['url' => '', 'label' => ucwords($data->first_name.' '.$data->last_name)],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            @livewire('back-end.partner.profile.account-information', ['key_token' => $data->key_token])
        </div>
        <div class="col-md-9">
            @livewire('back-end.partner.profile.partner-information', ['key_token' => $data->key_token])
            @livewire('back-end.partner.profile.representative-information', ['key_token' => $data->key_token])
            @livewire('back-end.partner.profile.bank-and-card', ['key_token' => $data->key_token])
            @livewire('back-end.partner.profile.operating-hours', ['key_token' => $data->key_token])
            @livewire('back-end.partner.profile.purchase-history', ['key_token' => $data->key_token])
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection