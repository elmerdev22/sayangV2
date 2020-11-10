<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>@yield('title') | {{env('APP_NAME')}}</title>

    <link rel="icon" type="image/icon" href="{{asset('images/logo/icon.png')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('template/assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Preloader -->
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/preloader.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/adminlte.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style type="text/css">
        @media print {
            @page { 
                /*size: 3.14in 1.77in;*/
                margin: 0mm;
                margin-left: 5mm; 
                margin-right: 5mm; 
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader no-print">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <div class="wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('template/assets/plugins/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(window).on('load', function(){
            $('.preloader').fadeOut('slow');
        });
        window.print();
    </script>
</body>
</html>