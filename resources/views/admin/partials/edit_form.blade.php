<form id="image-edit-form" action="{{ url('admin/images/' . $img->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">{{ __('admin.edit.section') }}</label>
        <input type="hidden" name="section" value="{{ $img->section }}">
        <input type="text" class="form-control" value="{{ ucfirst($img->section) }}" disabled>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('admin.edit.replace_label') }}</label>
        <input type="file" name="replace" class="form-control" accept="image/*">
        <div class="form-text">{{ __('admin.edit.replace_help') }}</div>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-primary" type="submit">{{ __('admin.edit.save') }}</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.edit.cancel') }}</button>
    </div>
</form>
