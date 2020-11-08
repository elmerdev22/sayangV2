@extends('front-end.layout')
@section('title','Admin Login')
@section('page_header')
    @php 
        $page_header = [
            'title'       => '',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Admin Login'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="login-box pb-5">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{asset('images/default-photo/admin.png')}}">
                    </div>
                </div>
                <p class="login-box-msg">Sign in to start your session</p>
                @if(\Session::has('login_provider_alert'))
                    <p class="text-danger text-center">
                        <i class="fas fa-exclamation-triangle"></i> {!!\Session::get('login_provider_alert')!!}
                    </p>
                @endif

                @livewire('auth.login-admin')

            </div><!-- /.login-card-body -->
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