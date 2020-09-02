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
    background-color: white;
    opacity: 0.8;
    width: 600px;
  }

</style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h2 class="m-0 text-dark"> Login Page</h2> --}}
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active text-white">Be a partner</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row justify-content-center">
            <div class="jumbotron pt-4">
              <h1 class="display-4">Grow with us.</h1>
              <p class="lead">Zero Waste. Maximum Profits.</p>
              <hr class="my-4">
              <form>
                    <div class="form-row">
                        <div class="col form-group">
                            <label>First name</label>
                              <input type="text" class="form-control" placeholder="">
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Last name</label>
                              <input type="text" class="form-control" placeholder="">
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row end.// -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="">
                        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div> <!-- form-group end.// -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Create password</label>
                            <input class="form-control" type="password">
                        </div> <!-- form-group end.// -->
                        <div class="form-group col-md-6">
                            <label>Confirm password</label>
                            <input class="form-control" type="password">
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="form-group">
                        <a href="{{url('/register/merchant/verify')}}" class="btn btn-warning text-white btn-block">
                           Proceed
                        </a>
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> I am agree with <a href="#">terms and contitions</a>  </div> </label>
                    </div> <!-- form-group end.// -->
                  </form>

                  <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="{{url('/account/complete-details')}}" class="btn btn-block btn-primary">
                      <i class="fab fa-facebook mr-2"></i>
                      Sign up using Facebook
                    </a>
                    <a href="{{url('/account/complete-details')}}" class="btn btn-block btn-danger">
                      <i class="fab fa-google-plus mr-2"></i>
                      Sign up using Google+
                    </a>
                  </div>

                  <a href="{{url('/login')}}" class="text-center">I already have a account</a>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
