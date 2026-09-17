@extends('layouts.admin')

@php($hideShell = true)

@section('content')
<div class="admin-login-wrap position-relative">
    <div class="dropdown admin-login-lang">
        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
            {{ strtoupper(app()->getLocale()) }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ url('lang/en') }}">English</a></li>
            <li><a class="dropdown-item" href="{{ url('lang/fr') }}">Français</a></li>
        </ul>
    </div>

    <div class="admin-login-card">
        <div class="admin-login-brand">
            <img src="{{ asset('atlas_logo.png') }}" alt="ATLAS">
            <span>ATLAS SECURITY A2S</span>
        </div>
        <h4 class="mb-1">{{ __('admin.login.title') }}</h4>
        <p class="text-muted mb-4">{{ __('admin.login.subtitle') }}</p>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ url('admin/login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('admin.login.username') }}</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label">{{ __('admin.login.password') }}</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-primary px-4">{{ __('admin.login.submit') }}</button>
                <a href="{{ url('/') }}" class="btn btn-link">{{ __('admin.login.back_to_site') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
