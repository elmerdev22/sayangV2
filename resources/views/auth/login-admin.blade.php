@extends('front-end.layout')
@section('title','Admin Login')
@section('page_header')
    @php 
        $page_header = [
            'title'       => '',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Admin Login'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content" style="min-height:84vh">
    <div class="container">
        <!-- ============================ COMPONENT LOGIN   ================================= -->
        <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
            <div class="card-body">
                <div class="text-center mb-4">
                    <img class="icon icon-lg rounded-circle border" style="width: 100px; height: 100px;" src="{{UploadUtility::content_photo('icon', false)}}">
                </div>
                <!-- ============================ COMPONENT LOGIN FORM  ================================= -->
                @livewire('auth.login-admin')
                <!-- ============================ COMPONENT LOGIN  FORM END.// ================================= -->
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->
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