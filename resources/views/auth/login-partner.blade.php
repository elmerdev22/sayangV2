@extends('front-end.layout')
@section('title','Partner Login')
@section('content')
<div class="row mt-5 pb-5">
    <div class="col-md-7 d-none d-md-block d-lg-block" style="background: url('{{asset('images/default-photo/login-partner2.jpg')}}')  no-repeat center bottom">
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body register-card-body">
                <h4 class="text-center">Partner Login</h4>
                <hr>
                @livewire('auth.login-partner')
            </div>
        </div>
    </div>
</div>
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