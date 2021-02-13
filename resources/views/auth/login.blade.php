@extends('front-end.layout')
@section('title','Login')

@section('content')
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content" style="min-height:84vh">
    <div class="container">
        <!-- ============================ COMPONENT LOGIN   ================================= -->
        <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
            <div class="card-body">
                <h4 class="card-title mb-4">Sign in</h4>
                @if(\Session::has('login_provider_alert'))
                    <p class="text-danger text-center">
                        <i class="fas fa-exclamation-triangle"></i> {!!\Session::get('login_provider_alert')!!}
                    </p>
                @endif
                
                <!-- ============================ COMPONENT LOGIN FORM  ================================= -->
                @livewire('auth.login')
                <!-- ============================ COMPONENT LOGIN  FORM END.// ================================= -->

                <p class="text-center">-OR-</p>
                <a href="{{route('login-redirect.socialite', ['provider' => 'facebook', 'type' => 'user'])}}" class="btn btn-light btn-block mb-2"> <i class="fab fa-facebook-f"></i> &nbsp  Sign in with Facebook</a>
                <a href="{{route('login-redirect.socialite', ['provider' => 'google', 'type' => 'user'])}}" class="btn btn-light btn-block mb-4"> <i class="fab fa-google"></i> &nbsp  Sign in with Google</a>
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->
        <p class="text-center mt-4">Don't have account? <a href="{{url('/register')}}">Sign up</a></p>
        <br><br>
        <!-- ============================ COMPONENT LOGIN  END.// ================================= -->
    </div>
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
@section('js')
    @if(session('success_change_password'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Yay!',
                text: '{{session('success_change_password')}}',
            })
        </script>
    @endif
@endsection