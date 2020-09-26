@extends('front-end.layout')
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
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
          
<div class="row">
    <aside class="col-md-3">
        <!-- menu -->
        <div id="MainMenu">
            @include('front-end.includes.user.sidebar')
        </div>
    </aside> <!-- col.// -->
    <main class="col-md-9">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title"> My Account</h5> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
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
                                    User/Buyer
                                </div>
                                <span class="badge badge-success">Active</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9 col-form-label">{{Auth::user()->name}}</div>
                            </div>    
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email Address</label>
                                <div class="col-sm-9 col-form-label">{{Auth::user()->email}}</div>
                            </div>
                            @if($account->contact_no)
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact Number</label>
                                    <div class="col-sm-9 col-form-label">{{Utility::mobile_number_ph_format($account->contact_no)}}</div>
                                </div>
                            @endif
                            @if($account->gender)
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Gender</label>
                                    <div class="col-sm-9 col-form-label">{{ucfirst($account->gender)}}</div>
                                </div>
                            @endif
                            @if($account->birth_date)
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Birth Date</label>
                                    <div class="col-sm-9 col-form-label">{{date('F d, Y', strtotime($account->birth_date))}}</div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Member Since</label>
                                <div class="col-sm-9 col-form-label">{{date('F Y', strtotime($account->created_at))}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

@endsection
@section('js')

@endsection