@extends('admin.layouts.app')
@section('title')
    Admin Login
@endsection
@section('content')
    <section class="h-100 p-3">
        <div class="d-table h-100 w-100">
            <div class="d-table-cell align-middle h-100">
                <div class="row">
                    <div class="col-md-2 offset-md-5">
                        <div class="card shadow">                      
                            <div class="card-body">
                                <h4 class="mb-2">{{ __('Log in') }}</h4>
                                <form method="POST" action="{{ route('admin.index') }}">
                                    @csrf
                                    <div class="form-group mt-4 mb-3">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username')}}" placeholder="{{__('Username')}}" autofocus>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div><!-- input-group-text -->
                                            </div><!-- input-group-append -->
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div><!-- input-group mb-3 -->
                                      
                                    </div><!-- /.form-group -->

                                    <div class="form-group mt-4 mb-3">
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" autocomplete="current-password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div><!-- input-group-text -->
                                            </div><!-- input-group-append -->
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div><!-- input-group mb-3 -->
                                    
                                    </div><!-- /.form-group -->

                                    <div class="form-group my-4">
                                        <button type="submit" class="btn btn-warning btn-block">
                                                {{ __('Log in') }}
                                        </button>
                                    </div><!-- /.form-group -->

                                </form>

                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div><!-- /.col-md-4 -->
                </div>
            </div><!-- /.row align-items-center h-100 -->
        </div><!-- /.container h-100 -->
    </section><!-- /.h-100 py-5 -->
@endsection