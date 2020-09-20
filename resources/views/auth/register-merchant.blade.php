@extends('front-end.layout')
@section('title','Be a partner')
@section('css')
<style type="text/css">
  .content-wrapper-front-end{
    background: url('{{asset('images/default-photo/be-a-partner.jpg')}}');
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .jumbotron{
    width: 600px;
  }

</style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
            <div class="jumbotron bg-transparent text-white">
              <h1 class="display-4 font-weight-bold" data-aos="fade-right" data-aos-duration="500" style="text-shadow: 3px 2px 10px #000;">Grow with us.</h1>
              <p class="lead" data-aos="fade-right" data-aos-duration="700" style="text-shadow: 3px 2px 7px #000;">Zero Waste. Maximum Profits.</p>
                @livewire('auth.register-merchant')
                <div class="social-auth-links text-center">
                  <p>- OR -</p>
                  <a href="{{route('login-redirect.socialite', ['provider' => 'facebook', 'type' => 'partner'])}}" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    Sign up using Facebook
                  </a>
                  <a href="{{route('login-redirect.socialite', ['provider' => 'google', 'type' => 'partner'])}}" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Sign up using Google+
                  </a>
                </div>
                
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
