@extends('backend.layouts.app')
@section('title', 'Admin - Daftar Pertanyaan Polling')

@push('css')
<style>
    .page-header-card {
        background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
        border-radius: 12px;
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.3);
    }
    .page-header-card h4 { font-size: 1.3rem; font-weight: 700; margin: 0; }

    .stat-card {
        border: none; border-radius: 12px; padding: 1.1rem 1.4rem;
        display: flex; align-items: center; gap: 1rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        transition: transform 0.2s ease; margin-bottom: 1.2rem;
    }
    .stat-card:hover { transform: translateY(-3px); }
    .stat-icon {
        width: 52px; height: 52px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; flex-shrink: 0;
    }
    .stat-card .stat-label { font-size: 0.78rem; color: #6b7280; font-weight: 500; margin-bottom: 2px; }
    .stat-card .stat-value { font-size: 1.45rem; font-weight: 700; color: #1f2937; }

    .main-card { border: none; border-radius: 14px; box-shadow: 0 2px 16px rgba(0,0,0,0.07); overflow: hidden; }
    .main-card .card-header { background: #fff; border-bottom: 2px solid #f3f4f6; padding: 1.1rem 1.5rem; }
    .main-card .card-header h5 { font-size: 1rem; font-weight: 700; color: #1f2937; }
    .main-card .card-body { padding: 1.5rem; }

    .badge-active { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; font-size: 0.73rem; font-weight: 600; padding: 4px 10px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px; }
    .badge-inactive { background: #f3f4f6; color: #6b7280; border: 1px solid #d1d5db; font-size: 0.73rem; font-weight: 600; padding: 4px 10px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px; }

    #pertanyaanTable thead th { background: #f8fafc; color: #374151; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb; padding: 12px 14px; white-space: nowrap; }
    #pertanyaanTable tbody td { padding: 12px 14px; vertical-align: middle; border-bottom: 1px solid #f3f4f6; font-size: 0.875rem; }
    #pertanyaanTable tbody tr:hover { background: #f9fafb; }

    .btn-action { width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.78rem; border: none; transition: all 0.18s ease; cursor: pointer; }
    .btn-action:hover { transform: scale(1.08); }
    .btn-edit-action { background: #fff3cd; color: #92400e; }
    .btn-edit-action:hover { background: #fbbf24; color: #fff; }
    .btn-delete-action { background: #fee2e2; color: #991b1b; }
    .btn-delete-action:hover { background: #ef4444; color: #fff; }
</style>
@endpush

@section('content')
<!-- PAGE HEADER -->
<div class="page-header-card text-white">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
        <div>
            <h4 class="text-white"><i class="fas fa-poll me-2"></i>Pertanyaan Polling</h4>
        </div>
        <a href="{{ route('pertanyaan.create') }}" class="btn btn-light btn-sm fw-semibold px-3">
            <i class="fas fa-plus me-1"></i> Tambah Pertanyaan
        </a>
    </div>
</div>

<!-- STATS -->
<div class="row g-3 mb-3">
    <div class="col-6 col-md-4">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#eff6ff;">
                <i class="fas fa-question-circle" style="color:#2563eb;"></i>
            </div>
            <div>
                <div class="stat-label">Total Pertanyaan</div>
                <div class="stat-value">{{ $pertanyaans->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#d1fae5;">
                <i class="fas fa-check-circle" style="color:#059669;"></i>
            </div>
            <div>
                <div class="stat-label">Aktif</div>
                <div class="stat-value">{{ $pertanyaans->where('is_active', true)->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#fff7ed;">
                <i class="fas fa-times-circle" style="color:#ea580c;"></i>
            </div>
            <div>
                <div class="stat-label">Non-Aktif</div>
                <div class="stat-value">{{ $pertanyaans->where('is_active', false)->count() }}</div>
            </div>
        </div>
    </div>
</div>

<!-- ALERT -->
@if (session('success'))
    <div class="alert border-0 rounded-3 d-flex align-items-center gap-2 mb-3"
         style="background:#d1fae5; color:#065f46;" role="alert">
        <i class="fas fa-check-circle fs-5"></i>
        <span class="fw-medium">{{ session('success') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- TABLE -->
<div class="main-card card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-table me-2 text-primary"></i>Daftar Pertanyaan</h5>
        <span class="badge" style="background:#eff6ff; color:#1d4ed8; font-size:0.78rem; padding:5px 10px; border-radius:8px;">
            {{ $pertanyaans->count() }} data
        </span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="pertanyaanTable" class="table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Pertanyaan</th>
                        <th>Jumlah Votes</th>
                        <th>Status</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pertanyaans as $item)
                        <tr>
                            <td class="text-center fw-semibold text-muted"></td>
                            <td>{!! Str::limit(strip_tags($item->pertanyaan), 80) !!}</td>
                            <td><span class="fw-semibold">{{ $item->votes_count ?? $item->votes->count() }}</span></td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge-active"><i class="fas fa-circle" style="font-size:0.4rem;"></i> Aktif</span>
                                @else
                                    <span class="badge-inactive"><i class="fas fa-circle" style="font-size:0.4rem;"></i> Non-Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('pertanyaan.edit', $item) }}" class="btn-action btn-edit-action me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pertanyaan.destroy', $item) }}" method="POST" class="d-inline" id="form-delete-{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete-action" title="Hapus"
                                            onclick="confirmDelete({{ $item->id }}, '{{ addslashes(Str::limit(strip_tags($item->pertanyaan), 40)) }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center py-5 text-muted">
                                    <i class="fas fa-poll d-block fs-1 mb-2 opacity-25"></i>
                                    <p class="mb-0 fw-medium">Belum ada pertanyaan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        new DataTable('#pertanyaanTable', {
            language: { url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json' },
            pageLength: 15,
            lengthMenu: [10, 15, 25, 50],
            order: [[0, 'asc']],
            responsive: true,
            columnDefs: [
                { targets: 0, orderable: false, render: (data, type, row, meta) => meta.row + 1 },
                { targets: [4], orderable: false }
            ]
        });
    });

    function confirmDelete(id, pertanyaan) {
        Swal.fire({
            title: 'Hapus Pertanyaan?',
            html: `Yakin ingin menghapus pertanyaan <strong>"${pertanyaan}"</strong>?<br><small class="text-muted">Semua votes terkait juga akan terhapus.</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times me-1"></i> Batal',
            reverseButtons: true,
            customClass: { popup: 'rounded-4', confirmButton: 'btn btn-danger btn-sm px-3', cancelButton: 'btn btn-secondary btn-sm px-3 me-2' },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('form-delete-' + id).submit();
        });
    }

    @if(session('success'))
    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: '{{ session("success") }}', showConfirmButton: false, timer: 3000, timerProgressBar: true });
    @endif
</script>
@endpush