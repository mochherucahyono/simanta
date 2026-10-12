@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex flex-wrap justify-content-between align-items-center page-header mt-3 mb-4">
            <div>
                <h2 class="mb-1">Detail Sertifikat</h2>
                <p class="text-muted mb-0">{{ $sertifikat->tanah->nama ?? '-' }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('sertifikats.edit', $sertifikat->id) }}" class="btn btn-primary">
                    <i class="fa fa-edit me-1"></i> Ubah
                </a>
                <a href="{{ route('sertifikats.index') }}" class="btn btn-outline-claude">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table detail-table align-middle mb-0">
                    <tbody>
                        <tr>
                            <th>Nama Tanah</th>
                            <td class="fw-semibold" style="color: var(--claude-text, #3d3929);">{{ $sertifikat->tanah->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Wakif</th>
                            <td>{{ $sertifikat->tanah->wakif ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Luas (m²)</th>
                            <td>{{ isset($sertifikat->tanah->luas) ? number_format($sertifikat->tanah->luas, 0, ',', '.') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>No. Sertifikat</th>
                            <td>
                                @if($sertifikat->nomor_sertifikat)
                                    <span class="badge-soft badge-soft-success">{{ $sertifikat->nomor_sertifikat }}</span>
                                @else
                                    <span class="badge-soft badge-soft-muted">Belum ada</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Terbit</th>
                            <td>{{ $sertifikat->tanggal_terbit ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No. AIW</th>
                            <td>{{ $sertifikat->nomor_aiw ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal AIW</th>
                            <td>{{ $sertifikat->tanggal_aiw ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
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

        .detail-table th {
            width: 220px;
            color: var(--claude-text-light, #706b5b);
            font-weight: 600;
            background: var(--claude-hover, #f7f6f0);
            padding: 0.9rem 1.1rem;
        }

        .detail-table td {
            padding: 0.9rem 1.1rem;
            color: var(--claude-text, #3d3929);
        }

        .badge-soft {
            display: inline-block;
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
            .detail-table th {
                width: 120px;
            }
        }
    </style>
@endsection