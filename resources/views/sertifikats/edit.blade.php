@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex flex-wrap justify-content-between align-items-center page-header mt-3 mb-4">
            <div>
                <h2 class="mb-1">Ubah Sertifikat</h2>
                <p class="text-muted mb-0">{{ $sertifikat->tanah->nama ?? '-' }}</p>
            </div>
        </div>

        @php
            $tglTerbit = $sertifikat->tanggal_terbit
                ? \Carbon\Carbon::parse($sertifikat->tanggal_terbit)->format('Y-m-d') : '';
            $tglAiw = $sertifikat->tanggal_aiw
                ? \Carbon\Carbon::parse($sertifikat->tanggal_aiw)->format('Y-m-d') : '';
        @endphp

        <div class="card form-card">
            <form action="{{ route('sertifikats.update', $sertifikat->id) }}" method="POST" class="p-4">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label for="tanah_id" class="form-label">Nama Tanah <span class="text-danger">*</span></label>
                        <select name="tanah_id" id="tanah_id" class="form-select @error('tanah_id') is-invalid @enderror" required>
                            <option value="">Pilih Tanah</option>
                            @foreach($tanahs as $tanah)
                                <option value="{{ $tanah->id }}"
                                    {{ old('tanah_id', $sertifikat->tanah_id) == $tanah->id ? 'selected' : '' }}>
                                    {{ $tanah->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('tanah_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="nomor_sertifikat" class="form-label">No. Sertifikat <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_sertifikat" id="nomor_sertifikat"
                            class="form-control @error('nomor_sertifikat') is-invalid @enderror"
                            value="{{ old('nomor_sertifikat', $sertifikat->nomor_sertifikat) }}" required>
                        @error('nomor_sertifikat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
                        <input type="date" name="tanggal_terbit" id="tanggal_terbit"
                            class="form-control @error('tanggal_terbit') is-invalid @enderror"
                            value="{{ old('tanggal_terbit', $tglTerbit) }}">
                        @error('tanggal_terbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nomor_aiw" class="form-label">No. AIW</label>
                        <input type="text" name="nomor_aiw" id="nomor_aiw"
                            class="form-control @error('nomor_aiw') is-invalid @enderror"
                            value="{{ old('nomor_aiw', $sertifikat->nomor_aiw) }}">
                        @error('nomor_aiw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_aiw" class="form-label">Tanggal AIW</label>
                        <input type="date" name="tanggal_aiw" id="tanggal_aiw"
                            class="form-control @error('tanggal_aiw') is-invalid @enderror"
                            value="{{ old('tanggal_aiw', $tglAiw) }}">
                        @error('tanggal_aiw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 pt-3 form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Perbarui
                    </button>
                    <a href="{{ route('sertifikats.index') }}" class="btn btn-outline-claude">Batal</a>
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

        .form-card {
            max-width: 760px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--claude-text, #3d3929);
            margin-bottom: 0.35rem;
        }

        .form-card .form-control,
        .form-card .form-select {
            border: 1px solid var(--claude-border, #e6e4dc);
            border-radius: var(--radius-md, 10px);
            padding: 0.6rem 0.85rem;
            color: var(--claude-text, #3d3929);
            background-color: var(--claude-surface, #ffffff);
        }

        .form-card .form-control:focus,
        .form-card .form-select:focus {
            border-color: var(--claude-text-light, #706b5b);
            box-shadow: 0 0 0 3px rgba(112, 107, 91, 0.15);
        }

        .form-actions {
            border-top: 1px solid var(--claude-border, #e6e4dc);
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