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
<!-- Modal -->
<div class="modal fade" id="terms_and_conditions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection