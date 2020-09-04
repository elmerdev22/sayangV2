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

    @yield('css')
    @livewireStyles
</head>
<body class="hold-transition layout-top-nav" style="height: auto;">
    @yield('messenger-chat-plugin')
        <!-- Preloader -->
{{--     <div class="preloader">
      <div class="preloader-inner">
        <div class="preloader-icon">
          <span></span>
          <span></span>
        </div>
      </div>
    </div> --}}
    <!-- End Preloader -->
    <div class="wrapper">
        <header>
            @include('front-end.header.index')
        </header>

        <div class="content-wrapper content-wrapper-front-end">
            @yield('content')
        </div>

        <footer class="pt-5 bg-light">
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
  <script src="{{ asset('template/assets/dist/js/sweetalert2.min.js') }}"></script>
  <!-- Toast Alert -->
  <script src="{{asset('template/assets/plugins/toastr/toastr.min.js')}}"></script>
  <!-- Preloader -->
  <script src="{{asset('template/assets/dist/js/preloader.js')}}"></script>
  <!-- AOS script-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>
    AOS.init();
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('36e9cc6f189b952fa2d0', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(message) {
      window.livewire.emit('notifications', message);
    });
    
    toastr.options = {
      "closeButton": true,
      "newestOnTop": true,
      "progressBar": true,
    }
    // window.livewire.on('notifications', message => {
    //     toastr.success('New Notification');
    // });
  </script>
  @yield('js')
  @stack('scripts')
</body>
</html>
