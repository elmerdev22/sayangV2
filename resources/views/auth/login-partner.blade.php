@extends('front-end.layout')
@section('title','Partner Login')
@section('content')

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content" style="min-height:84vh">
    <div class="container">
        <!-- ============================ COMPONENT LOGIN   ================================= -->
        <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
            <div class="card-body">
                <h4 class="card-title mb-4">Sign in as Partner</h4>
                <!-- ============================ COMPONENT LOGIN FORM  ================================= -->
                @livewire('auth.login-partner')
                <!-- ============================ COMPONENT LOGIN  FORM END.// ================================= -->
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->
        <p class="text-center mt-4">Not Yet a Partner? <a href="{{route('partner.register')}}">Be a partner now!</a></p>
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