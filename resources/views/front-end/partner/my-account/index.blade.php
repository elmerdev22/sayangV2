@extends('front-end.partner.layouts.layout')
@section('title','My Account')
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/dist/css/custom_inputs.css')}}">
@endsection
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'My Account',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'My Account'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h2 class="card-title">
                    Account Information
                </h2>
            </div>
            <div class="card-body box-profile">
                @livewire('front-end.partner.my-account.profile.account-information.index')
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <hr>
    <div class="col-md-9">
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h2 class="card-title">
                    Business Information
                </h2>
            </div>
            <div class="card-body ">
                @livewire('front-end.partner.my-account.profile.business-information.profile-and-cover-photo')
                @livewire('front-end.partner.my-account.profile.business-information.business-information')
                <hr>
                @livewire('front-end.partner.my-account.profile.business-information.representative-information')
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </div>
</div>

@endsection
@section('js')

@endsection