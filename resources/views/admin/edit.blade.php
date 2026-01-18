@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Edit Image</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-3">
        <img src="{{ asset($img->path) }}" class="card-img-top" style="height:300px;object-fit:cover" alt="{{ $img->original_name }}">
        <div class="card-body">
            <p><strong>Original name:</strong> {{ $img->original_name }}</p>
            <p><strong>Section:</strong> {{ $img->section }}</p>
            <p><strong>Uploaded:</strong> {{ $img->created_at }}</p>
        </div>
    </div>

    @include('admin.partials.edit_form')
</div>
@endsection
