@extends('admin.layouts.admin')
@section('header')
    <h1 class="m-0 text-dark">{{__(ucwords(Request::route()->action['name'].' / '.Request::route()->action['alter']))}}</h1>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item">Accounts</li>
    <li class="breadcrumb-item active">{{__(ucwords(Request::route()->action['name']))}}</li>
@endsection
@section('view')
  <div class="container app-container">
    <div class="row">
      <div class="col-12 col-sm-4 col-md-4">
        <div class="card">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{$user->photo_provider_link ?? asset('images/default-photo/account.png')}}" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">{{ucwords($user->first_name.' '.$user->last_name)}}</h3>
            <p class="text-muted text-center">{{ucwords($user->name)}}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Birthday:</b> <a class="float-right">{{$user->birth_date}}</a>
              </li>
              <li class="list-group-item">
                <b>Gender:</b> <a class="float-right">{{$user->gender}}</a>
              </li>
              <li class="list-group-item">
                <b>Email:</b> <a class="float-right">{{$user->email}}</a>
              </li>
              <li class="list-group-item">
                <b>Status:</b> 
                  <a class="float-right">
                    <span class="badge @if($user->verified_at) badge-success @else badge-danger @endif">
                      {{isset($user->verified_at) ? 'Verified At'.' '.date('Y-m-d',strtotime($user->verified_at)) : 'Not Yet Verified'}}
                    </span>
                  </a>
              </li>
                <button class="btn btn-danger">Block User</button>
            </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-8 col-md-8">
          <div class="card">
            @if($type == 'user')
              @include('admin.views.accounts.components.user.transaction-history')
            @else
              @include('admin.views.accounts.components.partner.shop_info')
            @endif
          </div>
        </div>
      </div>
   
  </div>
@endsection