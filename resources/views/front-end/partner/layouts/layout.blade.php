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
          <!-- Google Font: Quicksand -->
          <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
          <!-- end of to be removed packages -->
    @else
      <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @endif
    @yield('css')
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sayang-layout-navbar-fixed">
    <!-- Preloader -->
    <!-- <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon"><span></span><span></span></div>
        </div>
    </div> -->
    <!-- End Preloader -->
    <div class="wrapper">

        <!-- Navbar header -->
        @include('front-end.partner.layouts.includes.header')

        <!-- Main Sidebar Container -->
        @include('front-end.partner.layouts.includes.sidebar')

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
            @include('front-end.partner.layouts.includes.footer')
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
    <!-- SweetAlert2 -->
    <script src="{{ asset('template/assets/dist/js/sweetalert2.min.js') }}"></script>
    <script src="{{asset('template/assets/dist/js/animate.js')}}"></script>
    <!-- Admin lte -->
    <script src="{{asset('template/assets/dist/js/adminlte.min.js')}}"></script>
    <!-- Pusher-->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- end of to be removed packages -->
  @else
    <script src="{{ mix('js/app.js') }}"></script>
  @endif

  <script type="text/javascript">
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
