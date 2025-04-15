<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letter Request System</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/corona-admin.css') }}">
</head>
<body>
    <div class="container-scroller">
        <nav class="sidebar sidebar-dark">
            <div class="sidebar-brand">
                <a href="#" class="sidebar-brand-logo">Letter System</a>
            </div>
            <div class="sidebar-menu">
                <ul class="nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route(auth()->user()->role . '.dashboard') }}">Dashboard</a>
                        </li>
                        @if(auth()->user()->role === 'mahasiswa')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('mahasiswa.submit_letter') }}">Submit Letter</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
        <div class="main-panel">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/corona-admin.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
    <script src="{{ asset('js/bootstrap-table.js') }}"></script>
</body>
</html>