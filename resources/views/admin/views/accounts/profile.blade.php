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
        <div class="card bg-white">
         
          <div class="card-body">
            <div class="row p-0">
              <div class="col-9">
                <h2 class="lead"><b>{{ucwords($user->first_name.' '.$user->last_name)}}</b></h2>
                <p class="text-muted text-sm"><b>Email: </b> {{$user->email}} </p>
                <p class="text-muted text-sm"><b>Gender: </b> {{$user->gender}} </p>
                <p class="text-muted text-sm"><b>Birthday: </b> {{$user->birth_date}} </p>
                <p class="text-muted text-sm"><b>Account Status: </b> 
                  <span class="badge @if($user->verified_at) badge-success @else badge-danger @endif">
                    {{isset($user->verified_at) ? 'Verified At'.' '.date('Y-m-d',strtotime($user->verified_at)) : 'Not Yet Verified'}}
                  </span> 
                </p>
                
              </div>
              <div class="col-3">
                <img src="{{$user->photo_provider_link ?? asset('images/default-photo/account.png')}}" alt="" class="img-circle img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="col-12 col-sm-8 col-md-8">
          <div class="card card-warning card-outline">
            @if($type == 'user')
              @include('admin.views.accounts.components.user.transaction-history')
            @else
              @include('admin.views.accounts.components.partner.shop_info')
            @endif
          </div>
        </div>
   
  </div>
@endsection

  