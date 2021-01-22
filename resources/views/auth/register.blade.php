@extends('front-end.layout')
@section('title','Register')
@section('page_header')
    @php 
        $page_header = [
            'title'       => '',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Register'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
<div class="row">
  <div class="col-md-6 d-none d-md-block d-lg-block" style="background: url('{{asset('images/default-photo/register-user2.jpg')}}') no-repeat">
  </div>
  <div class="col-md-6">
    <div class="row justify-content-center">
      <div class="col-md-10 pb-5">
          <!-- /.login-logo -->
        <div class="card">
          <div class="card-body register-card-body">
            <h4 class="text-center">Register New User</h4>
                <hr>

                @livewire('auth.register')

                <div class="social-auth-links text-center">
                  <p>- OR -</p>
                  <a href="{{route('login-redirect.socialite', ['provider' => 'facebook', 'type' => 'user'])}}" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    Sign up using Facebook
                  </a>
                  <a href="{{route('login-redirect.socialite', ['provider' => 'google', 'type' => 'user'])}}" class="btn btn-block btn-danger">
                    <i class="fab fa-google mr-2"></i>
                    Sign up using Google
                  </a>
                </div>

                <a href="{{url('/login')}}" class="text-gray">I already have an account</a>
              </div>
              <!-- /.form-box -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection