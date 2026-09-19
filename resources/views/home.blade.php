@extends('layouts.app')

@section('content')

@php
    $imagesBySection = $imagesBySection ?? [];
    $blogImages = $imagesBySection['blog'] ?? [];
    $securityImages = $imagesBySection['security'] ?? [];
    $cleanImages = $imagesBySection['cleaning'] ?? [];
    $companyImages = $imagesBySection['companies'] ?? [];
    $businessImages = $imagesBySection['business'] ?? [];
    $mapAddress = 'Îlot K, Tevragh Zeina, Nouakchott, Mauritanie';
    $mapLat = '18.0895023';
    $mapLng = '-15.9919729';
    $mapEmbedSrc = "https://www.google.com/maps?q={$mapLat},{$mapLng}&z=17&output=embed";
    $mapPlaceUrl = "https://www.google.com/maps/place/18%C2%B005'22.2%22N+15%C2%B059'31.1%22W/@{$mapLat},{$mapLng},17z";
    $heroImage = collect($securityImages)->first(fn($img) => !str_ends_with(strtolower($img), '.png'))
        ?? ($securityImages[0] ?? asset('assets/images/hero.svg'));
@endphp

<!-- Hero -->
<section id="hero">
    <span class="hero-blob b1"></span>
    <span class="hero-blob b2"></span>
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <span class="hero-badge fade-in"><i class="bi bi-patch-check-fill"></i> Trusted. Professional. Secure.</span>
                <h1 class="fade-in d-1 mt-3">{{ __('site.hero.title') }}</h1>
                <p class="lead fade-in d-2">{{ __('site.hero.lead') }}</p>
                <div class="hero-cta fade-in d-3">
                    <a href="#contact" class="btn btn-primary btn-lg"><i class="bi bi-chat-dots"></i> {{ __('site.buttons.contact') }}</a>
                    <a href="#companies" class="btn btn-outline-secondary btn-lg"><i class="bi bi-building"></i> {{ __('site.buttons.clients') }}</a>
                </div>
                <div class="hero-trust fade-in d-4">
                    <span class="tag"><i class="bi bi-shield-check"></i> {{ __('site.nav.security') }}</span>
                    <span class="tag"><i class="bi bi-stars"></i> {{ __('site.nav.cleaning') }}</span>
                    <span class="tag"><i class="bi bi-graph-up-arrow"></i> {{ __('site.nav.business') }}</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-visual fade-in d-2">
                    <div class="hero-visual-frame">
                        <img src="{{ $heroImage }}" alt="ATLAS SECURITY A2S">
                    </div>
                    <div class="hero-floating-badge">
                        <span class="hero-floating-icon"><i class="bi bi-patch-check-fill"></i></span>
                        <span>{{ __('site.hero.floating') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Security -->
<section id="security" class="bg-tint">
    <div class="container">
        <div class="section-header text-center mx-auto" style="max-width:640px">
            <span class="section-eyebrow"><i class="bi bi-shield-lock"></i> {{ __('site.nav.security') }}</span>
            <h2 class="section-title text-center">{{ __('site.security.title') }}</h2>
        </div>
        <div class="row g-3 g-md-4">
            <div class="col-6 col-lg-3">
                <div class="feature-card fade-in h-100">
                    <div class="feature-icon"><i class="bi bi-shield-lock"></i></div>
                    <h6>Manned Guarding</h6>
                    <p>Trained guards for static and mobile patrols.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="feature-card fade-in d-1 h-100">
                    <div class="feature-icon"><i class="bi bi-camera-video"></i></div>
                    <h6>CCTV Monitoring</h6>
                    <p>24/7 monitoring and incident response.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="feature-card fade-in d-2 h-100">
                    <div class="feature-icon"><i class="bi bi-person-badge"></i></div>
                    <h6>Event Security</h6>
                    <p>Professional staff for public and private events.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="feature-card fade-in d-3 h-100">
                    <div class="feature-icon"><i class="bi bi-briefcase-fill"></i></div>
                    <h6>Executive Protection</h6>
                    <p>Discreet and reliable executive protection services.</p>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            @if(count($securityImages))
                @foreach($securityImages as $img)
                    <div class="col-6 col-md-3">
                        <div class="gallery-frame fade-in">
                            <img src="{{ $img }}" class="img-fluid" alt="Security" style="height:150px;object-fit:cover">
                        </div>
                    </div>
                @endforeach
            @else
                @for($i=1;$i<=4;$i++)
                <div class="col-6 col-md-3">
                    <div class="gallery-frame fade-in">
                        <img src="{{ asset('assets/images/security' . $i . '.svg') }}" class="img-fluid" alt="Security {{ $i }}" style="height:150px;object-fit:cover">
                    </div>
                </div>
                @endfor
            @endif
        </div>
    </div>
</section>

<!-- Cleaning -->
<section id="cleaning">
    <div class="container">
        <div class="section-header text-center mx-auto" style="max-width:640px">
            <span class="section-eyebrow"><i class="bi bi-stars"></i> {{ __('site.nav.cleaning') }}</span>
            <h2 class="section-title text-center">{{ __('site.cleaning.title') }}</h2>
        </div>
        <div class="row g-3 g-md-4">
            <div class="col-md-4">
                <div class="feature-card accent fade-in h-100">
                    <div class="feature-icon"><i class="bi bi-building-gear"></i></div>
                    <h5>{{ __('site.cleaning.commercial') ?? 'Commercial Cleaning' }}</h5>
                    <p>{{ __('site.cleaning.commercial_desc') ?? 'Daily and periodic cleaning for offices and facilities.' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card accent fade-in d-1 h-100">
                    <div class="feature-icon"><i class="bi bi-droplet-half"></i></div>
                    <h5>Deep Cleaning</h5>
                    <p>Sanitization and deep-clean services.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card accent fade-in d-2 h-100">
                    <div class="feature-icon"><i class="bi bi-brush"></i></div>
                    <h5>Specialized Services</h5>
                    <p>Carpet, window, and high-level cleaning.</p>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            @if(count($cleanImages))
                @foreach($cleanImages as $img)
                    <div class="col-6 col-md-4">
                        <div class="gallery-frame fade-in">
                            <img src="{{ $img }}" class="img-fluid" alt="Cleaning" style="height:180px;object-fit:cover">
                        </div>
                    </div>
                @endforeach
            @else
                @for($i=1;$i<=5;$i++)
                <div class="col-6 col-md-4">
                    <div class="gallery-frame fade-in">
                        <img src="{{ asset('assets/images/clean' . $i . '.svg') }}" class="img-fluid" alt="Clean {{ $i }}" style="height:180px;object-fit:cover">
                    </div>
                </div>
                @endfor
            @endif
        </div>
    </div>
</section>

<!-- Business -->
<section id="business" class="bg-soft">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6">
                <span class="section-eyebrow"><i class="bi bi-graph-up-arrow"></i> {{ __('site.nav.business') }}</span>
                <h2 class="section-title">{{ __('site.business.title') }}</h2>
                <p class="section-sub">{{ __('site.business.text') }}</p>

                <div class="row g-3 mt-2">
                    <div class="col-6">
                        <div class="feature-card accent fade-in h-100">
                            <div class="feature-icon"><i class="bi bi-lightning-charge"></i></div>
                            <h6 class="mb-0">Rapid Response</h6>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="feature-card accent fade-in d-1 h-100">
                            <div class="feature-icon"><i class="bi bi-people-fill"></i></div>
                            <h6 class="mb-0">Client-focused</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                @if(count($businessImages))
                    <div class="gallery-frame fade-in d-2">
                        <img src="{{ $businessImages[0] }}" class="img-fluid" alt="Business" style="width:100%;height:280px;object-fit:cover">
                    </div>
                    @if(count($businessImages) > 1)
                        <div class="d-flex justify-content-center gap-2 flex-wrap mt-3">
                            @foreach(array_slice($businessImages,1) as $b)
                                <div class="gallery-frame">
                                    <img src="{{ $b }}" style="width:80px;height:60px;object-fit:cover" alt="Business thumb">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="gallery-frame fade-in d-2">
                        <img src="{{ asset('assets/images/business-large.svg') }}" class="img-fluid" alt="Business">
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Blog / Company presentation -->
<section id="blog">
    <div class="container">
        <div class="section-header text-center mx-auto" style="max-width:720px">
            <span class="section-eyebrow"><i class="bi bi-journal-richtext"></i> {{ __('site.nav.blog') }}</span>
            <h2 class="section-title text-center">{{ __('site.blog.title') }}</h2>
        </div>

        <div class="row justify-content-center align-items-center mb-4 g-3">
            <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
                <div class="atlas-logo-box mx-auto p-2 fade-in">
                    <img src="{{ asset('atlas_sombre.jpeg') }}" alt="Logo Atlas Security" class="img-fluid atlas-logo-img">
                </div>
            </div>
            <div class="col-12 col-md-8">
                <p class="text-muted fade-in d-1">{{ __('site.blog.text') }}</p>
            </div>
        </div>

        <div class="row g-3 mt-2">
            <div class="col-lg-10 mx-auto">
                <!-- Premium Carousel -->
                <div id="blogCarousel" class="carousel slide carousel-fade premium-carousel fade-in" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
                    @if(count($blogImages))
                        <div class="carousel-indicators">
                            @foreach($blogImages as $i => $img)
                                <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i==0 ? 'active' : '' }}" @if($i==0) aria-current="true" @endif aria-label="Slide {{ $i+1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($blogImages as $i => $img)
                                <div class="carousel-item {{ $i==0 ? 'active' : '' }}">
                                    <img src="{{ $img }}" @if($i==0) loading="eager" @else loading="lazy" @endif class="d-block w-100 img-fluid carousel-image" alt="Slide {{ $i+1 }}">
                                    <div class="carousel-caption d-block text-start">
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
                        {{-- fallback: static carousel preserved when no dynamic images are available --}}
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/blog1.webp') }}" class="d-block w-100 carousel-image" alt="Slide 1">
                                <div class="carousel-caption d-block text-start">
                                    <h5 class="text-white">Professional Protection</h5>
                                    <p class="text-white-50">Trained personnel, modern procedures and 24/7 monitoring.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/blog2.webp') }}" class="d-block w-100 carousel-image" alt="Slide 2">
                                <div class="carousel-caption d-block text-start">
                                    <h5 class="text-white">Event Security</h5>
                                    <p class="text-white-50">Seamless protection for events of any scale.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/blog3.webp') }}" class="d-block w-100 carousel-image" alt="Slide 3">
                                <div class="carousel-caption d-block text-start">
                                    <h5 class="text-white">CCTV & Monitoring</h5>
                                    <p class="text-white-50">Advanced surveillance to keep your assets safe.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/blog4.webp') }}" class="d-block w-100 carousel-image" alt="Slide 4">
                                <div class="carousel-caption d-block text-start">
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
                    <div class="col-6 col-md-4">
                        <div class="gallery-frame fade-in">
                            <img src="{{ $e }}" class="img-fluid" alt="Blog extra" style="height:170px;object-fit:cover">
                        </div>
                    </div>
                @endforeach
            @else
                @for($i=5;$i<=6;$i++)
                <div class="col-6 col-md-4">
                    <div class="gallery-frame fade-in">
                        <img src="{{ asset('assets/images/blog' . $i . '.svg') }}" class="img-fluid" alt="Blog {{ $i }}" style="height:170px;object-fit:cover">
                    </div>
                </div>
                @endfor
            @endif
        </div>
    </div>
</section>

<!-- Companies -->
<section id="companies" class="bg-tint">
    <div class="container">
        <div class="section-header text-center mx-auto" style="max-width:640px">
            <span class="section-eyebrow"><i class="bi bi-building"></i> {{ __('site.nav.companies') }}</span>
            <h2 class="section-title text-center">{{ __('site.companies.title') }}</h2>
        </div>
        <div class="row g-3 g-md-4 justify-content-center align-items-center">
            @if(count($companyImages))
                @foreach($companyImages as $img)
                    <div class="col-4 col-md-2 d-flex justify-content-center align-items-center fade-in">
                        <div class="company-logo-card">
                            <img src="{{ $img }}" class="img-fluid company-logo" alt="Company">
                        </div>
                    </div>
                @endforeach
            @else
                @for($i=1;$i<=10;$i++)
                <div class="col-4 col-md-2 d-flex justify-content-center align-items-center fade-in">
                    <div class="company-logo-card">
                        <img src="{{ asset('assets/images/company' . $i . '.svg') }}" class="img-fluid company-logo" alt="Company {{ $i }}">
                    </div>
                </div>
                @endfor
            @endif
        </div>
    </div>
</section>

<!-- Contact -->
<section id="contact">
    <div class="container">
        <div class="section-header text-center mx-auto" style="max-width:640px">
            <span class="section-eyebrow"><i class="bi bi-envelope-paper"></i> {{ __('site.nav.contact') }}</span>
            <h2 class="section-title text-center">{{ __('site.contact.title') }}</h2>
        </div>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="contact-wrap fade-in">
            <div class="contact-info-panel">
                <h5>{{ __('site.contact.get_in_touch') }}</h5>
                <ul class="contact-info-list">
                    <li><i class="bi bi-geo-alt"></i><span>Îlot K, Tevragh Zeina<br><small>Nouakchott, Mauritanie</small></span></li>
                    <li><i class="bi bi-telephone"></i><span>+222 48 26 64 64<br><small>+222 46 27 78 16</small></span></li>
                    <li><i class="bi bi-whatsapp"></i><span>+222 48 26 64 64</span></li>
                    <li><i class="bi bi-envelope"></i><span>commercial@atlassecurity-mr.com</span></li>
                    <li><i class="bi bi-globe2"></i><span><a href="https://www.atlas-sarl.com" target="_blank" rel="noopener" class="contact-inline-link">www.atlas-sarl.com</a></span></li>
                </ul>
                <div class="contact-hours">
                    <strong>{{ __('site.contact.office_hours') }}</strong>
                    <p>{{ __('site.contact.office_time') }}</p>
                </div>
            </div>
            <div class="contact-form-panel">
                <form action="{{ url('/contact') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('site.form.name') }}</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('site.form.email') }}</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ __('site.form.subject') }}</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ __('site.form.message') }}</label>
                            <textarea name="message" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-warning btn-lg w-100"><i class="bi bi-send"></i> {{ __('site.form.submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="map-block fade-in">
            <div class="map-block-head">
                <h6><i class="bi bi-geo-alt-fill"></i> {{ __('site.contact.find_us') }}</h6>
                <a href="{{ $mapPlaceUrl }}" target="_blank" rel="noopener" class="map-link">
                    {{ __('site.contact.view_on_maps') }} <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div>
            <div class="map-frame">
                <iframe
                    src="{{ $mapEmbedSrc }}"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen
                    title="ATLAS SECURITY A2S — {{ $mapAddress }}">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/22248266464" class="whatsapp-float" target="_blank" rel="noopener" aria-label="WhatsApp">
    <span class="whatsapp-label">{{ app()->getLocale() == 'fr' ? 'Discutez avec nous' : 'Chat with us' }}</span>
    <svg viewBox="0 0 448 448" xmlns="http://www.w3.org/2000/svg">
      <circle cx="224" cy="224" r="224" fill="#fff" opacity="0"/>
      <path d="M224 96c-70.7 0-128 57.3-128 128 0 22.6 6.1 44.7 17.7 64l-18.7 68.5c-2.2 8.1 5.3 15.6 13.4 13.4l68.5-18.7c19.3 11.6 41.4 17.7 64 17.7 70.7 0 128-57.3 128-128S294.7 96 224 96zm0 224c-20.1 0-39.8-5.3-56.8-15.3l-4-2.4-40.7 11.1 11.1-40.7-2.4-4C117.3 263.8 112 244.1 112 224c0-61.9 50.1-112 112-112s112 50.1 112 112-50.1 112-112 112zm61.6-82.2c-3.4-1.7-20.1-9.9-23.2-11-3.1-1.1-5.4-1.7-7.7 1.7-2.3 3.4-8.8 11-10.8 13.3-2 2.3-4 2.6-7.4.9-20.1-10-33.3-17.8-46.6-40.2-3.5-6 3.5-5.6 10-18.6.9-1.7.5-3.2-.2-4.9-.7-1.7-7.7-18.6-10.6-25.5-2.8-6.8-5.7-5.9-7.7-6-2-.1-4.3-.1-6.6-.1-2.3 0-6 1-9.1 4.3-3.1 3.4-12 11.7-12 28.6s12.3 33.2 14 35.5c1.7 2.3 24.1 36.8 58.5 50.2 8.2 3.2 14.6 5.1 19.6 6.5 8.2 2.1 15.7 1.8 21.6 1.1 6.6-.8 20.1-8.2 22.9-16.1 2.8-7.9 2.8-14.7 2-16.1-.8-1.4-3.1-2.3-6.5-4z" fill="#fff"/>
    </svg>
</a>
@endsection
