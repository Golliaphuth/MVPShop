<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark ps bg-white" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <i class="fa-solid fa-2xl fa-face-grin-tongue-wink" style="color:#fff;"></i>
            <span class="ms-1 font-weight-bold text-white">{{ env('APP_NAME') }}</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto max-height-vh-100 ps" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Главное</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @if(Route::currentRouteName() == 'admin.dashboard') active bg-gradient-primary @endif" href="{{ route('admin.dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-brands fa-lg fa-deezer"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @if(Route::currentRouteName() == 'admin.orders.index') active bg-gradient-primary @endif" href="{{ route('admin.orders.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-lg fa-cart-shopping"></i>
                    </div>
                    <span class="nav-link-text ms-1">Заказы</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @if(Route::currentRouteName() == 'admin.products.index') active bg-gradient-primary @endif" href="{{ route('admin.products.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-lg fa-boxes-stacked"></i>
                    </div>
                    <span class="nav-link-text ms-1">Товары</span>
                </a>
            </li>

{{--            <li class="nav-item mt-3">--}}
{{--                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Настройки</h6>--}}
{{--            </li>--}}


            <li class="nav-item">
                <a class="nav-link text-white @if(Route::currentRouteName() == 'admin.categories.index') active bg-gradient-primary @endif" href="{{ route('admin.categories.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-lg fa-cubes"></i>
                    </div>
                    <span class="nav-link-text ms-1">Категории</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @if(Route::currentRouteName() == 'admin.marketing.index') active bg-gradient-primary @endif" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-lg fa-bullhorn"></i>
                    </div>
                    <span class="nav-link-text ms-1">Маркетинг</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-lg fa-users"></i>
                    </div>
                    <span class="nav-link-text ms-1">Клиенты</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-lg fa-user-gear"></i>
                    </div>
                    <span class="nav-link-text ms-1">Пользователи</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-lg fa-gears"></i>
                    </div>
                    <span class="nav-link-text ms-1">Настройки</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @if(Route::currentRouteName() == 'admin.import.index') active bg-gradient-primary @endif" href="{{ route('admin.import.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-lg fa-cloud-arrow-up"></i>
                    </div>
                    <span class="nav-link-text ms-1">Импорт</span>
                </a>
            </li>

        </ul>
    </div>
{{--    <div class="sidenav-footer position-absolute w-100 bottom-0">--}}

{{--    </div>--}}
</aside>
