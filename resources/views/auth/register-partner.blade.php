@extends('front-end.layout')
@section('title','Be a Partner')
@section('css')
<style type="text/css">
  .content-wrapper-front-end{
    background: url('{{asset('images/default-photo/be-a-partner-2.jpg')}}') !important;
    /* Center and scale the image nicely */
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-size: cover !important;
  }
</style>
@endsection
@section('content')
<div class="row mt-5 pb-5">
  <div class="col-md-6 d-none d-md-block d-lg-block">
    <div class="jumbotron bg-transparent text-white">
      <img src="{{asset('images/logo/logo_old.png')}}" height="150" class="d-inline-block align-top" alt="">
      <h1 class="jumbotron-heading display-3 text-white" data-aos="fade-right" data-aos-duration="500">
        <b>Grow with us.</b>
      </h1>
      <p class="lead text-white" data-aos="fade-right" data-aos-duration="700">Zero Waste. Maximum Profits.</p>
      <p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-body register-card-body">
        <h4 class="text-center">Be a Partner</h4>
        <hr>
        @livewire('auth.register-partner')
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')

@endsection