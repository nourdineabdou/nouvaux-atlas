@extends('layouts.app')

@section('content')

@php
    $imagesBySection = $imagesBySection ?? [];
    $blogImages = $imagesBySection['blog'] ?? [];
    $securityImages = $imagesBySection['security'] ?? [];
    $cleanImages = $imagesBySection['cleaning'] ?? [];
    $companyImages = $imagesBySection['companies'] ?? [];
    $businessImages = $imagesBySection['business'] ?? [];
@endphp

<!-- Blog / Representation -->
<section id="blog" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">{{ __('site.blog.title') }}</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <p class="text-muted">{{ __('site.blog.text') }}</p>
            </div>
        </div>

        <div class="row g-3 mt-4">
            <div class="col-lg-10 mx-auto">
                <!-- Premium Carousel -->
                <div id="blogCarousel" class="carousel slide carousel-fade premium-carousel shadow-lg rounded" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
                    @if(count($blogImages))
                        <div class="carousel-indicators">
                            @foreach($blogImages as $i => $img)
                                <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i==0 ? 'active' : '' }}" @if($i==0) aria-current="true" @endif aria-label="Slide {{ $i+1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($blogImages as $i => $img)
                                <div class="carousel-item {{ $i==0 ? 'active' : '' }}">
                                    <img src="{{ $img }}" @if($i==0) loading="eager" @else loading="lazy" @endif class="d-block w-100 img-fluid carousel-image" style="object-fit:cover;max-height:420px;" alt="Slide {{ $i+1 }}">
                                    <div class="carousel-caption d-none d-md-block text-start">
                                        <h5 class="text-white">{{ __('site.blog.slide_title.' . ($i+1)) ?? '' }}</h5>
                                        <p class="text-white-50">{{ __('site.blog.slide_text.' . ($i+1)) ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#blogCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#blogCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @else
                        {{-- fallback: original static carousel preserved when no dynamic images are available --}}
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/blog1.webp') }}" class="d-block w-100 carousel-image" alt="Slide 1">
                                <div class="carousel-caption d-none d-md-block text-start">
                                    <h5 class="text-white">Professional Protection</h5>
                                    <p class="text-white-50">Trained personnel, modern procedures and 24/7 monitoring.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/blog2.webp') }}" class="d-block w-100 carousel-image" alt="Slide 2">
                                <div class="carousel-caption d-none d-md-block text-start">
                                    <h5 class="text-white">Event Security</h5>
                                    <p class="text-white-50">Seamless protection for events of any scale.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/blog3.webp') }}" class="d-block w-100 carousel-image" alt="Slide 3">
                                <div class="carousel-caption d-none d-md-block text-start">
                                    <h5 class="text-white">CCTV & Monitoring</h5>
                                    <p class="text-white-50">Advanced surveillance to keep your assets safe.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/blog4.webp') }}" class="d-block w-100 carousel-image" alt="Slide 4">
                                <div class="carousel-caption d-none d-md-block text-start">
                                    <h5 class="text-white">Cleaning & Maintenance</h5>
                                    <p class="text-white-50">Premium cleaning services to keep environments pristine.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#blogCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#blogCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            @php $extra = array_slice($blogImages, 4); @endphp
            @if(count($extra))
                @foreach($extra as $e)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm overflow-hidden fade-in">
                            <img src="{{ $e }}" class="card-img-top img-hover-zoom" alt="Blog extra">
                        </div>
                    </div>
                @endforeach
            @else
                @for($i=5;$i<=6;$i++)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm overflow-hidden fade-in">
                        <img src="{{ asset('assets/images/blog' . $i . '.svg') }}" class="card-img-top img-hover-zoom" alt="Blog {{ $i }}">
                    </div>
                </div>
                @endfor
            @endif
        </div>

        <div class="text-center mt-4">
            <a href="#blog" class="btn btn-outline-primary">{{ __('site.blog.view_all') }}</a>
        </div>
    </div>
</section>

<!-- Hero -->
<section class="py-5 bg-white" id="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="hero-badge">Trusted. Professional. Secure.</span>
                <h1 class="display-5 fw-bold mt-3 fade-in">{{ __('site.hero.title') }}</h1>
                <p class="lead text-muted fade-in">{{ __('site.hero.lead') }}</p>
                <div class="hero-cta fade-in">
                    <a href="#contact" class="btn btn-primary btn-lg me-2">{{ __('site.buttons.contact') }}</a>
                    <a href="#companies" class="btn btn-outline-secondary btn-lg">{{ __('site.buttons.clients') }}</a>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img src="{{ asset('assets/images/hero.svg') }}" alt="Hero" class="img-fluid shadow rounded">
            </div>
        </div>
    </div>
</section>

<!-- Security -->
<section id="security" class="py-5" style="background:#e9f5ff;">
    <div class="container">
        <h2 class="mb-4 text-center">{{ __('site.security.title') }}</h2>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-shield-lock display-6 text-primary"></i>
                        <h5 class="mt-3">Manned Guarding</h5>
                        <p class="text-muted">Trained guards for static and mobile patrols.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-camera-video display-6 text-primary"></i>
                        <h5 class="mt-3">CCTV Monitoring</h5>
                        <p class="text-muted">24/7 monitoring and incident response.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge display-6 text-primary"></i>
                        <h5 class="mt-3">Event Security</h5>
                        <p class="text-muted">Professional staff for public and private events.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-briefcase-fill display-6 text-primary"></i>
                        <h5 class="mt-3">Executive Protection</h5>
                        <p class="text-muted">Discreet and reliable executive protection services.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            @if(count($securityImages))
                @foreach($securityImages as $img)
                    <div class="col-md-3">
                        <img src="{{ $img }}" class="img-fluid rounded shadow-sm img-hover-zoom fade-in" alt="Security">
                    </div>
                @endforeach
            @else
                @for($i=1;$i<=4;$i++)
                <div class="col-md-3">
                    <img src="{{ asset('assets/images/security' . $i . '.svg') }}" class="img-fluid rounded shadow-sm img-hover-zoom fade-in" alt="Security {{ $i }}">
                </div>
                @endfor
            @endif
        </div>
    </div>
</section>

<!-- Cleaning -->
<section id="cleaning" class="py-5" style="background:#f8f9fa;">
    <div class="container">
        <h2 class="mb-4 text-center">{{ __('site.cleaning.title') }}</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5>{{ __('site.cleaning.commercial') ?? 'Commercial Cleaning' }}</h5>
                        <p class="text-muted">{{ __('site.cleaning.commercial_desc') ?? 'Daily and periodic cleaning for offices and facilities.' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5>Deep Cleaning</h5>
                        <p class="text-muted">Sanitization and deep-clean services.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5>Specialized Services</h5>
                        <p class="text-muted">Carpet, window, and high-level cleaning.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            @if(count($cleanImages))
                @foreach($cleanImages as $img)
                    <div class="col-md-4">
                        <img src="{{ $img }}" class="img-fluid rounded shadow-sm img-hover-zoom fade-in" alt="Cleaning">
                    </div>
                @endforeach
            @else
                @for($i=1;$i<=5;$i++)
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/clean' . $i . '.svg') }}" class="img-fluid rounded shadow-sm img-hover-zoom fade-in" alt="Clean {{ $i }}">
                </div>
                @endfor
            @endif
        </div>
    </div>
</section>

<!-- Business -->
<section id="business" class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">{{ __('site.business.title') }}</h2>
                <p class="section-sub">{{ __('site.business.text') }}</p>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-lightning-charge display-6 text-warning"></i>
                                <h6 class="mt-2">Rapid Response</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-people-fill display-6 text-warning"></i>
                                <h6 class="mt-2">Client-focused</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                @if(count($businessImages))
                    <img src="{{ $businessImages[0] }}" class="img-fluid rounded shadow mb-3" alt="Business">
                    @if(count($businessImages) > 1)
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            @foreach(array_slice($businessImages,1) as $b)
                                <img src="{{ $b }}" class="img-thumbnail" style="width:80px;height:60px;object-fit:cover" alt="Business thumb">
                            @endforeach
                        </div>
                    @endif
                @else
                    <img src="{{ asset('assets/images/business-large.svg') }}" class="img-fluid rounded shadow" alt="Business">
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Contact -->
<section id="contact" class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-4">{{ __('site.contact.title') }}</h2>
        <div class="row">
            <div class="col-md-5 fade-in">
                <h5>{{ __('site.contact.get_in_touch') }}</h5>
                <p class="text-muted">
                    <strong>Adresse :</strong> avenue EL HADJ OMAR TALL<br>
                    <span style="font-size:0.95em;">À côté Direction Générale Assurance AGM (Carrefour Bana Blanc)</span><br>
                    <strong>Téléphone :</strong> +222 48 26 64 64<br>
                    <strong>WhatsApp :</strong> +222 48 43 44 01<br>
                    <strong>Commercial :</strong> +222 46 27 78 16<br>
                    <strong>Email :</strong> commercial@atlassecurity-mr.com
                </p>
                <div class="mt-3">
                    <strong>{{ __('site.contact.office_hours') }}</strong>
                    <p class="text-muted mb-0">{{ __('site.contact.office_time') }}</p>
                </div>
            </div>
            <div class="col-md-7">
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <form action="{{ url('/contact') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">{{ __('site.form.name') }}</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('site.form.email') }}</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('site.form.subject') }}</label>
                        <input type="text" name="subject" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('site.form.message') }}</label>
                        <textarea name="message" class="form-control" rows="4" required></textarea>
                    </div>
                    <button class="btn btn-warning text-white">{{ __('site.form.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Companies -->
<section id="companies" class="py-5" style="background:#fff;">
    <div class="container">
        <h2 class="text-center mb-5 display-6 fw-bold" style="letter-spacing:1px;text-transform:uppercase;">{{ __('site.companies.title') }}</h2>
        <div class="row g-4 justify-content-center align-items-center">
            @if(count($companyImages))
                @foreach($companyImages as $img)
                    <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center align-items-center fade-in">
                        <div class="company-logo-card p-3 bg-white rounded shadow-sm d-flex align-items-center justify-content-center" style="height:110px;">
                            <img src="{{ $img }}" class="img-fluid company-logo" alt="Company" style="max-height:60px;max-width:100%;filter:brightness(1.15) drop-shadow(0 2px 8px rgba(0,0,0,0.08));transition:filter .3s;">
                        </div>
                    </div>
                @endforeach
            @else
                @for($i=1;$i<=10;$i++)
                <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center align-items-center fade-in">
                    <div class="company-logo-card p-3 bg-white rounded shadow-sm d-flex align-items-center justify-content-center" style="height:110px;">
                        <img src="{{ asset('assets/images/company' . $i . '.svg') }}" class="img-fluid company-logo" alt="Company {{ $i }}" style="max-height:60px;max-width:100%;filter:brightness(1.15) drop-shadow(0 2px 8px rgba(0,0,0,0.08));transition:filter .3s;">
                    </div>
                </div>
                @endfor
            @endif
        </div>
    </div>
</section>
<style>
.company-logo-card:hover img {
    filter: brightness(1.35) drop-shadow(0 4px 16px rgba(0,0,0,0.13));
}
</style>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/22248266464" class="whatsapp-float" target="_blank" rel="noopener" aria-label="WhatsApp">
    <!-- Logo officiel WhatsApp SVG -->
    <svg viewBox="0 0 448 448" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
      <circle cx="224" cy="224" r="224" fill="#25D366"/>
      <path d="M224 96c-70.7 0-128 57.3-128 128 0 22.6 6.1 44.7 17.7 64l-18.7 68.5c-2.2 8.1 5.3 15.6 13.4 13.4l68.5-18.7c19.3 11.6 41.4 17.7 64 17.7 70.7 0 128-57.3 128-128S294.7 96 224 96zm0 224c-20.1 0-39.8-5.3-56.8-15.3l-4-2.4-40.7 11.1 11.1-40.7-2.4-4C117.3 263.8 112 244.1 112 224c0-61.9 50.1-112 112-112s112 50.1 112 112-50.1 112-112 112zm61.6-82.2c-3.4-1.7-20.1-9.9-23.2-11-3.1-1.1-5.4-1.7-7.7 1.7-2.3 3.4-8.8 11-10.8 13.3-2 2.3-4 2.6-7.4.9-20.1-10-33.3-17.8-46.6-40.2-3.5-6 3.5-5.6 10-18.6.9-1.7.5-3.2-.2-4.9-.7-1.7-7.7-18.6-10.6-25.5-2.8-6.8-5.7-5.9-7.7-6-2-.1-4.3-.1-6.6-.1-2.3 0-6 1-9.1 4.3-3.1 3.4-12 11.7-12 28.6s12.3 33.2 14 35.5c1.7 2.3 24.1 36.8 58.5 50.2 8.2 3.2 14.6 5.1 19.6 6.5 8.2 2.1 15.7 1.8 21.6 1.1 6.6-.8 20.1-8.2 22.9-16.1 2.8-7.9 2.8-14.7 2-16.1-.8-1.4-3.1-2.3-6.5-4z" fill="#fff"/>
    </svg>
</a>
<style>
.whatsapp-float {
    position: fixed;
    right: 24px;
    bottom: 120px;
    z-index: 1050;
    width: 64px;
    height: 64px;
    background: #25D366;
    border-radius: 50%;
    box-shadow: 0 4px 16px rgba(0,0,0,0.18);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: box-shadow 0.2s, transform 0.2s;
    animation: whatsapp-fadein 0.7s cubic-bezier(.4,1.4,.6,1) 1;
    cursor: pointer;
    border: 2px solid #fff;
 }
.whatsapp-float svg {
    width: 40px;
    height: 40px;
    display: block;
    filter: drop-shadow(0 2px 8px rgba(0,0,0,0.10));
 }
.whatsapp-float:hover, .whatsapp-float:focus {
    box-shadow: 0 8px 24px rgba(37,211,102,0.25), 0 2px 8px rgba(0,0,0,0.13);
    transform: scale(1.09);
 }
@keyframes whatsapp-fadein {
    0% { opacity: 0; transform: scale(0.7); }
    100% { opacity: 1; transform: scale(1); }
}
@media (max-width: 767.98px) {
    .whatsapp-float {
        right: 16px;
        bottom: 90px;
        width: 56px;
        height: 56px;
    }
    .whatsapp-float svg {
        width: 32px;
        height: 32px;
    }
}
@media (max-width: 575.98px) {
    .whatsapp-float {
        right: 12px;
        bottom: 70px;
        width: 48px;
        height: 48px;
    }
    .whatsapp-float svg {
        width: 24px;
        height: 24px;
    }
}
</style>
@endsection
