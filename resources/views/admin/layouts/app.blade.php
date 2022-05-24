<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        @stack('styles')
        <title>Hello, world!</title>
    </head>
    <body>

        @yield('content')

        <script src="{{ asset('js/app.js')  }}"></script>
        @stack('scripts')
    </body>
</html>
