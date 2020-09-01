<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(Request::is('/'))
      <title>{{ env('APP_NAME') }} - @yield('title')</title>
    @else
      <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('template/assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('template/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    @yield('css')
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{asset('template/assets/dist/css/custom-css-bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/responsive.css')}}">
    <!-- Toast Alert-->
    <link rel="stylesheet" href="{{asset('template/assets/plugins/toastr/toastr.min.css')}}">
    <!-- Preloader -->
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('template/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
     <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/preloader.css')}}">
    <!-- AOS animation-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style type="text/css">
      #welcome{
        background: url('{{asset('images/default-photo/w2.jpg')}}');
        background-size: cover;
        background-repeat: no-repeat;
      }
    </style>
    @yield('css')
    @livewireStyles
</head>
<body class="hold-transition layout-top-nav" style="height: auto;">
    @yield('messenger-chat-plugin')
    <div class="wrapper">
        <header>
            @include('front-end.header.index')
        </header>

        <div class="content-wrapper content-wrapper-front-end">
            @yield('content')
        </div>

        <footer class="pt-3 my-md-3 pt-md-3 bg-light">
            @include('front-end.footer.index')
        </footer>
    </div>
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  @livewireScripts
  <script src="{{asset('template/assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('template/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
  <!-- Toast Alert -->
  <script src="{{asset('template/assets/plugins/toastr/toastr.min.js')}}"></script>
  <!-- AOS script-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  @yield('js')
  @stack('scripts')
</body>
</html>
