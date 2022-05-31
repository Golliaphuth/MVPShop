<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">

        @yield('breadcrumbs')

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button class="nav-link text-body font-weight-bold px-0" type="submit" style="font-weight: normal; border: none;">
                            <i class="fa-solid fa-power-off me-sm-1" aria-hidden="true"></i>
                            <span class="d-sm-inline d-none">Выйти</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>
