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

<!-- Modal Edit Business Information -->
<div class="modal fade" id="modal-edit_business_information" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Business Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.partner.my-account.profile.business-information.edit-business-information')
        </div>
    </div>
</div>

<!-- Modal Edit Representative Information -->
<div class="modal fade" id="modal-edit_representative_information" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Representative Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.partner.my-account.profile.business-information.edit-representative-information')
        </div>
    </div>
</div>

<!-- Modal Upload DTI Certificate -->
<div class="modal fade" id="modal-upload_dti_certificate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload New DTI Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.partner.my-account.profile.business-information.upload-dti-certificate')
        </div>
    </div>
</div>

<!-- Modal Upload Representative ID -->
<div class="modal fade" id="modal-upload_representative_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload New Representative ID</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('front-end.partner.my-account.profile.business-information.upload-representative-id')
        </div>
    </div>
</div>

@endsection
@section('js')

@endsection