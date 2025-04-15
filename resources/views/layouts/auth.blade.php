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
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('corona/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('corona/js/off-canvas.js') }}"></script>
    <script src="{{ asset('corona/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('corona/js/misc.js') }}"></script>
</body>
</html> 