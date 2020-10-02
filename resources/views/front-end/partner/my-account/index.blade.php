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
            <div class="card-body">
                <div class="my-account-profile mb-4">
                    <div class="text-center">
                        @php
                            if($account->photo){
                                $photo_url = asset('images/default-photo/account.png');
                            }else if($account->photo_provider_link){
                                $photo_url = $account->photo_provider_link;
                            }else{
                                $photo_url = asset('images/default-photo/account.png');
                            }
                        @endphp
                        <img class="profile-user-img img-fluid img-circle" src="{{$photo_url}}" alt="User profile picture">
                    </div>
                    <div class="text-center mt-1">
                        <button type="button" class="btn btn-default btn-sm">Upload Image</button>
                    </div>
                    <div class="profile-username text-center">{{ucwords($account->first_name.' '.$account->middle_name.' '.$account->last_name)}}</div>
                    <div class="text-center">
                        <div class="text-muted">
                            Partner/Merchant
                        </div>
                        <span class="badge badge-success">Active</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
            <div class="card-body card-outline card-sayang">
                <h4>Account Information</h4>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <div>{{Auth::user()->name}}</div>
                                </div>    
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <div>{{Auth::user()->email}}</div>
                                </div>    
                            </div>
                            @if($account->contact_no)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <div>{{Utility::mobile_number_ph_format($account->contact_no)}}</div>
                                    </div>
                                </div>
                            @endif
                            @if($account->gender)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div>{{ucfirst($account->gender)}}</div>
                                    </div>
                                </div>
                            @endif
                            @if($account->birth_date)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <div>{{date('F d, Y', strtotime($account->birth_date))}}</div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Member Since</label>
                                    <div>{{date('F Y', strtotime($account->created_at))}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h4>Partner Information</h4>
                <div class="row">
                    <div class="col-lg-12 px-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <div>{{ucfirst($partner->name)}}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Business Contact No.</label>
                                    <div>{{Utility::mobile_number_ph_format($partner->contact_no)}}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Business Email</label>
                                    <div>{{$partner->email}}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>DTI Registration No.</label>
                                    <div>{{$partner->dti_registration_no}}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>TIN</label>
                                    <div>{{$partner->tin}}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Uploaded DTI Certificate</label>
                                    <div><a class="btn btn-sm btn-default" href="{{asset('storage/'.$account->key_token.'/dti-certificates/'.$partner->dti_certificate_file)}}" download="{{$partner->dti_certificate_file_name}}" target="_blank"><i class="fas fa-download"></i> Download File</a></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
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
                <h4>Representative Information</h4>
                <div class="row">
                    <div class="col-lg-12 px-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div>{{ucwords($partner->representative_first_name.' '.$partner->representative_last_name)}}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <div>{{$partner->designation}}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div>{{$partner->representative_email}}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Contact No.</label>
                                    <div>{{Utility::mobile_number_ph_format($partner->representative_contact_no)}}</div>
                                </div>
                            </div>
                            <div class="col-6">
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