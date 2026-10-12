@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex flex-wrap justify-content-between align-items-center page-header mt-3 mb-4">
            <div>
                <p class="text-muted mb-1 fs-6">Detail Tanah</p>
                <h2 class="mb-0">{{ $tanah->nama }}</h2>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('tanahs.edit', $tanah->id) }}" class="btn btn-primary">
                    <i class="fa fa-edit me-1"></i> Ubah
                </a>
                <a href="{{ route('tanahs.index') }}" class="btn btn-outline-claude">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card p-4">
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">No. Sertifikat</span>
                    <span class="detail-value">
                        @if($tanah->sertifikat->nomor_sertifikat ?? false)
                            <span class="badge-soft badge-soft-success">{{ $tanah->sertifikat->nomor_sertifikat }}</span>
                        @else
                            <span class="badge-soft badge-soft-muted">Belum ada</span>
                        @endif
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Jenis</span>
                    <span class="detail-value">{{ $tanah->jenis->nama_jenis ?? '-' }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Luas</span>
                    <span class="detail-value">{{ number_format($tanah->luas, 0, ',', '.') }} m²</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Wakif</span>
                    <span class="detail-value">{{ $tanah->wakif ?: '-' }}</span>
                </div>

                <div class="detail-item detail-item-full">
                    <span class="detail-label">Alamat (RT/RW/Dusun)</span>
                    <span class="detail-value">{{ $tanah->alamat }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Desa</span>
                    <span class="detail-value">{{ $tanah->desa->nama_desa ?? '-' }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Nadzir</span>
                    <span class="detail-value">{{ $tanah->nadzir->nama_nadzir ?? '-' }}</span>
                </div>
            </div>
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

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem 2rem;
        }

        .detail-item-full {
            grid-column: 1 / -1;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--claude-border, #e6e4dc);
        }

        .detail-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--claude-text-light, #706b5b);
        }

        .detail-value {
            font-size: 1rem;
            font-weight: 500;
            color: var(--claude-text, #3d3929);
        }

        .badge-soft {
            display: inline-block;
            width: fit-content;
            padding: 0.28rem 0.65rem;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .badge-soft-success {
            background: #f0fdfa;
            color: #0f766e;
            border: 1px solid #ccfbf1;
        }

        .badge-soft-muted {
            background: #f7f6f0;
            color: #706b5b;
            border: 1px solid #e6e4dc;
        }

        @media (max-width: 576px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection