<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ URL::asset('images/favicon.png') }}" type="image/png">
    <title>{{ config('app.name', 'J-PORTAL') }}</title>
    <!-- Styles -->
    @include('layouts._partials.styles')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body >
    <div id="app">
        @yield('content')
    </div>
    <!--Scripts-->
    @include('layouts._partials.scripts')
</body>
</html>
