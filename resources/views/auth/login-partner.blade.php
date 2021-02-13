@extends('front-end.layout')
@section('title','Partner Login')
@section('content')

<section class="section-content padding-y">
    <div class="container">
        <!-- =========================  COMPONENT LOGIN PARTNER ========================= --> 
        <div class="row">
            <div class="col-md-7 d-none d-md-block d-lg-block" style="background: url('{{asset('images/default-photo/login-partner2.jpg')}}')  no-repeat center ">
            </div>
            <div class="col-md-5">
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
            </div>
        </div> <!-- row.// -->
        <!-- =========================  COMPONENT LOGIN PARTNER.// ========================= --> 
    </div> <!-- container .//  -->
</section>
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