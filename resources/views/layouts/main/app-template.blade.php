<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>{{trans('system.app-title')}}</title>
      <!--Styles-->
      @include('layouts._partials.styles')
      <link rel="icon" href="{{ URL::asset('images/favicon.png') }}" type="image/png">
  </head>
  <body class="hold-transition skin-blue sidebar-mini" id="app">
      <div class="wrapper" id="app_wrapper">
          <!-- Main Header -->
          @include('layouts._partials.header')
          <!-- Sidebar -->
          @include('layouts._partials.sidebar')
              <div class="content-wrapper">
                  @yield('content')
              </div>
          <!-- Footer -->
          @include('layouts._partials.footer')
          <!--Scripts-->
          @include('layouts._partials.scripts')
          @include('layouts._assets.js.notifications')
      </div>
  </body>
</html>