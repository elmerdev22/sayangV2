@extends('front-end.layout')
@section('title','Be a Partner')
@section('content')
<div class="row mt-5 pb-5">
  <div class="col-md-7 d-none d-md-block d-lg-block " style="background: url('{{asset('images/default-photo/register-partner.jpg')}}')">
    <div class="jumbotron bg-transparent ">
      <h1 class="jumbotron-heading display-3" data-aos="fade-right" data-aos-duration="500">
        <b>Grow with us.</b>
      </h1>
      <p class="lead" data-aos="fade-right" data-aos-duration="700">Zero Waste. Maximum Profits.</p>
      <p>
    </div>
  </div>
  <div class="col-md-5">
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