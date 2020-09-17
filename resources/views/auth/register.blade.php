@extends('front-end.layout')
@section('title','Register')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6 offset-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Register</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row justify-content-center">
            <div class="pb-5">
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body register-card-body">
                  <h4 class="text-center">Register New User</h4>
                  <hr>

                  @livewire('auth.register')

                  <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="{{url('login/facebook')}}" class="btn btn-block btn-primary">
                      <i class="fab fa-facebook mr-2"></i>
                      Sign up using Facebook
                    </a>
                    <a href="{{url('login/google')}}" class="btn btn-block btn-danger">
                      <i class="fab fa-google-plus mr-2"></i>
                      Sign up using Google+
                    </a>
                  </div>

                  <a href="{{url('/login')}}" class="text-center text-blue">I already have a account</a>
                </div>
                <!-- /.form-box -->
              </div>
            </div>
           </div>
      </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
