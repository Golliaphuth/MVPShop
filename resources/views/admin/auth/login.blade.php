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
        <title>{{ env('APP_NAME') }} | Вход</title>
    </head>
    <body class="bg-gray-200">
        <main class="main-content mt-0 ps">
            <div class="page-header align-items-start min-vh-100" style="background-image: url('{{ Storage::url('public/backgrounds/login.webp') }}');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                                            <a class="navbar-brand m-0" href="#" target="_blank">
                                                <i class="fa-solid fa-2xl fa-face-grin-tongue-wink" style="color:#fff;"></i>
                                                <span class="ms-1 font-weight-bold text-white">{{ env('APP_NAME') }}</span>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.login') }}" method="POST" role="form" class="text-start">
                                        @csrf

                                        @error('auth') <span class="text-primary" style="display: block; width: 100%; text-align: center;">{{ $message }}</span> @enderror

                                        <div class="input-group input-group-outline my-3">
                                            <label for="loginEmail" class="form-label">Email</label>
                                            <input name="email" id="loginEmail" type="email" class="form-control">
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label for="loginPassword" class="form-label">Пароль</label>
                                            <input name="password" id="loginPassword" type="password" class="form-control">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Войти</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer position-absolute bottom-2 py-2 w-100">
                    <div class="container">
                        <div class="row align-items-center justify-content-lg-between">
                            <div class="col-12 col-md-6 my-auto">
                                <div class="copyright text-center text-sm text-muted text-lg-start">
                                    © {{ \Illuminate\Support\Carbon::now()->format('Y') }} by
                                    <a href="https://golliaphuth.pro" class="font-weight-bold" target="_blank">Golliaphuth</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </main>
        <script src="{{ asset('js/admin/app.js')  }}"></script>
        <script src="{{ asset('material-dashboard/assets/js/core/popper.min.js')  }}"></script>
        <script src="{{ asset('material-dashboard/assets/js/core/bootstrap.min.js')  }}"></script>
        <script src="{{ asset('material-dashboard/assets/js/plugins/perfect-scrollbar.min.js')  }}"></script>
        <script src="{{ asset('material-dashboard/assets/js/material-dashboard.js')  }}"></script>
        <script>
            (function($){

            })(jQuery)
        </script>
    </body>
</html>
