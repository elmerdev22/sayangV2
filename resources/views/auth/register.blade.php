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
  <div class="col-md-6 d-none d-md-block d-lg-block" style="background: url('{{asset('images/default-photo/register-user.png')}}') no-repeat">
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
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="terms_and_conditions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection