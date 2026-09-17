<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('admin.sidebar.brand')) — ATLAS SECURITY A2S</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    @stack('head')
</head>
<body class="admin-body @yield('body-class')">

@if(!isset($hideShell) || !$hideShell)
<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="admin-sidebar-brand">
            <img src="{{ asset('atlas_logo.png') }}" alt="ATLAS" height="32">
            <span>{{ __('admin.sidebar.brand') }}</span>
        </div>

        <nav class="admin-sidebar-nav">
            <span class="admin-sidebar-label">{{ __('admin.sidebar.sections') }}</span>
            <a href="{{ url('admin/images') }}" class="admin-sidebar-link {{ request()->is('admin/images') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> {{ __('admin.sidebar.all_sections') }}
            </a>
            @foreach(($sections ?? []) as $s)
                <a href="{{ url('admin/images') }}#section-{{ $s }}-row" class="admin-sidebar-link">
                    <i class="bi bi-folder2"></i> {{ ucfirst($s) }}
                </a>
            @endforeach
        </nav>

        <div class="admin-sidebar-footer">
            <a href="{{ url('/') }}" class="admin-sidebar-link"><i class="bi bi-box-arrow-left"></i> {{ __('admin.sidebar.back_to_site') }}</a>
            <form method="POST" action="{{ url('admin/logout') }}" class="m-0">
                @csrf
                <button type="submit" class="admin-sidebar-link admin-sidebar-logout w-100 text-start border-0 bg-transparent">
                    <i class="bi bi-box-arrow-right"></i> {{ __('admin.sidebar.logout') }}
                </button>
            </form>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <button class="admin-sidebar-toggle d-lg-none" type="button" aria-label="Toggle menu">
                <i class="bi bi-list"></i>
            </button>
            <div class="admin-topbar-title">@yield('title', __('admin.sidebar.brand'))</div>
            <div class="admin-topbar-actions">
                @if(session('admin_user'))
                    <span class="admin-topbar-user d-none d-md-inline">
                        <i class="bi bi-person-circle"></i> {{ session('admin_user') }}
                    </span>
                @endif
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ url('lang/en') }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ url('lang/fr') }}">Français</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="admin-content">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
@else
    @yield('content')
@endif

<script>
    window.adminI18n = {
        loading: @json(__('admin.js.loading')),
        failedLoad: @json(__('admin.js.failed_load')),
        updateFailed: @json(__('admin.js.update_failed')),
        deleteConfirm: @json(__('admin.js.delete_confirm')),
        deleteFailed: @json(__('admin.js.delete_failed')),
    };
</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/admin.js') }}"></script>

@stack('scripts')
</body>
</html>
