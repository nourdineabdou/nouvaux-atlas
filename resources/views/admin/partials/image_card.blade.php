<div class="col-6 col-md-4 col-lg-3" id="img-card-{{ $img->id }}" data-section="{{ $img->section }}">
    <div class="card h-100">
        <img src="{{ asset($img->path) }}" class="card-img-top img-fluid" style="height:140px;object-fit:cover" alt="{{ $img->original_name }}">
        <div class="card-body p-2 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
            <small class="text-muted text-truncate w-100" style="max-width:120px;" title="{{ $img->original_name }}">{{ $img->original_name }}</small>
            <div class="btn-group w-100 w-md-auto" role="group">
                <button class="btn btn-sm btn-secondary img-edit-btn w-100 mb-1 mb-md-0 me-md-1" data-id="{{ $img->id }}">Edit</button>
                <button class="btn btn-sm btn-danger img-delete-btn w-100" data-id="{{ $img->id }}">Delete</button>
            </div>
        </div>
    </div>
</div>
<style>
@media (max-width: 575.98px) {
    #img-card-{{ $img->id }} .card-body {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 0.25rem !important;
    }
    #img-card-{{ $img->id }} .btn-group {
        flex-direction: column !important;
        width: 100% !important;
    }
    #img-card-{{ $img->id }} .btn {
        width: 100% !important;
        margin-bottom: 0.25rem;
    }
    #img-card-{{ $img->id }} small.text-truncate {
        max-width: 100% !important;
    }
}
</style>
