@extends('front-end.layout')
@section('title','Partner Login')
@section('content')
<div class="row mt-5 pb-5">
  <div class="col-md-7 d-none d-md-block d-lg-block" style="background: url('{{asset('images/default-photo/login-partner.jpg')}}') !important;">
  </div>
  <div class="col-md-5">
    <div class="card">
      <div class="card-body register-card-body">
        <h4 class="text-center">Partner Login</h4>
        <hr>
        @livewire('auth.login-partner')
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')

@endsection