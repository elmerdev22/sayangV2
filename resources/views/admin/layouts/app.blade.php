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
      <link href="{{ mix('css/app.css') }}" rel="stylesheet">
      @yield('css')
      @livewireStyles
  </head>
  <body class="layout-fixed layout-navbar-fixed">
      @yield('content')
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->

    @livewireScripts
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('js')
    @stack('scripts')
  </body>
</html>
