@extends('front-end.layout')
@section('title','Login')
@section('page_header')
    @php 
        $page_header = [
            'title'       => '',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Login'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
<div class="row">
    <div class="col-md-7 d-none d-md-block d-lg-block" style="background: url('{{asset('images/default-photo/login-user2.jpg')}}') no-repeat">
    </div>
    <div class="col-md-5">
        <div class="row justify-content-center">
            <div class="login-box pb-5 ">
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Sign in to start your session</p>
                        @if(\Session::has('login_provider_alert'))
                            <p class="text-danger text-center">
                                <i class="fas fa-exclamation-triangle"></i> {!!\Session::get('login_provider_alert')!!}
                            </p>
                        @endif
        
                        @livewire('auth.login')
        
                        <div class="social-auth-links text-center mb-3">
                            <p>- OR -</p>
                            <a href="{{route('login-redirect.socialite', ['provider' => 'facebook', 'type' => 'user'])}}" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                            </a>
                            <a href="{{route('login-redirect.socialite', ['provider' => 'google', 'type' => 'user'])}}" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                            </a>
                        </div>
                        <!-- /.social-auth-links -->
        
                        <p class="mb-1">
                            <a href="{{ route('password.request') }}" class="text-blue">I forgot my password</a>
                        </p>
                        <p class="mb-0">
                            <a href="{{route('register')}}" class="text-blue">Register a new account</a>
                        </p>
                    </div><!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    @if(session('success_change_password'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Yay!',
                text: '{{session('success_change_password')}}',
            })
        </script>
    @endif
@endsection