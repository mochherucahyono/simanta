@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex flex-wrap justify-content-between align-items-center page-header mt-3 mb-4">
            <div>
                <h2 class="mb-1">Data Sertifikat</h2>
                <p class="text-muted mb-0">Daftar seluruh sertifikat tanah yang terdaftar dalam sistem.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('sertifikats.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-1"></i> Tambah Sertifikat
                </a>
                <button onclick="printTable()" class="btn btn-outline-claude">
                    <i class="fa fa-print me-1"></i> Cetak
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-claude d-flex align-items-center gap-2 mb-4">
                <i class="fa fa-check-circle text-success"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="table-responsive" id="print-area">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nama Tanah</th>
                            <th>Wakif</th>
                            <th>Luas (m²)</th>
                            <th>No. Sertifikat</th>
                            <th>Tanggal Terbit</th>
                            <th>No. AIW</th>
                            <th>Tanggal AIW</th>
                            <th style="min-width: 110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sertifikats as $sertifikat)
                            <tr>
                                <td class="fw-semibold" style="color: var(--claude-text, #3d3929);">{{ $sertifikat->tanah->nama ?? '-' }}</td>
                                <td>{{ $sertifikat->tanah->wakif ?? '-' }}</td>
                                <td>{{ isset($sertifikat->tanah->luas) ? number_format($sertifikat->tanah->luas, 0, ',', '.') : '-' }}</td>
                                <td>
                                    @if($sertifikat->nomor_sertifikat)
                                        <span class="badge-soft badge-soft-success">{{ $sertifikat->nomor_sertifikat }}</span>
                                    @else
                                        <span class="badge-soft badge-soft-muted">Belum ada</span>
                                    @endif
                                </td>
                                <td>{{ $sertifikat->tanggal_terbit ?? '-' }}</td>
                                <td>{{ $sertifikat->nomor_aiw ?? '-' }}</td>
                                <td>{{ $sertifikat->tanggal_aiw ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('sertifikats.show', $sertifikat->id) }}" class="btn btn-icon btn-action-soft" title="Detail">
                                            <i class="fa fa-info-circle"></i>
                                        </a>
                                        <a href="{{ route('sertifikats.edit', $sertifikat->id) }}" class="btn btn-icon btn-action-soft" title="Ubah">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-icon btn-action-danger" title="Hapus"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-id="{{ $sertifikat->id }}"
                                            data-nama="{{ $sertifikat->tanah->nama ?? 'Sertifikat ini' }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="fa fa-inbox fa-2x mb-2 d-block opacity-50"></i>
                                    Belum ada data sertifikat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-claude">
                <div class="modal-body text-center p-4">
                    <div class="modal-icon-danger mx-auto mb-3">
                        <i class="fa fa-trash"></i>
                    </div>
                    <h5 class="fw-bold mb-2" id="deleteModalLabel">Hapus Data Sertifikat?</h5>
                    <p class="text-muted mb-1">Anda akan menghapus sertifikat untuk tanah:</p>
                    <p class="fw-semibold mb-3" id="deleteNama" style="color: var(--claude-text, #3d3929);"></p>
                    <p class="small text-muted mb-4">Tindakan ini tidak dapat dibatalkan.</p>

                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex gap-2 justify-content-center">
                            <button type="button" class="btn btn-outline-claude" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger-claude">
                                <i class="fa fa-trash me-1"></i> Ya, Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Cegah latar belakang bergeser saat modal terbuka */
        html {
            scrollbar-gutter: stable;
        }

        body.modal-open {
            padding-right: 0 !important;
            overflow: hidden;
        }

        body.modal-open .fixed-top,
        body.modal-open .sticky-top,
        body.modal-open .fixed-bottom {
            padding-right: 0 !important;
            margin-right: 0 !important;
        }

        .modal-backdrop {
            background-color: rgba(61, 57, 41, 0.4);
        }

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

        .alert-claude {
            background: #ffffff;
            border: 1px solid var(--claude-border, #e6e4dc);
            color: var(--claude-text, #3d3929);
            border-radius: 10px;
            padding: 0.75rem 1rem;
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

        .btn-icon {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 1px solid var(--claude-border, #e6e4dc);
            background: var(--claude-surface, #ffffff);
            color: var(--claude-text-light, #706b5b);
            transition: all 0.2s ease;
            padding: 0;
        }

        .btn-action-soft:hover {
            background: var(--claude-hover, #f3f1e5);
            color: var(--claude-text, #3d3929);
            border-color: var(--claude-text-light, #706b5b);
        }

        .btn-action-danger:hover {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fca5a5;
        }

        /* Modal */
        .modal-claude {
            background: var(--claude-surface, #ffffff);
            border: 1px solid var(--claude-border, #e6e4dc);
            border-radius: 14px;
            box-shadow: 0 10px 40px rgba(61, 57, 41, 0.15);
        }

        .modal-icon-danger {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fca5a5;
            font-size: 1.3rem;
        }

        .btn-danger-claude {
            background: #b91c1c;
            border: 1px solid #b91c1c;
            color: #ffffff;
            font-weight: 500;
            padding: 0.55rem 1.1rem;
            border-radius: var(--radius-md, 10px);
            transition: all 0.2s ease;
        }

        .btn-danger-claude:hover {
            background: #991b1b;
            border-color: #991b1b;
            color: #ffffff;
        }
    </style>

    <script>
        // Isi modal hapus dengan data baris yang diklik
        const deleteModal = document.getElementById('deleteModal');
        const deleteUrlTemplate = "{{ route('sertifikats.destroy', ':id') }}";

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;
            document.getElementById('deleteNama').textContent = btn.getAttribute('data-nama');
            document.getElementById('deleteForm').action =
                deleteUrlTemplate.replace(':id', btn.getAttribute('data-id'));
        });

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