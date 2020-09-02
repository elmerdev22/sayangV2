@extends('front-end.layout')
@section('title','Verify Email')
@section('css')
<style type="text/css">
  .content-wrapper-front-end{
    background: url('{{asset('images/default-photo/be-a-partner.jpg')}}');
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .login-box{
    opacity: 0.8;
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active text-white">Verify Email</li>
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
            <div class="login-box pb-5">
            <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body">
                <p class="login-box-msg">We sent 6 digit code in your email</p>

                <form>
                  <div class="form-group mb-3">
                    <input type="text" class="form-control text-center" placeholder="Verifiation Code">
                  </div>
                  <div class="form-group mb-3">
                    <a href="{{url('/account/complete-details')}}" class="btn btn-warning text-white btn-block">
                        Confirm Verification
                    </a>
                  </div>

                  <span href="{{url('/login')}}" class="text-center">didn't receive code ? <a href="#" class="">Resend</a></span>
                </form>
              </div>
              <!-- /.login-card-body -->
            </div>
          </div>
          </div>
      </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
