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
      @if(env('APP_DEPLOY') == 'production')
        <!-- Kindly removed once the packages need is working properly -->
          <!-- Font Awesome -->
          <link rel="stylesheet" href="{{asset('template/assets/plugins/fontawesome-free/css/all.min.css')}}">
          <!-- Ionicons -->
          <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
          <!-- icheck bootstrap -->
          <link rel="stylesheet" href="{{asset('template/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
          <!-- Theme style -->
          <link rel="stylesheet" href="{{asset('template/assets/dist/css/adminlte.css')}}">
          <link rel="stylesheet" href="{{asset('template/assets/dist/css/custom.css')}}">
          <link rel="stylesheet" href="{{asset('template/assets/dist/css/responsive.css')}}">
          <!-- Toast Alert-->
          <link rel="stylesheet" href="{{asset('template/assets/plugins/toastr/toastr.min.css')}}">
          <!-- Preloader -->
          <!-- overlayScrollbars -->
          {{-- <link rel="stylesheet" href="{{asset('template/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}"> --}}
          <!-- Google Font: Source Sans Pro -->
          <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
          <link rel="stylesheet" href="{{asset('template/assets/dist/css/preloader.css')}}">
          <!-- AOS animation-->
          <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <!-- end of to be removed packages -->
      @else
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
      @endif
      @yield('css')
      @livewireStyles
  </head>
  <body class="layout-fixed layout-navbar-fixed">
      @yield('content')
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->

    @livewireScripts
    @if(env('APP_DEPLOY') == 'production')
      <!-- Kindly removed once the packages need is working properly -->
      <script src="{{asset('template/assets/plugins/jquery/jquery.min.js')}}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{asset('template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <!-- overlayScrollbars -->
      {{-- <script src="{{asset('template/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script> --}}
      <!-- SweetAlert2 -->
      <script src="{{ asset('template/assets/dist/js/sweetalert2.min.js') }}"></script>
      <!-- Toast Alert -->
      <script src="{{asset('template/assets/plugins/toastr/toastr.min.js')}}"></script>
      <!-- Preloader -->
      <script src="{{asset('template/assets/dist/js/preloader.js')}}"></script>
      <!-- Animate js -->
      <script src="{{asset('template/assets/dist/js/animate.js')}}"></script>
      <!-- AOS script-->
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
      <!-- end of to be removed packages -->
    @else
      <script src="{{ mix('js/app.js') }}"></script>
    @endif
    @yield('js')
    @stack('scripts')
  </body>
</html>
