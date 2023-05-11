<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset(config('site.company.logo')) }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset(config('site.company.logo')) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(config('site.company.logo')) }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/custom/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashmix/src/assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashmix/src/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    
    <!-- Dashmix framework -->
    <link rel="stylesheet" href="{{ asset('assets/dashmix/src/assets/css/dashmix.min.css') }}" id="css-main">
    <!-- END Stylesheets -->

  </head>

  <body>

    <div id="page-container">
      <main id="main-container">
        @yield('content')
      </main>
    </div>

    <!-- Dashmix JS -->
    <script src="{{ asset('assets/dashmix/src/assets/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for jQuery Validation plugin) -->
    <script src="{{ asset('assets/dashmix/src/assets/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>
      Dashmix.helpersOnLoad([
        'jq-select2'
      ])
    </script>
    @include('sweetalert::alert')
    @include('layouts.components.alert')
    @stack('javascript')
  </body>
</html>