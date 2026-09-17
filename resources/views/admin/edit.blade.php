@extends('layouts.admin')

@section('title', __('admin.edit.heading'))

@section('content')
<div class="admin-panel" style="max-width:560px">
    <div class="card mb-3">
        <img src="{{ asset($img->path) }}" class="card-img-top" style="height:280px;object-fit:cover" alt="{{ $img->original_name }}">
        <div class="card-body">
            <p class="mb-1"><strong>{{ __('admin.edit.original_name') }}:</strong> {{ $img->original_name }}</p>
            <p class="mb-1"><strong>{{ __('admin.edit.section') }}:</strong> {{ ucfirst($img->section) }}</p>
            <p class="mb-0"><strong>{{ __('admin.edit.uploaded') }}:</strong> {{ $img->created_at }}</p>
        </div>
    </div>

    @include('admin.partials.edit_form')
</div>
@endsection
