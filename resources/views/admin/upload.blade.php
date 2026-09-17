@extends('layouts.admin')

@section('title', __('admin.upload.heading'))

@section('content')

<!-- Modal (for edit) -->
<div class="modal fade" id="adminModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('admin.edit.modal_title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="adminModalBody">
                <!-- loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

<div class="admin-panel mb-4">
    <h5 class="mb-3">{{ __('admin.upload.heading') }}</h5>
    <form action="{{ url('admin/images/upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <label class="form-label">{{ __('admin.upload.section_label') }}</label>
                <select name="section" class="form-select">
                    @foreach($sections as $s)
                        <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">{{ __('admin.upload.images_label') }}</label>
                <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
                <div class="form-text">{{ __('admin.upload.images_help', ['path' => 'public/assets/images/{section}/']) }}</div>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 mt-3">
            <button class="btn btn-primary">{{ __('admin.upload.submit') }}</button>
        </div>
    </form>

    @if(session('uploaded'))
        <hr>
        <h6 class="mt-3">{{ __('admin.upload.uploaded_heading') }}</h6>
        <div class="row g-3">
            @foreach(session('uploaded') as $u)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $u }}" class="card-img-top img-fluid" alt="Uploaded" style="object-fit:cover;max-height:120px;">
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<h5 class="mb-0">{{ __('admin.upload.existing_heading') }}</h5>

@foreach($sections as $section)
    @php
        $count = isset($images[$section]) ? count($images[$section]) : 0;
        $limit = $limits[$section] ?? null;
        $isFull = $limit && $count >= $limit;
    @endphp
    <div class="admin-section-heading">
        <h5><i class="bi bi-folder2 me-1"></i>{{ ucfirst($section) }}</h5>
        @if($limit)
            <span class="admin-quota-badge {{ $isFull ? 'full' : '' }}">
                {{ $isFull ? __('admin.upload.quota_full') : __('admin.upload.quota', ['used' => $count, 'max' => $limit]) }}
            </span>
        @endif
    </div>
    <div class="row g-3 mb-3" id="section-{{ $section }}-row">
        @if(!empty($images) && isset($images[$section]) && count($images[$section]))
            @foreach($images[$section] as $img)
                @include('admin.partials.image_card', ['img' => $img])
            @endforeach
        @else
            <div class="col-12"><div class="admin-empty">{{ __('admin.upload.no_images') }}</div></div>
        @endif
    </div>
@endforeach
@endsection
