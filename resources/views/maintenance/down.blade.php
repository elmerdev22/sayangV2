<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Under Construction | {{ env('APP_NAME') }}</title>
    <style type="text/css">
      body, html {
        height: 100%;
      }

      body{
        /* The image used */
        background-image: url({{asset('images/default-photo/maintenance.jpg')}});

        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
</head>
<body>
</body>
</html>
