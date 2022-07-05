<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="format-detection" content="telephone=no">
        <title>@yield('title') | {{ env('APP_NAME') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/front/favicon.png') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i">
        <link rel="stylesheet" href="{{ asset('css/front/vendor/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/vendor/stroyka/stroyka.css') }}">
        <link rel="stylesheet" href="{{ asset('css/front/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/front/custom.css') }}">
        <script src="{{ asset('js/front/app.js') }}"></script>
    </head>
    <body>
        <div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content"></div>
            </div>
        </div>
        <div class="site">
            @include('front.layouts.header')
            <div class="site__body">
                @yield('content')
            </div>
            @include('front.layouts.footer')
        </div>
        @stack('modals')
        @livewireScripts
        <script>
            svg4everybody();
        </script>
        <script>
            (function($){
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                });
            })(jQuery)
        </script>
        @stack('scripts')
    </body>

</html>
