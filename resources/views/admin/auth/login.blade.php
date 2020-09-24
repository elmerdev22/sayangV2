@extends('admin.layouts.app')
@section('title')
    Admin Login
@endsection
@section('content')
<section class="py-4">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="login-box">
                <div class="login-logo">
                    <a href="#"><b>ADMIN</b> - SAYANG!</a>
                </div>
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Sign in to start your session</p>
                        @livewire('admin.views.auth.login')

                    </div><!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection