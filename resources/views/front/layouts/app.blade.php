<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/front/theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/front/style.css') }}">
        @stack('styles')
        <title>Hello, world!</title>
    </head>
    <body>
        @include('front.components.navbar')
        @yield('content')
        @stack('modals')
        <script src="{{ asset('js/front/app.js')  }}"></script>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
