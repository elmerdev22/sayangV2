@extends('front-end.layout')
@section('title','Be a Partner')
@section('content')
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">
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
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->  
@endsection