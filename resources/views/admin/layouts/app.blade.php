<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('material-dashboard/assets/css/material-dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('material-dashboard/assets/css/nucleo-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('material-dashboard/assets/css/nucleo-svg.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
        @stack('styles')
        <title>{{ env('APP_NAME') }} | @yield('title')</title>
    </head>
    <body class="g-sidenav-show bg-gray-200">
        @include('admin.components.aside')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ps ps--active-y">
            @include('admin.components.navbar')
            <div class="container-fluid py-4">
                @yield('content')
                @include('admin.components.footer')
            </div>
        </main>
        <script src="{{ asset('js/admin/app.js')  }}"></script>
        <script src="{{ asset('material-dashboard/assets/js/core/popper.min.js')  }}"></script>
        <script src="{{ asset('material-dashboard/assets/js/core/bootstrap.min.js')  }}"></script>
        <script src="{{ asset('material-dashboard/assets/js/plugins/perfect-scrollbar.min.js')  }}"></script>
        <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
        <script src="{{ asset('material-dashboard/assets/js/material-dashboard.js')  }}"></script>
        @stack('scripts')
    </body>
</html>
