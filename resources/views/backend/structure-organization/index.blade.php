@extends('backend.layouts.app')
@section('title', 'Admin - Daftar Struktur Organisasi')

@push('css')
<style>
    /* ===== KAIDA ADMIN - STRUKTUR ORGANISASI ===== */
    .page-header-card {
        background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
        border-radius: 12px;
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.3);
    }
    .page-header-card h4 {
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin: 0;
    }
    .page-header-card .breadcrumb {
        margin: 0;
        font-size: 0.82rem;
        opacity: 0.85;
    }
    .page-header-card .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.6);
    }

    /* Stats row */
    .stat-card {
        border: none;
        border-radius: 12px;
        padding: 1.1rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 1.2rem;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.11); }
    .stat-icon {
        width: 52px; height: 52px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .stat-card .stat-label { font-size: 0.78rem; color: #6b7280; font-weight: 500; margin-bottom: 2px; }
    .stat-card .stat-value { font-size: 1.45rem; font-weight: 700; color: #1f2937; line-height: 1; }

    /* Main card */
    .main-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        overflow: hidden;
    }
    .main-card .card-header {
        background: #fff;
        border-bottom: 2px solid #f3f4f6;
        padding: 1.1rem 1.5rem;
    }
    .main-card .card-header h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
    }
    .main-card .card-body { padding: 1.5rem; }

    /* Avatar photo */
    .member-avatar {
        width: 48px; height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e5e7eb;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .avatar-placeholder {
        width: 48px; height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ddd6fe, #c4b5fd);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; color: #7c3aed;
        border: 2px solid #e5e7eb;
    }

    /* Name + jabatan cell */
    .member-info .member-name { font-weight: 600; color: #1f2937; font-size: 0.93rem; }
    .member-info .member-jabatan { font-size: 0.78rem; color: #6b7280; margin-top: 1px; }

    /* Bidang badge */
    .badge-bidang {
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
        font-size: 0.73rem;
        font-weight: 600;
        padding: 4px 9px;
        border-radius: 20px;
    }
    .badge-golongan {
        background: #faf5ff;
        color: #7c3aed;
        border: 1px solid #ddd6fe;
        font-size: 0.73rem;
        font-weight: 600;
        padding: 4px 9px;
        border-radius: 20px;
    }

    /* Status badge */
    .badge-active {
        background: #d1fae5; color: #065f46;
        border: 1px solid #6ee7b7;
        font-size: 0.73rem; font-weight: 600;
        padding: 4px 10px; border-radius: 20px;
        display: inline-flex; align-items: center; gap: 4px;
    }
    .badge-inactive {
        background: #f3f4f6; color: #6b7280;
        border: 1px solid #d1d5db;
        font-size: 0.73rem; font-weight: 600;
        padding: 4px 10px; border-radius: 20px;
        display: inline-flex; align-items: center; gap: 4px;
    }

    /* Table */
    #structureTable thead th {
        background: #f8fafc;
        color: #374151;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e5e7eb;
        padding: 12px 14px;
        white-space: nowrap;
    }
    #structureTable tbody td {
        padding: 12px 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.875rem;
    }
    #structureTable tbody tr:hover { background: #f9fafb; }
    #structureTable tbody tr:last-child td { border-bottom: none; }

    /* Action buttons */
    .btn-action {
        width: 32px; height: 32px;
        border-radius: 8px;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.78rem;
        border: none;
        transition: all 0.18s ease;
        cursor: pointer;
    }
    .btn-action:hover { transform: scale(1.08); }
    .btn-edit-action { background: #fff3cd; color: #92400e; }
    .btn-edit-action:hover { background: #fbbf24; color: #fff; }
    .btn-delete-action { background: #fee2e2; color: #991b1b; }
    .btn-delete-action:hover { background: #ef4444; color: #fff; }

    /* No data */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
        color: #9ca3af;
    }
    .empty-state i { font-size: 3.5rem; margin-bottom: 1rem; opacity: 0.4; }
    .empty-state p { font-size: 0.95rem; }

    /* Search bar override */
    .dataTables_filter input {
        border-radius: 8px !important;
        border: 1px solid #e5e7eb !important;
        padding: 6px 12px !important;
        font-size: 0.85rem !important;
    }
    .dataTables_length select {
        border-radius: 8px !important;
        border: 1px solid #e5e7eb !important;
        padding: 4px 8px !important;
        font-size: 0.85rem !important;
    }

    @media (max-width: 768px) {
        .page-header-card { padding: 1.1rem 1.2rem; }
        .page-header-card h4 { font-size: 1.1rem; }
        .stat-card { padding: 0.9rem 1rem; }
        .main-card .card-body { padding: 1rem; }
    }
</style>
@endpush

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header-card text-white">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
        <div>
            <h4 class="text-white"><i class="fas fa-sitemap me-2"></i>Struktur Organisasi</h4>
            {{-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-white text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active text-white">Struktur Organisasi</li>
                </ol>
            </nav> --}}
        </div>
        <a href="{{ route('struktur-organisasi.create') }}" class="btn btn-light btn-sm fw-semibold px-3">
            <i class="fas fa-plus me-1"></i> Tambah Data Baru
        </a>
    </div>
</div>

<!-- ===== STATS ROW ===== -->
<div class="row g-3 mb-3">
    <div class="col-6 col-md-4">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#eff6ff;">
                <i class="fas fa-users" style="color:#2563eb;"></i>
            </div>
            <div>
                <div class="stat-label">Total Anggota</div>
                <div class="stat-value">{{ $structures->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#d1fae5;">
                <i class="fas fa-user-check" style="color:#059669;"></i>
            </div>
            <div>
                <div class="stat-label">Aktif</div>
                <div class="stat-value">{{ $structures->where('is_active', true)->count() }}</div>
            </div>
        </div>
    </div>
    {{-- <div class="col-6 col-md-4">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#faf5ff;">
                <i class="fas fa-layer-group" style="color:#7c3aed;"></i>
            </div>
            <div>
                <div class="stat-label">Bidang</div>
                <div class="stat-value">{{ $structures->pluck('field_id')->filter()->unique()->count() }}</div>
            </div>
        </div>
    </div> --}}
    <div class="col-6 col-md-4">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#fff7ed;">
                <i class="fas fa-id-badge" style="color:#ea580c;"></i>
            </div>
            <div>
                <div class="stat-label">Non-Aktif</div>
                <div class="stat-value">{{ $structures->where('is_active', false)->count() }}</div>
            </div>
        </div>
    </div>
</div>

<!-- ===== ALERT ===== -->
@if (session('success'))
    <div class="alert border-0 rounded-3 d-flex align-items-center gap-2 mb-3"
         style="background:#d1fae5; color:#065f46;" role="alert">
        <i class="fas fa-check-circle fs-5"></i>
        <span class="fw-medium">{{ session('success') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- ===== MAIN TABLE CARD ===== -->
<div class="main-card card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-table me-2 text-primary"></i>Daftar Anggota</h5>
        <span class="badge" style="background:#eff6ff; color:#1d4ed8; font-size:0.78rem; padding:5px 10px; border-radius:8px;">
            {{ $structures->count() }} data
        </span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="structureTable" class="table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="60">Foto</th>
                        <th>Nama & Jabatan</th>
                        <th>Bidang</th>
                        <th>NIP</th>
                        <th>Status</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($structures as $structure)
                        <tr>
                            <td class="text-center fw-semibold text-muted"></td>
                            <td>
                                @if ($structure->gambar)
                                    <img src="{{ $structure->gambar_url }}"
                                         alt="{{ $structure->nama }}"
                                         class="member-avatar">
                                @else
                                    <div class="avatar-placeholder">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="member-info">
                                    <div class="member-name">{{ $structure->nama }}</div>
                                    <div class="member-jabatan"><i class="fas fa-briefcase me-1" style="color:#9ca3af;font-size:0.7rem;"></i>{{ $structure->jabatan }}</div>
                                </div>
                            </td>
                            <td>
                                @if($structure->field?->nama_bidang)
                                    <span class="badge-bidang">{{ $structure->field->nama_bidang }}</span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td>
                                @if($structure->golongan)
                                    <span class="badge-golongan">{{ $structure->golongan }}</span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td>
                                @if($structure->is_active)
                                    <span class="badge-active">
                                        <i class="fas fa-circle" style="font-size:0.4rem;"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge-inactive">
                                        <i class="fas fa-circle" style="font-size:0.4rem;"></i> Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('struktur-organisasi.edit', $structure) }}"
                                   class="btn-action btn-edit-action me-1"
                                   title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('struktur-organisasi.destroy', $structure) }}"
                                      method="POST" class="d-inline" id="form-delete-{{ $structure->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="btn-action btn-delete-action"
                                            title="Hapus Data"
                                            onclick="confirmDelete({{ $structure->id }}, '{{ addslashes($structure->nama) }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-sitemap d-block"></i>
                                    <p class="mb-0 fw-medium">Belum ada data struktur organisasi</p>
                                    <small>Mulai tambahkan data dengan klik tombol <strong>Tambah Data Baru</strong></small>
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
    // ===== DataTable Init =====
    $(document).ready(function () {
        new DataTable('#structureTable', {
            language: { url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json' },
            pageLength: 15,
            lengthMenu: [10, 15, 25, 50, 100],
            order: [[0, 'asc']],
            responsive: true,
            columnDefs: [
                { targets: 0, orderable: false, render: (data, type, row, meta) => meta.row + 1 },
                { targets: [1, 6], orderable: false }
            ]
        });
    });

    // ===== SweetAlert Delete Confirm =====
    function confirmDelete(id, nama) {
        Swal.fire({
            title: 'Hapus Data?',
            html: `Yakin ingin menghapus data <strong>${nama}</strong>?<br><small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times me-1"></i> Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-4',
                confirmButton: 'btn btn-danger btn-sm px-3',
                cancelButton: 'btn btn-secondary btn-sm px-3 me-2'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-' + id).submit();
            }
        });
    }

    // ===== SweetAlert Success Toast =====
    @if(session('success'))
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    @endif
</script>
@endpush