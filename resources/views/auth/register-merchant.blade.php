@extends('front-end.layout')
@section('title','Be a Partner')
@section('css')
<style type="text/css">
  .content-wrapper-front-end{
    background: url('{{asset('images/default-photo/be-a-partner.jpg')}}') !important;
    /* Center and scale the image nicely */
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-size: cover !important;
  }
</style>
@endsection
@section('content')
<div class="row mt-5 pb-5">
  <div class="col-md-5 offset-md-1">
    <div class="card">
      <div class="card-body register-card-body">
        <h4 class="text-center">Be a Partner</h4>
        <hr>
        @livewire('auth.register-merchant')
      </div>
    </div>
  </div>
  <div class="col-md-6 d-none d-md-block d-lg-block">
    <div class="jumbotron bg-transparent text-white">
      <h1 class="display-3 font-weight-bold" data-aos="fade-right" data-aos-duration="500" style="text-shadow: 3px 2px 10px #000;">Grow with us.</h1>
      <p class="lead" data-aos="fade-right" data-aos-duration="700" style="text-shadow: 3px 2px 7px #000; font-size: 20px;">Zero Waste. Maximum Profits.</p>
    </div>
  </div>
</div>
@endsection
@section('js')

@endsection