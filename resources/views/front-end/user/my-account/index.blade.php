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
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title"> My Account</h5> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="my-account-profile border-right mb-4">
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
                                <img class="profile-user-img img-fluid img-circle m-2" style="width: 120px; height: 120px;" src="{{$photo_url}}" alt="User profile picture">
                            </div>
                            <div class="text-center mt-1">
                                <button type="button" class="btn btn-default btn-sm">Select Profile</button>
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
                        <div class="form-group row my-0">
                            <label class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8 col-form-label">{{Auth::user()->name}}</div>
                        </div>
                        <div class="form-group row my-0">
                            <label class="col-sm-4 col-form-label">Email Address</label>
                            <div class="col-sm-8 col-form-label">{{Auth::user()->email}}</div>
                        </div>
                        <div class="form-group row my-0">
                            <label class="col-sm-4 col-form-label">Contact Number</label>
                            @if($account->contact_no)
                                <div class="col-sm-8 col-form-label">{{Utility::mobile_number_ph_format($account->contact_no)}}</div>
                            @else
                                <div class="col-sm-8 col-form-label">
                                    <u>
                                        <a href=""><span class="fas fa-plus"></span> Number</a>
                                    </u>
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group row my-0">
                            <label class="col-sm-4 col-form-label">Gender</label>
                            <div class="col-sm-8 col-form-label">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="male" name="radio1" checked>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="female" name="radio1">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row my-0">
                            <label class="col-sm-4 col-form-label">Birth Date</label>
                            <div class="col-sm-8 col-form-label">
                                <input type="date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row my-0">
                            <label class="col-sm-4 col-form-label">Member Since</label>
                            <div class="col-sm-8 col-form-label">{{date('F d, Y', strtotime($account->created_at))}}</div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8 col-form-label">{{Auth::user()->name}}</div>
                        </div>    
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email Address</label>
                            <div class="col-sm-8 col-form-label">{{Auth::user()->email}}</div>
                        </div>
                        @if($account->contact_no)
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Contact Number</label>
                                <div class="col-sm-8 col-form-label">{{Utility::mobile_number_ph_format($account->contact_no)}}</div>
                            </div>
                        @endif
                        @if($account->gender)
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Gender</label>
                                <div class="col-sm-8 col-form-label">{{ucfirst($account->gender)}}</div>
                            </div>
                        @endif
                        @if($account->birth_date)
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Birth Date</label>
                                <div class="col-sm-8 col-form-label">{{date('F d, Y', strtotime($account->birth_date))}}</div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Member Since</label>
                            <div class="col-sm-8 col-form-label">{{date('F Y', strtotime($account->created_at))}}</div>
                        </div> --}}
                    </div>
                </div>
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

@endsection
@section('js')

@endsection