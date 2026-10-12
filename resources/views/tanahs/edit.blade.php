@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center page-header mt-3 mb-4">
        <div>
            <h2 class="mb-1">Edit Data Tanah</h2>
            <p class="text-muted mb-0">Perbarui informasi bidang tanah yang sudah terdaftar.</p>
        </div>
        <a href="{{ route('tanahs.index') }}" class="btn btn-outline-claude">
            <i class="fa fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card p-4">
        <form action="{{ route('tanahs.update', $tanah->id) }}" method="POST">
            @method('PUT')
            @include('tanahs.form')
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('tanahs.index') }}" class="btn btn-outline-claude">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save me-1"></i> Perbarui
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .page-header h2 {
        font-size: 2.1rem;
        font-weight: 700;
        margin-top: 0;
        color: var(--claude-text, #3d3929);
    }

    .btn-outline-claude {
        background-color: var(--claude-surface, #ffffff);
        border: 1px solid var(--claude-border, #e6e4dc);
        color: var(--claude-text, #3d3929);
        font-weight: 500;
        padding: 0.55rem 1.1rem;
        border-radius: var(--radius-md, 10px);
        transition: all 0.2s ease;
    }

    .btn-outline-claude:hover {
        background-color: var(--claude-hover, #f3f1e5);
        border-color: var(--claude-text-light, #706b5b);
        color: var(--claude-text, #3d3929);
    }
</style>
@endsection