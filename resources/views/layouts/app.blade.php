<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Letter Request System')</title>
    <link rel="stylesheet" href="{{ asset('corona/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('corona/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('corona/images/favicon.png') }}" />
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route(Auth::user() ? Auth::user()->role . '.dashboard' : 'login') }}">Letter Request</a>
                <a class="navbar-brand brand-logo-mini" href="{{ route(Auth::user() ? Auth::user()->role . '.dashboard' : 'login') }}">LR</a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    @if (Auth::check())
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-text">
                                    <p class="mb-1 text-black">{{ Auth::user()->nama }}</p>
                                </div>
                            </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        @yield('content')
    </div>
    <script src="{{ asset('corona/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('corona/js/off-canvas.js') }}"></script>
    <script src="{{ asset('corona/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('corona/js/misc.js') }}"></script>
    <script src="{{ asset('corona/js/settings.js') }}"></script>
    <script src="{{ asset('corona/js/todolist.js') }}"></script>
</body>
</html>