<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ATLAS SECURITY A2S - Professional security & cleaning services">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ATLAS SECURITY A2S</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome (optional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @stack('head')
</head>
<body data-bs-spy="scroll" data-bs-target="#navbarNav" data-bs-offset="90">

<!-- Navbar -->
<nav id="mainNav" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('atlas_logo.png') }}" alt="ATLAS" height="40" class="me-2">
            <span class="fw-bold">ATLAS SECURITY A2S</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="#blog">{{ __('site.nav.blog') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#security">{{ __('site.nav.security') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#cleaning">{{ __('site.nav.cleaning') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#business">{{ __('site.nav.business') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#companies">{{ __('site.nav.companies') }}</a></li>
                <li class="nav-item"><a class="nav-link btn btn-outline-primary ms-2" href="#contact">{{ __('site.nav.contact') }}</a></li>
            </ul>

            <ul class="navbar-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown">{{ strtoupper(app()->getLocale()) }}</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                        <li><a class="dropdown-item" href="{{ url('lang/en') }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ url('lang/fr') }}">Français</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/images') }}"><i class="bi bi-folder-plus"></i> Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="mt-5 pt-5">
    @yield('content')
</main>

<!-- Back to top -->
<button id="backToTop" class="btn btn-primary shadow rounded-circle" title="Back to top"><i class="bi bi-chevron-up"></i></button>

<!-- Footer -->
<footer class="bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0">{{ __('site.footer.copy') }}</p>
                <small>{{ __('site.footer.designed_by') }}</small>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@stack('scripts')
</body>
</html>
