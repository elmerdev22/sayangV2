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

    <link rel="icon" type="image/icon" href="{{UploadUtility::content_photo('icon')}}">
    @if(env('APP_DEPLOY') == 'production')
        <!-- Kindly removed once the packages need is working properly -->
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('template/assets/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{asset('template/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/assets/plugins/pace-progress/themes/yellow/pace-theme-minimal.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('template/assets/dist/css/adminlte.css')}}">
        <link rel="stylesheet" href="{{asset('template/assets/dist/css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('template/assets/dist/css/responsive.css')}}">
        <!-- Google Font: Quicksand -->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet"><!-- end of to be removed packages -->
        <style>  
            .sayang-card-img-listing{
                /* optional way, set loading as background */
                background-image: url("{{Utility::img_source('loading')}}");
                background-repeat: no-repeat;
                background-size: 50%;
                background-position: center;
            }
        </style>
    @else
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @endif
    @yield('css')
    @livewireStyles
</head>
<body class="hold-transition layout-top-nav" style="height: auto;">
    <!-- Load Facebook SDK for JavaScript -->
    @yield('messenger')
    <!-- End Preloader -->
    <div class="wrapper">
        @if(!Request::is('admin/login'))
            <header>
                @include('front-end.header.index')
            </header>
        @endif
        @php 
            $page_fluid = ['', '/','help-centre'];
        @endphp
        <div class="content-wrapper content-wrapper-front-end">
            @if(!Request::is('admin/login'))
                @yield('page_header')
            @endif
            <!-- Main content -->
            <div class="content p-0">
                <div class="@if(in_array(\Request::segment(1), $page_fluid)) container-fluid p-0 m-0 @else container @endif">
                    <div class="section-content padding-y">
                        @yield('content')
                    </div>
                </div><!-- /.container -->
            </div>
            <!-- /.content -->
        </div>

        @if(!Request::is('admin/login'))
            <footer class="pt-4 shadow">
                @include('front-end.footer.index')
            </footer>
        @endif
        <a id="back-to-top" href="#" style="display: none;" class="btn btn-warning rounded back-to-top shadow" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->

    @livewireScripts
    @if(env('APP_DEPLOY') == 'production')
        <!-- Kindly removed once the packages need is working properly -->
        <script src="{{asset('template/assets/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('template/assets/plugins/pace-progress/pace.min.js')}}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('template/assets/dist/js/sweetalert2.min.js') }}"></script>
        <!-- Preloader -->
        <script src="{{asset('template/assets/dist/js/preloader.js')}}"></script>
        <!-- Admin lte -->
        <script src="{{asset('template/assets/dist/js/adminlte.min.js')}}"></script>
        <!-- Pusher JS -->
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <!-- Lazy Loading -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.plugins.min.js"></script>
        <!-- Countdown JS -->
        <script src="{{asset('template/assets/dist/js/countdown.js')}}"></script>
        <!-- Custom JS -->
        @yield('js')
        <script src="{{asset('template/assets/dist/js/custom.js')}}"></script>
        <!-- end of to be removed packages -->
    @else
        <script src="{{ mix('js/app.js') }}"></script>
    @endif

    <script type="text/javascript">
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole    = @if(env('APP_ENV') == 'local') true @else false @endif;
            var pusher_key_app_key = '{{env('PUSHER_APP_KEY')}}';
            var push_init          = new Pusher(pusher_key_app_key, {
                cluster: 'ap1'
        });
        
        // badge-total-item-in-cart
        window.livewire.on('initialize_cart_item_count', param => {
            var total_item_in_cart = parseInt(param['total']);
            $(document).find('.badge-total-item-in-cart').each(function () {
                if(total_item_in_cart > 0){
                    $(this).html('<span class="badge badge-warning">'+total_item_in_cart+'</span>');
                }else{
                    $(this).html('');
                }
            });
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
    @stack('scripts')
</body>
</html>
