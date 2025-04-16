<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <!-- <img src="{{ asset('corona/images/faces/face1.jpg') }}" alt="profile">
                    <span class="login-status online"></span> -->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ Auth::user()->nama }}</span>
                    <span class="text-secondary text-small">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route(Auth::user()->role . '.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @if (AUth::user()->role === 'admin')
        <li class="nav-item">
                <!-- <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="icon-user menu-icon"></i>
                        <span class="menu-title">Manage Users</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.roles') }}">
                        <i class="icon-users menu-icon"></i>
                        <span class="menu-title">Manage Roles</span>
                    </a>
                </li> -->
            @endif
        @if (Auth::user()->role === 'mahasiswa')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#create-letter-menu" aria-expanded="false" aria-controls="create-letter-menu">
                    <span class="menu-title">Create Letter Request</span>
                    <i class="mdi mdi-plus menu-icon"></i>
                </a>
                <div class="collapse" id="create-letter-menu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mahasiswa.letters.create', 'SKMA') }}">Surat Keterangan Mahasiswa Aktif</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mahasiswa.letters.create', 'SKT') }}">Surat Keterangan Lulus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mahasiswa.letters.create', 'SPTMK') }}">Surat Pengantar Tugas Mata Kuliah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mahasiswa.letters.create', 'LHS') }}">Laporan Hasil Studi</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="menu-title">Logout</span>
                <i class="mdi mdi-logout menu-icon"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<style>
    /* Initially show the full logo and hide the mini logo */
    .sidebar .nav-item.nav-profile .nav-link .nav-profile-text .brand-logo {
        display: block;
    }

    .sidebar .nav-item.nav-profile .nav-link .nav-profile-text .brand-logo-mini {
        display: none;
    }

    /* When the sidebar is minimized, hide the full logo and show the mini logo */
    body.sidebar-icon-only .sidebar .nav-item.nav-profile .nav-link .nav-profile-text .brand-logo {
        display: none;
    }

    body.sidebar-icon-only .sidebar .nav-item.nav-profile .nav-link .nav-profile-text .brand-logo-mini {
        display: block;
    }

    /* Basic styling for alignment */
    .sidebar .nav-item.nav-profile .nav-link {
        display: flex;
        justify-content: center;
        padding: 1rem 0;
    }

    .sidebar .nav-item.nav-profile .nav-link .nav-profile-text {
        align-items: center;
    }

    /* Dropdown submenu styling */
    .sidebar .nav .sub-menu {
        padding-left: 20px;
    }

    .sidebar .nav .sub-menu .nav-link {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
</style>