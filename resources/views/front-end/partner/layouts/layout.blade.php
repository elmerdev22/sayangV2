<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(Request::is('/'))
      <title>{{ Utility::settings('app_name') }} - @yield('title')</title>
    @else
      <title>@yield('title') | {{ Utility::settings('app_name') }}</title>
    @endif
      <link rel="icon" type="image/icon" href="{{UploadUtility::content_photo('icon', false)}}">
      <!-- Kindly removed once the packages need is working properly -->
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{asset('template/assets/plugins/fontawesome-free/css/all.min.css')}}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{asset('template/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
      <!-- Theme style -->
      <link href="{{ mix('css/AdminLTE.css') }}" rel="stylesheet">
      {{-- <link rel="stylesheet" href="{{asset('template/assets/dist/css/adminlte.css')}}"> --}}
      <link rel="stylesheet" href="{{asset('template/assets/dist/css/custom.css')}}">
      <link rel="stylesheet" href="{{asset('template/assets/dist/css/responsive.css')}}">
      <link rel="stylesheet" href="{{asset('template/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
      <!-- Google Font: Quicksand -->
      <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
      <!-- end of to be removed packages -->
    
    @yield('css')
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sayang-layout-navbar-fixed">
    <!-- Load Facebook SDK for JavaScript -->
    @yield('messenger')
    
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
  <!-- Kindly removed once the packages need is working properly -->
  <script src="{{asset('template/assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{asset('template/assets/dist/js/sweetalert2.min.js') }}"></script>
  <script src="{{asset('template/assets/dist/js/animate.js')}}"></script>
  <!-- Admin lte -->
  <script src="{{asset('template/assets/dist/js/adminlte.min.js')}}"></script>
  <!-- SCroll bar -->
  <script src="{{asset('template/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

  <script src="{{asset('template/assets/dist/js/export/FileSaver.min.js') }}"></script>
  <script src="{{asset('template/assets/dist/js/export/tableexport.min.js') }}"></script>
    
  <script>
    ExportTable();
    function ExportTable(filename){
        $('.sayang-datatables').tableExport({
            position: 'top',
            formats : ['xls', 'csv'],
        });
        $('.xls').addClass('btn btn-primary btn-sm mx-1');
        $('.csv').addClass('btn btn-primary btn-sm mx-1');
    }
  </script>
  <!-- end of to be removed packages -->

  <script type="text/javascript">
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
