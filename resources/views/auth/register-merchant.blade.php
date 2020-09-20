@extends('front-end.layout')
@section('title','Be a Partner')
@section('css')
<style type="text/css">
  .content-wrapper-front-end{
    background: url('{{asset('images/default-photo/be-a-partner.jpg')}}');
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>
@endsection
@section('content')
<div class="row mt-5 pb-5">
  <div class="col-md-6">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-body register-card-body">
          <h4 class="text-center">Register New User</h4>
          <hr>
          @livewire('auth.register-merchant')
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="jumbotron bg-transparent text-white">
      <h1 class="display-3 font-weight-bold" data-aos="fade-right" data-aos-duration="500" style="text-shadow: 3px 2px 10px #000;">Grow with us.</h1>
      <p class="lead" data-aos="fade-right" data-aos-duration="700" style="text-shadow: 3px 2px 7px #000; font-size: 20px;">Zero Waste. Maximum Profits.</p>
    </div>
  </div>
</div>
@endsection
@section('js')

@endsection