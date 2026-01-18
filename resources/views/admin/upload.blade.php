@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Admin — Upload Images</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <!-- Modal (for edit) -->
        <div class="modal fade" id="adminModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="adminModalBody">
                        <!-- loaded via AJAX -->
                    </div>
                </div>
            </div>
        </div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ url('admin/images/upload') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <label class="form-label">Section</label>
                <select name="section" class="form-select">
                    @if(!empty($sections))
                        @foreach($sections as $s)
                            <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                        @endforeach
                    @else
                        <option value="blog">Blog</option>
                        <option value="security">Security</option>
                        <option value="cleaning">Cleaning</option>
                        <option value="companies">Companies</option>
                        <option value="business">Business</option>
                    @endif
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Images (multiple allowed)</label>
                <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
                <div class="form-text">Max 5MB per file. Files will be stored to <code>public/assets/images/{section}/</code>.</div>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 mt-3">
            <button class="btn btn-primary">Upload</button>
            <a class="btn btn-link" href="{{ url('/') }}">Back to site</a>
        </div>
    </form>

    @if(session('uploaded'))
        <hr>
        <h5 class="mt-3">Uploaded</h5>
        <div class="row g-3">
            @foreach(session('uploaded') as $u)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $u }}" class="card-img-top img-fluid" alt="Uploaded" style="object-fit:cover;max-height:120px;">
                        <div class="card-body p-2"><small class="text-muted text-truncate">{{ $u }}</small></div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <hr>
    <h4>Existing images</h4>
    @foreach($sections as $section)
        <h5 class="mt-3">{{ ucfirst($section) }}</h5>
        <div class="row g-3 mb-3" id="section-{{ $section }}-row">
            </div>
            <style>
            @media (max-width: 575.98px) {
                .card-img-top {
                    max-height: 80px !important;
                }
                .company-logo-card {
                    height: 80px !important;
                }
            }
            </style>
            @if(!empty($images) && isset($images[$section]))
                @foreach($images[$section] as $img)
                    @include('admin.partials.image_card', ['img' => $img])
                @endforeach
            @endif
        </div>
    @endforeach
</div>
@endsection
