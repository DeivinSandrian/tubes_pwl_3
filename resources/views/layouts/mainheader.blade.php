<!-- Navbar -->
<nav class="navbar p-0 fixed-top d-flex flex-row" id="navbar" style="left: 0; z-index: 1050; padding-left: 1rem;">
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="{{ route(Auth::user() ? Auth::user()->role . '.dashboard' : 'login') }}" style="color: white;">Letter Request</a>
                    <a class="navbar-brand brand-logo-mini" href="{{ route(Auth::user() ? Auth::user()->role . '.dashboard' : 'login') }}" style="color: white;">LR</a>
                </div>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                
                

                <ul class="navbar-nav navbar-nav-right" style="padding-right: 1rem;">
                    @if (Auth::check())
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="navbar-profile">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name" style="color: white;">{{ Auth::user()->nama }}</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block" style="color: white;"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: white;">
                                    <i class="mdi mdi-logout text-danger"></i> Log out
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