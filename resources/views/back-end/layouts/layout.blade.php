<!DOCTYPE html>
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
    @yield('css')
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

          <link rel="stylesheet" href="{{asset('template/assets/dist/css/sweetalert2.min.css')}}">
        <!-- end of to be removed packages -->
    @else
      <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @endif
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sayang-layout-navbar-fixed">
    <!-- Load Facebook SDK for JavaScript -->
    {{-- 
    <!-- comment for the meantime -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
            xfbml            : true,
            version          : 'v8.0'
            });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="100185501825589" theme_color="#FFDE59"></div>
    <!-- /.comment for the meantime -->
    --}} 

    <!-- Preloader -->
    <!-- <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon"><span></span><span></span></div>
        </div>
    </div> -->
    <!-- End Preloader -->
    <div class="wrapper">

        <!-- Navbar header -->
        @include('back-end.layouts.includes.header')

        <!-- Main Sidebar Container -->
        @include('back-end.layouts.includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('page_header')
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @yield('content')
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <footer class="main-footer">
            @include('back-end.layouts.includes.footer')
        </footer>
    </div>
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
     <!-- Admin lte -->
     <script src="{{asset('template/assets/dist/js/adminlte.min.js')}}"></script>
    <!-- AOS script-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Stepper -->
    <script src="{{asset('template/assets/dist/js/stepper.min.js')}}"></script>
    <!-- end of to be removed packages -->
  @else
    <script src="{{ mix('js/app.js') }}"></script>
  @endif


  <script type="text/javascript">
    AOS.init();
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var key = '{{env('PUSHER_APP_KEY')}}';
    var pusher = new Pusher(key, {
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

    window.livewire.on('toast_alert', param => {
        toastr[param['type']](param['message']);
    });

    window.livewire.on('alert', param => {
      var config = {
        position  : 'center',
      };

      if('title' in param)
        config['title'] = param['title'];
      if('type' in param)
        config['icon'] = param['type'];
      if('message' in param)
        config['html'] = param['message'];
      if('showConfirmButton' in param)
        config['showConfirmButton'] = param['showConfirmButton'];
      if('timer' in param)
        config['timer'] = param['timer'];

      Swal.fire(config);
    });

    window.livewire.on('alert_link', param => {
      Swal.fire({
          position         : 'center',
          icon             : param['type'],
          html             : param['message'],
          title            : param['title'],
          showConfirmButton: true,
          allowOutsideClick: false,
      }).then((result) => {
          if(result.value){
            if('redirect' in param){
              window.location = param['redirect'];                       
            }else{
              window.location.reload();                       
            }
          }
      });
    });
    
    
  </script>

  @yield('js')
  @stack('scripts')
</body>
</html>