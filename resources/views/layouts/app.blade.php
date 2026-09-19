<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="ATLAS SECURITY A2S - Professional security & cleaning services">
    <meta name="theme-color" content="#0a1f33">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ATLAS SECURITY A2S</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome (optional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @stack('head')
</head>
<body>

<!-- Navbar -->
<nav id="mainNav" class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('atlas_logo.png') }}" alt="ATLAS" class="navbar-brand-logo">
            <span class="navbar-brand-text">ATLAS SECURITY <em>A2S</em></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="{{ __('site.a11y.toggle_nav') }}">
            <span class="navbar-toggler-bar"></span>
            <span class="navbar-toggler-bar"></span>
            <span class="navbar-toggler-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="#security">{{ __('site.nav.security') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#cleaning">{{ __('site.nav.cleaning') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#business">{{ __('site.nav.business') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#blog">{{ __('site.nav.blog') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#companies">{{ __('site.nav.companies') }}</a></li>
            </ul>

            <div class="navbar-cta-group">
                <a class="btn btn-nav-cta" href="#contact">
                    <i class="bi bi-chat-dots"></i> {{ __('site.nav.contact') }}
                </a>

                <div class="dropdown navbar-lang-dropdown">
                    <button class="btn btn-lang" type="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe2"></i> {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                        <li><a class="dropdown-item {{ app()->getLocale()=='en' ? 'active' : '' }}" href="{{ url('lang/en') }}">🇬🇧 English</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale()=='fr' ? 'active' : '' }}" href="{{ url('lang/fr') }}">🇫🇷 Français</a></li>
                    </ul>
                </div>

                <a class="btn btn-admin-link" href="{{ url('admin/images') }}" aria-label="Admin" title="Admin">
                    <i class="bi bi-shield-lock"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<!-- Back to top -->
<button id="backToTop" class="back-to-top" title="{{ __('site.a11y.back_to_top') }}" aria-label="{{ __('site.a11y.back_to_top') }}"><i class="bi bi-arrow-up"></i></button>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col footer-brand-col">
                <a href="{{ url('/') }}" class="footer-brand">
                    <img src="{{ asset('atlas_logo.png') }}" alt="ATLAS">
                    <span>ATLAS SECURITY <em>A2S</em></span>
                </a>
                <p class="footer-tagline">{{ __('site.hero.lead') }}</p>
                <div class="footer-social">
                    <a href="#" aria-label="{{ __('site.a11y.facebook') }}"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="{{ __('site.a11y.linkedin') }}"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://wa.me/22248266464" aria-label="{{ __('site.a11y.whatsapp') }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h6 class="footer-heading">{{ __('site.nav.contact') }}</h6>
                <ul class="footer-links">
                    <li><a href="#security">{{ __('site.nav.security') }}</a></li>
                    <li><a href="#cleaning">{{ __('site.nav.cleaning') }}</a></li>
                    <li><a href="#business">{{ __('site.nav.business') }}</a></li>
                    <li><a href="#blog">{{ __('site.nav.blog') }}</a></li>
                    <li><a href="#companies">{{ __('site.nav.companies') }}</a></li>
                </ul>
            </div>

            <div class="footer-col footer-contact-col">
                <h6 class="footer-heading">{{ __('site.contact.title') }}</h6>
                <ul class="footer-contact-list">
                    <li><i class="bi bi-geo-alt"></i><span>Îlot K, Tevragh Zeina, Nouakchott, Mauritanie</span></li>
                    <li><i class="bi bi-telephone"></i><span>+222 48 26 64 64 / +222 46 27 78 16</span></li>
                    <li><i class="bi bi-whatsapp"></i><span>+222 48 26 64 64</span></li>
                    <li><i class="bi bi-envelope"></i><span>commercial@atlassecurity-mr.com</span></li>
                    <li><i class="bi bi-globe2"></i><span><a href="https://www.atlas-sarl.com" target="_blank" rel="noopener" class="footer-inline-link">www.atlas-sarl.com</a></span></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="mb-0">{{ __('site.footer.copy') }}</p>
            <small>{{ __('site.footer.designed_by') }}</small>
        </div>
    </div>
</footer>

<!-- App-style bottom navigation (mobile & tablet) -->
<nav class="app-bottom-nav" aria-label="{{ __('site.a11y.mobile_nav') }}">
    <a href="#hero" class="bn-item"><i class="bi bi-house-door"></i><span>{{ __('site.nav.home') }}</span></a>
    <a href="#security" class="bn-item"><i class="bi bi-shield-lock"></i><span>{{ __('site.nav.security') }}</span></a>
    <a href="https://wa.me/22248266464" target="_blank" rel="noopener" class="bn-fab" aria-label="{{ __('site.a11y.whatsapp') }}">
        <i class="bi bi-whatsapp"></i>
    </a>
    <a href="#business" class="bn-item"><i class="bi bi-graph-up-arrow"></i><span>{{ __('site.nav.business') }}</span></a>
    <a href="#contact" class="bn-item"><i class="bi bi-envelope"></i><span>{{ __('site.nav.contact') }}</span></a>
</nav>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@stack('scripts')
</body>
</html>
