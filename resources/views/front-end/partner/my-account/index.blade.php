@extends('front-end.partner.layouts.layout')
@section('title','My Account')
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
                @php
                    if($account->photo){
                        $photo_url = asset('images/default-photo/account.png');
                    }else if($account->photo_provider_link){
                        $photo_url = $account->photo_provider_link;
                    }else{
                        $photo_url = asset('images/default-photo/account.png');
                    }
                @endphp
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{$photo_url}}" alt="User profile picture">
                </div>

                <div class="text-center mt-1">
                    <button type="button" class="btn btn-default btn-sm">Upload Image</button>
                </div>
                <h3 class="profile-username text-center">
                    {{ucwords($account->first_name.' '.$account->middle_name.' '.$account->last_name)}}
                </h3>
                <p class="text-muted text-center">
                    <span class="badge badge-success">Active</span>
                </p>

                <ul class="list-group list-group-unbordered mb-3 text-sm">
                    <li class="list-group-item">
                        <b>Username</b> <a class="float-right">
                            {{Auth::user()->name}}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">
                            {{Auth::user()->email}}
                        </a>
                    </li>
                    @if($account->contact_no)
                    <li class="list-group-item">
                        <b>Contact Number</b> <a class="float-right">
                            {{Utility::mobile_number_ph_format($account->contact_no)}}
                        </a>
                    </li>
                    @endif

                    @if($account->gender)
                    <li class="list-group-item">
                        <b>Contact Number</b> <a class="float-right">
                            {{Utility::mobile_number_ph_format($account->gender)}}
                        </a>
                    </li>
                    @endif

                    @if($account->birth_date)
                    <li class="list-group-item">
                        <b>Contact Number</b> <a class="float-right">
                            {{Utility::mobile_number_ph_format($account->birth_date)}}
                        </a>
                    </li>
                    @endif

                    <li class="list-group-item">
                        <b>Joined</b> <a class="float-right">
                            {{date('F Y', strtotime($account->created_at))}}
                        </a>
                    </li>
                </ul>

                <a href="#" class="btn btn-warning btn-block"><b>Edit Profile</b></a>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR1aer_eK_rutTokxSeU5gTiW1q9eUKPvpTyw&usqp=CAU') center center;">
                                <h3 class="widget-user-desc text-right">
                                    <button type="button" class="btn btn-default btn-sm"><span class="fas fa-edit"></span> Cover Photo</button>
                                    <button type="button" class="btn btn-default btn-sm"><span class="fas fa-edit"></span> Profile Photo</button>
                                </h3>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" src="{{$photo_url}}" alt="User Avatar">
                            </div>
                            <div class="card-footer bg-white">
                                <div class="row text-center">
                                    <div class="col-md-4 border pt-2">
                                        <label>
                                            <span class="fas fa-star"></span> 
                                            <span class="text-muted">Ratings :</span>
                                            <span class="text-warning">4.7</span>
                                            <small>(344 rating)</small>
                                        </label>
                                    </div>
                                    <div class="col-md-4 border pt-2">
                                        <label>
                                            <span class="fas fa-store"></span>
                                            <span class="text-muted">Products :</span>
                                            <span class="text-warning">57</span> 
                                        </label>
                                    </div>
                                    <div class="col-md-4 border pt-2">
                                        <label>
                                            <span class="fas fa-users"></span>
                                            <span class="text-muted">Followers :</span>
                                            <span class="text-warning">57</span> 
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">            
                        <h4>Partner Information</h4>
                    </div>
                    <div class="col-lg-12 px-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <div>{{ucfirst($partner->name)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Business Contact No.</label>
                                    <div>{{Utility::mobile_number_ph_format($partner->contact_no)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Business Email</label>
                                    <div>{{$partner->email}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>DTI Registration No.</label>
                                    <div>{{$partner->dti_registration_no}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>TIN</label>
                                    <div>{{$partner->tin}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Uploaded DTI Certificate</label>
                                    <div><a class="btn btn-sm btn-default" href="{{asset('storage/'.$account->key_token.'/dti-certificates/'.$partner->dti_certificate_file)}}" download="{{$partner->dti_certificate_file_name}}" target="_blank"><i class="fas fa-download"></i> Download File</a></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <div>{{Utility::partner_full_address($partner->partner_id)}}</div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Map Link</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="text-ellipsis">
                                                <a href="{{$partner->map_address_link}}" target="_blank" class="text-blue">
                                                    {{$partner->map_address_link}}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-2 text-right">
                                            <button type="button" class="btn btn-xs btn-default" title="Copy Link"><i class="fas fa-copy"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">            
                        <h4>Representative Information</h4>
                    </div>
                    <div class="col-lg-12 px-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div>{{ucwords($partner->representative_first_name.' '.$partner->representative_last_name)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <div>{{$partner->representative_designation}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div>{{$partner->representative_email}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contact No.</label>
                                    <div>{{Utility::mobile_number_ph_format($partner->representative_contact_no)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Uploaded ID</label>
                                    <div><a class="btn btn-sm btn-default" href="{{asset('storage/'.$account->key_token.'/uploaded-id/'.$partner->representative_uploaded_id_file)}}" download="{{$partner->representative_uploaded_id_file_name}}" target="_blank"><i class="fas fa-download"></i> Download File</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </div>
</div>

@endsection
@section('js')

@endsection