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
              <form>
                <div class="form-row">
                  <div class="col form-group">
                    <input type="text" class="form-control" placeholder="First name">
                  </div> <!-- form-group end.// -->
                  <div class="col form-group">
                    <input type="text" class="form-control" placeholder="Last name">
                  </div> <!-- form-group end.// -->
                </div> <!-- form-row end.// -->
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email Address">
                    {{-- <small class="form-text text-dark">We'll never share your email with anyone else.</small> --}}
                </div> <!-- form-group end.// -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input class="form-control" type="password" placeholder="Create password">
                  </div> <!-- form-group end.// -->
                  <div class="form-group col-md-6">
                    <input class="form-control" type="password" placeholder="Confirm password">
                  </div> <!-- form-group end.// -->
                </div>
                <div class="form-group">
                    <a href="{{url('/register/merchant/verify')}}" class="btn btn-warning text-white btn-block">
                       Proceed
                    </a>
                </div> <!-- form-group// -->
              </form>

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
