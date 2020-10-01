@extends('back-end.layouts.layout')
@section('title', ucwords($data->first_name.' '.$data->last_name).' - User Profile')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'User Profile',
            'breadcrumbs' => [
                ['url' => route('back-end.user.index'), 'label' => 'Users'],
                ['url' => '', 'label' => ucwords($data->first_name.' '.$data->last_name)],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-outline card-sayang">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @php
                            if($data->photo){
                                $photo_url = asset('images/default-photo/account.png');
                            }else if($data->photo_provider_link){
                                $photo_url = $data->photo_provider_link;
                            }else{
                                $photo_url = asset('images/default-photo/account.png');
                            }
                        @endphp
                        <img class="profile-user-img img-fluid img-circle" src="{{$photo_url}}" alt="User profile picture" style="width: 150px; height: 150px;">
                    </div>

                    <h3 class="profile-username text-center">{{ucwords($data->first_name.' '.$data->middle_name.' '.$data->last_name)}}</h3>

                    <p class="text-muted text-center">User/Buyer</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Status</b> 
                            <a class="float-right">
                                @if($data->user->verified_at) 
                                    @if($data->user->is_blocked)
                                        <span class="badge badge-danger">Blocked</span>
                                    @else
                                        <span class="badge badge-success">Verified</span>
                                    @endif
                                @else
                                    <span class="badge badge-warning">Not Verified</span>
                                @endif
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Gender</b> 
                            <a class="float-right">
                                @if($data->gender)
                                    {{ucfirst($data->gender)}}
                                @else
                                    <small class="text-muted">Not Set</small>
                                @endif
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Birth Date</b> 
                            <a class="float-right">
                                @if($data->gender)
                                    {{date('F d,Y', strtotime($data->birth_date))}}
                                @else
                                    <small class="text-muted">Not Set</small>
                                @endif
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Contact No.</b> 
                            <a class="float-right">
                                @if($data->contact_no)
                                    {{Utility::mobile_number_ph_format($data->contact_no)}}
                                @else
                                    <small class="text-muted">Not Set</small>
                                @endif
                            </a>
                        </li>
                    </ul>
                    @if($data->user->is_blocked == 1)
                        <a href="#" data-toggle="modal" data-target="#block-user-modal" class="btn btn-success btn-block"><b>Unblock User</b></a>
                    @else
                        <a href="#" data-toggle="modal" data-target="#block-user-modal" class="btn btn-danger btn-block"><b>Block User</b></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @livewire('back-end.user.profile.purchase-history', ['key_token' => $data->key_token])
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection