@extends('front-end.layout')
@section('title','Change Password')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Change Password',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Change Password'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
          
<div class="row">
    <aside class="col-md-3 mb-3">
        @include('front-end.includes.user.aside')
    </aside> <!-- col.// -->
    <main class="col-md-9">
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title">Change Password</h5> 
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        @livewire('auth.change-password', ['redirect' => 'user_login'])
                    </div>
                </div>
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

@endsection