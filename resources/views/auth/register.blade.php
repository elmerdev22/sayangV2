@extends('front-end.layout')
@section('title','Register')
@section('content')

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">
        <!-- ============================ COMPONENT REGISTER   ================================= -->
        <div class="card mx-auto" style="max-width:520px; margin-top:40px;">
            <article class="card-body">
                <header class="mb-4"><h4 class="card-title">Register</h4></header>
                
                <!-- ============================ COMPONENT REGISTER FORM  ================================= -->
                @livewire('auth.register')
                <!-- ============================ COMPONENT REGISTER  FORM END.// ================================= -->

                <p class="text-center">-OR-</p>
                <a href="{{route('login-redirect.socialite', ['provider' => 'facebook', 'type' => 'user'])}}" class="btn btn-light btn-block mb-2"> <i class="fab fa-facebook-f"></i> &nbsp  Register with Facebook</a>
                <a href="{{route('login-redirect.socialite', ['provider' => 'google', 'type' => 'user'])}}" class="btn btn-light btn-block mb-4"> <i class="fab fa-google"></i> &nbsp Register with Google</a>
            </article><!-- card-body.// -->
        </div> <!-- card .// -->
        <p class="text-center mt-4">Have an account? <a href="{{url('/login')}}">Sign In</a></p>
        <br><br>
        <!-- ============================ COMPONENT REGISTER  END.// ================================= -->
    </div>
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->  
@endsection