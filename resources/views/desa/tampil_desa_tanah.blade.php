@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex flex-wrap justify-content-between align-items-center page-header mt-3 mb-4">
            <div>
                <h2 class="mb-1">Data Tanah Berdasarkan Desa</h2>
                <p class="text-muted mb-0">Pengelompokan bidang tanah menurut desa lokasi.</p>
            </div>
            <div class="d-flex gap-2">
                <button onclick="printTable()" class="btn btn-outline-claude">
                    <i class="fa fa-print me-1"></i> Cetak
                </button>
            </div>
        </div>

        <div id="print-area">
            @forelse($desaList as $desa)
                <div class="card group-card mb-4">
                    <div class="group-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa fa-map-marker-alt"></i>
                            <strong>{{ $desa->nama_desa }}</strong>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge-soft badge-soft-muted">{{ $desa->tanahs ? $desa->tanahs->count() : 0 }} bidang</span>
                            <span class="badge-soft badge-soft-muted">{{ number_format($desa->tanahs ? $desa->tanahs->sum('luas') : 0, 0, ',', '.') }} m²</span>
                        </div>
                    </div>

                    @if($desa->tanahs && $desa->tanahs->count())
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>No. Sertifikat</th>
                                        <th>Jenis</th>
                                        <th>Nama Tanah</th>
                                        <th>Luas (m²)</th>
                                        <th style="min-width: 160px;">Alamat</th>
                                        <th>Nadzir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($desa->tanahs as $tanah)
                                        <tr>
                                            <td>
                                                @if($tanah->sertifikat->nomor_sertifikat ?? false)
                                                    <span class="badge-soft badge-soft-success">{{ $tanah->sertifikat->nomor_sertifikat }}</span>
                                                @else
                                                    <span class="badge-soft badge-soft-muted">Belum ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $tanah->jenis->nama_jenis ?? '-' }}</td>
                                            <td class="fw-semibold" style="color: var(--claude-text, #3d3929);">{{ $tanah->nama }}</td>
                                            <td>{{ number_format($tanah->luas, 0, ',', '.') }}</td>
                                            <td style="white-space: normal; word-break: break-word;">{{ $tanah->alamat }}</td>
                                            <td>{{ $tanah->nadzir->nama_nadzir ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fa fa-inbox fa-2x mb-2 d-block opacity-50"></i>
                            Belum ada tanah untuk desa ini.
                        </div>
                    @endif
                </div>
            @empty
                <div class="card">
                    <div class="text-center text-muted py-5">
                        <i class="fa fa-inbox fa-2x mb-2 d-block opacity-50"></i>
                        Tidak ada data desa.
                    </div>
                </div>
            @endforelse
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

        .group-card {
            overflow: hidden;
        }

        .group-header {
            background: var(--claude-hover, #f7f6f0);
            border-bottom: 1px solid var(--claude-border, #e6e4dc);
            color: var(--claude-text, #3d3929);
            padding: 0.85rem 1.1rem;
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

        .group-header .badge-soft-muted {
            background: #ffffff;
        }
    </style>

    <script>
        function printTable() {
            var printContents = document.getElementById('print-area').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection