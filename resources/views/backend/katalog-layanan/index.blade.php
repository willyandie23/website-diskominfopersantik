@extends('backend.layouts.app')
@section('title', 'Admin - Daftar Katalog Layanan')
@push('styles')
    <style>
        /* ── Page Header ── */
        .page-header-layanan {
            background: linear-gradient(135deg, #1a3c5e 0%, #1e6fa8 55%, #0ea5e9 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(14, 103, 168, 0.22);
        }
        .page-header-layanan::before {
            content: '';
            position: absolute;
            top: -50px; right: -50px;
            width: 220px; height: 220px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
        }
        .page-header-layanan::after {
            content: '';
            position: absolute;
            bottom: -70px; right: 100px;
            width: 160px; height: 160px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }
        .page-header-layanan .header-icon-wrap {
            width: 52px; height: 52px;
            background: rgba(255,255,255,0.15);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: #fff;
            flex-shrink: 0;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .page-header-layanan h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 3px;
        }
        .page-header-layanan p {
            color: rgba(255,255,255,0.72);
            font-size: 0.87rem;
            margin: 0;
        }
        .header-stats-badge {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 10px;
            padding: 5px 14px;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            backdrop-filter: blur(4px);
            margin-top: 8px;
        }
        .btn-add-layanan {
            background: #fff;
            color: #1a5fa8;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.12);
            transition: all 0.2s ease;
            text-decoration: none;
            white-space: nowrap;
            position: relative; z-index: 1;
        }
        .btn-add-layanan:hover {
            background: #e0f0ff;
            color: #0d4a8a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .btn-add-layanan i {
            font-size: 0.82rem;
        }
        /* ── Card ── */
        .layanan-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 24px rgba(0,0,0,0.07);
            overflow: hidden;
        }
        .layanan-card .card-body {
            padding: 24px;
        }
        /* ── Table ── */
        #layananTable thead th {
            background: #f4f7fb;
            color: #64748b;
            font-size: 0.73rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            border: none;
            padding: 13px 16px;
        }
        #layananTable tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s;
        }
        #layananTable tbody tr:hover {
            background: #f5f9ff;
        }
        #layananTable tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            border: none;
            font-size: 0.9rem;
        }
        /* ── Thumbnail ── */
        .layanan-thumb-wrap {
            position: relative;
            display: inline-block;
        }
        .layanan-thumb {
            width: 108px;
            height: 68px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
            display: block;
        }
        .layanan-thumb:hover {
            transform: scale(1.06);
            box-shadow: 0 6px 18px rgba(0,0,0,0.14);
        }
        .no-image-placeholder {
            width: 108px;
            height: 68px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 4px;
            border: 2px dashed #cbd5e1;
        }
        .no-image-placeholder i { color: #94a3b8; font-size: 1.2rem; }
        .no-image-placeholder span { color: #b0bec5; font-size: 0.65rem; }
        /* ── Name ── */
        .layanan-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
            line-height: 1.4;
        }
        .layanan-desc {
            color: #94a3b8;
            font-size: 0.78rem;
            margin-top: 2px;
        }
        /* ── Status Badge ── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.78rem;
            border-radius: 7px;
            padding: 4px 10px;
            font-weight: 600;
        }
        .status-aktif {
            background: #d1fae5;
            color: #065f46;
        }
        .status-nonaktif {
            background: #fee2e2;
            color: #991b1b;
        }
        /* ── Date ── */
        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 0.78rem;
            border-radius: 7px;
            padding: 4px 10px;
            font-weight: 500;
        }
        /* ── Row number ── */
        .row-number {
            background: #e0eaff;
            color: #3b5bdb;
            font-weight: 700;
            font-size: 0.75rem;
            width: 28px; height: 28px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        /* ── Action buttons ── */
        .btn-action {
            width: 34px; height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            font-size: 0.82rem;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-edit-action {
            background: #fff7e6;
            color: #d97706;
        }
        .btn-edit-action:hover {
            background: #fde68a;
            color: #b45309;
            transform: translateY(-1px);
        }
        .btn-delete-action {
            background: #fff1f2;
            color: #e11d48;
        }
        .btn-delete-action:hover {
            background: #fecdd3;
            color: #9f1239;
            transform: translateY(-1px);
        }
        /* ── Empty state ── */
        .empty-state { padding: 64px 20px; text-align: center; }
        .empty-state-icon {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #e0eaff, #f0f4ff);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 4px 16px rgba(59, 91, 219, 0.1);
        }
        .empty-state-icon i { font-size: 2rem; color: #7c8fc2; }
        .empty-state h6 { font-weight: 700; color: #334155; margin-bottom: 6px; }
        .empty-state p { color: #94a3b8; font-size: 0.85rem; margin-bottom: 20px; }
        .btn-empty-add {
            background: linear-gradient(135deg, #1e6fa8, #0ea5e9);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 22px;
            font-size: 0.86rem;
            font-weight: 600;
            display: inline-flex; align-items: center; gap: 7px;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.3);
        }
        .btn-empty-add:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }
    </style>
@endpush
@section('content')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    timer: 2500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true,
                });
            });
        </script>
    @endif
    {{-- Page Header --}}
    <div class="page-header-layanan d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3" style="position:relative;z-index:1;">
            <div class="header-icon-wrap">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <div>
                <h4 class="mb-0">Katalog Layanan</h4>
                <p>Kelola daftar layanan yang tersedia di website Anda.</p>
                <span class="header-stats-badge">
                    <i class="fas fa-layer-group"></i>
                    {{ $katalogLayanan->count() }} Layanan Terdaftar
                </span>
            </div>
        </div>
        <a href="{{ route('katalog-layanan.create') }}" class="btn-add-layanan">
            <i class="fas fa-plus"></i> Tambah Layanan
        </a>
    </div>
    {{-- Main Card --}}
    <div class="layanan-card card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="layananTable" class="table">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="130">Gambar</th>
                            <th>Judul Layanan</th>
                            <th>URL</th>
                            <th>Tanggal Dibuat</th>
                            <th width="100" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($katalogLayanan as $item)
                            <tr>
                                <td><span class="row-number">{{ $loop->iteration }}</span></td>
                                <td>
                                    @if ($item->image)
                                        <div class="layanan-thumb-wrap">
                                            <img src="{{ Storage::url($item->image) }}"
                                                alt="{{ $item->title }}"
                                                class="layanan-thumb">
                                        </div>
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-image"></i>
                                            <span>No Image</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="layanan-name">{{ $item->title }}</div>
                                    <div class="layanan-desc">{{ Str::limit(strip_tags($item->deskripsi), 50) }}</div>
                                </td>
                                <td>
                                    @if($item->url_video)
                                        <a href="{{ $item->url_video }}" target="_blank" class="status-badge status-aktif" style="text-decoration:none;">
                                            <i class="fas fa-video"></i> Video
                                        </a>
                                    @endif
                                    @if($item->url_website)
                                        <a href="{{ $item->url_website }}" target="_blank" class="status-badge" style="text-decoration:none; background:#e0eaff; color:#1a5fa8;">
                                            <i class="fas fa-globe"></i> Website
                                        </a>
                                    @endif
                                    @if(!$item->url_video && !$item->url_website)
                                        <span class="text-muted" style="font-size:0.78rem;">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="date-badge">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $item->created_at->format('d M Y, H:i') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('katalog-layanan.edit', $item) }}"
                                       class="btn-action btn-edit-action me-1"
                                       title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('katalog-layanan.destroy', $item) }}"
                                          method="POST"
                                          class="d-inline form-delete-layanan">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete-action" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-concierge-bell"></i>
                                        </div>
                                        <h6>Belum ada layanan terdaftar</h6>
                                        <p>Mulai tambahkan layanan pertama Anda ke katalog.</p>
                                        <a href="{{ route('katalog-layanan.create') }}" class="btn-empty-add">
                                            <i class="fas fa-plus"></i> Tambah Sekarang
                                        </a>
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
    $(document).ready(function() {
        $('#layananTable').DataTable({
            language: {
                processing:     "Sedang memproses...",
                search:         "Cari:",
                lengthMenu:     "Tampilkan _MENU_ data per halaman",
                info:           "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty:      "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered:   "(disaring dari _MAX_ total data)",
                zeroRecords:    "Tidak ditemukan data yang sesuai",
                emptyTable:     "Tidak ada data tersedia",
                paginate: {
                    first:      "Pertama",
                    previous:   "Sebelumnya",
                    next:       "Berikutnya",
                    last:       "Terakhir"
                },
                aria: {
                    sortAscending:  ": aktifkan untuk mengurutkan kolom naik",
                    sortDescending: ": aktifkan untuk mengurutkan kolom turun"
                }
            },
            pageLength: 15,
            lengthMenu: [10, 15, 25, 50, 100],
            responsive: true,
            order: [[0, 'asc']],                    // urutkan berdasarkan Tanggal Dibuat (kolom ke-5)
            columnDefs: [
                { orderable: false, targets: [0, 1, 5] }   // No, Gambar, dan Aksi tidak boleh diurut
            ]
        });

        // Konfirmasi hapus dengan SweetAlert
        document.querySelectorAll('.form-delete-layanan').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus layanan ini?',
                    text: 'Data yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush