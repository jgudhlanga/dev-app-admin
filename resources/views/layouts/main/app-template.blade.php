<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>EM | Empployee Management</title>
      <!--Styles-->
      @include('layouts._partials.styles')
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
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
      </div>
  </body>
</html>