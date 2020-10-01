@extends('front-end.layout')
@section('title','Partner Login')
@section('css')
<style type="text/css">
  .content-wrapper-front-end{
    background: url('{{asset('images/default-photo/login-partner.jpg')}}') !important;
    /* Center and scale the image nicely */
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-size: cover !important;
  }
</style>
@endsection
@section('content')
<div class="row mt-5 pb-5">
  <div class="col-md-7 d-none d-md-block d-lg-block">
    <div class="jumbotron bg-transparent text-white">
      <img src="{{asset('images/logo/logo_old.png')}}" height="150" class="d-inline-block align-top" alt="">
      <h1 class="display-2" data-aos="fade-right" data-aos-duration="500" style="text-shadow: 1px 2px 5px #000;">Grow with us.</h1>
      <p class="lead" data-aos="fade-right" data-aos-duration="700" style="text-shadow: 2px 1px 3px #000; font-size: 20px;">Zero Waste. Maximum Profits.</p>
    </div>
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