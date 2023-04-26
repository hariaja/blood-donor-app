<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/blood.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/blood.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/blood.png') }}">
    <!-- END Icons -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Poppins" rel="stylesheet">
    <!-- END Fonts -->

    @include('layouts.components.style')
  </head>

  <body>

    <div id="page-container" class="page-header-dark main-content-boxed">
      <!-- Header -->
      <header id="page-header">
        <!-- Header Content -->
        @include('layouts.partials.header')
        <!-- END Header Content -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-sidebar-dark">
          <div class="content-header">
            <div class="w-100 text-center">
              <i class="fa fa-fw fa-2x fa-spinner fa-spin text-primary"></i>
            </div>
          </div>
        </div>
        <!-- END Header Loader -->
      </header>
      <!-- END Header -->

      <!-- Main Container -->
      <main id="main-container">

        <!-- Navigation -->
        <div class="bg-sidebar-dark">
          @include('layouts.partials.navigation')
        </div>
        <!-- END Navigation -->

        <!-- Hero -->
        @yield('hero')
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
          @yield('content')
        </div>
        <!-- END Page Content -->

      </main>
      <!-- END Main Container -->

      <!-- Footer -->
      <footer id="page-footer" class="footer-static bg-body-extra-light">
        @include('layouts.partials.footer')
      </footer>
      <!-- END Footer -->
    </div>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    @include('layouts.components.js')
  </body>
</html>