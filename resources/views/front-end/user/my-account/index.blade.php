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
                                <span class="badge badge-success">Active</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @livewire('front-end.user.my-account.index.account-information')
                    </div>
                </div>
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

@endsection
@section('js')

@endsection