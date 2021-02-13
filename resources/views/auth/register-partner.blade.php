@extends('front-end.layout')
@section('title','Be a Partner')
@section('content')
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-none d-md-block d-lg-block" style="background: url('{{asset('images/default-photo/login-partner2.jpg')}}')  no-repeat center ">
                <div class="jumbotron bg-transparent ">
                    <h1 class="jumbotron-heading display-3">
                        <b>Grow with us.</b>
                    </h1>
                    <p class="lead">Zero Waste. Maximum Profits.</p>
                  </div>
            </div>
            <div class="col-md-6">
                <!-- ============================ COMPONENT REGISTER   ================================= -->
                <div class="card mx-auto" style="max-width:520px; margin-top:40px;">
                    <article class="card-body">
                        <header class="mb-4"><h4 class="card-title">Be a Partner</h4></header>
                        
                        <!-- ============================ COMPONENT REGISTER FORM  ================================= -->
                        @livewire('auth.register-partner')
                        <!-- ============================ COMPONENT REGISTER  FORM END.// ================================= -->
        
                    </article><!-- card-body.// -->
                </div> <!-- card .// -->
                <p class="text-center mt-4">Have an account? <a href="{{route('partner.login')}}">Sign In</a></p>
                <br><br>
                <!-- ============================ COMPONENT REGISTER  END.// ================================= -->
            </div>
        </div> <!-- row.// -->
    </div>
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->  
@endsection