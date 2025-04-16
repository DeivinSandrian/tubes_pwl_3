<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Letter Request System')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <style>
            /* Tampilkan Letter Request, sembunyikan LR secara default */
        `.navbar .navbar-brand.brand-logo {
            display: inline;
        }

        .navbar .navbar-brand.brand-logo-mini {
            display: none;
        }

        /* Kalau sidebar-icon-only aktif (sidebar disembunyikan), toggle logo */
        body.sidebar-icon-only .navbar .navbar-brand.brand-logo {
            display: none;
        }

        body.sidebar-icon-only .navbar .navbar-brand.brand-logo-mini {
            display: inline;
        }

        .navbar {
            padding: 0 !important;
        }

        .navbar-menu-wrapper {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin: 0 !important;
        }

        .navbar-brand-wrapper {
            padding: 0 !important;
            margin: 0 !important;
        }

    /* Atur navbar-brand-wrapper agar lebarnya menyesuaikan konten */
    .navbar-brand-wrapper {
        width: 250px; /* Lebar default saat sidebar terbuka */
        transition: width 1s ease; /* Animasi halus */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 !important; /* Hilangkan padding */
        margin: 0 !important; /* Hilangkan margin */
    }

    /* Saat sidebar-icon-only aktif, sesuaikan lebar navbar-brand-wrapper */
    body.sidebar-icon-only .navbar-brand-wrapper {
        width: 70px; /* Lebar menyesuaikan konten (teks "LR") */
    }

    /* Pastikan brand-logo-mini tidak memiliki padding/margin berlebih */
    .navbar-brand.brand-logo-mini {
        padding: 0 10px; /* Berikan padding kecil agar tidak terlalu rapat */
        margin: 0;
        display: inline-block;
    }

    /* Pastikan navbar-menu-wrapper tidak memaksa lebar berlebih */
    .navbar-menu-wrapper {
        display: flex;
        align-items: stretch;
        width: 100%;
        padding: 0 !important;
        margin: 0 !important;
    }

    /* Pastikan navbar itu sendiri tidak menambahkan ruang berlebih */
    .navbar {
        padding: 0 !important;
    }
    </style>`
</head>

<body>
    <div class="container-scroller">
        

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Page Body Wrapper -->
        <div class="container-fluid page-body-wrapper">
            <!-- Navbar -->
            @include('layouts.mainheader')

            <div class="main-panel">
                <!-- Main Content -->
                @yield('content')
                <!-- Footer -->
                @include('layouts.footer')
            </div>

            
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
</body>
</html>