@extends('backend.layouts.app')

@section('title', 'Admin - Daftar Banner')

@push('styles')
    
    <style>
        .page-header-banner {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 60%, #1a8cff 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(30, 58, 95, 0.18);
        }

        .page-header-banner::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .page-header-banner::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: 80px;
            width: 140px;
            height: 140px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .page-header-banner h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.35rem;
            margin-bottom: 4px;
        }

        .page-header-banner p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.88rem;
            margin: 0;
        }

        .btn-add-banner {
            background: #fff;
            color: #1e3a5f;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            border-radius: 10px;
            padding: 9px 18px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
            transition: all 0.2s;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-add-banner:hover {
            background: #e8f4ff;
            color: #1a5fa8;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .banner-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .banner-card .card-body {
            padding: 24px;
        }

        /* Table styling */
        #bannerTable thead th {
            background: #f4f7fb;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: none;
            padding: 14px 16px;
        }

        #bannerTable tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s;
        }

        #bannerTable tbody tr:hover {
            background: #f8faff;
        }

        #bannerTable tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border: none;
            font-size: 0.9rem;
        }

        /* Banner thumbnail */
        .banner-thumb {
            width: 110px;
            height: 68px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e8edf5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s;
        }

        .banner-thumb:hover {
            transform: scale(1.05);
        }

        .no-image-placeholder {
            width: 110px;
            height: 68px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #cbd5e1;
        }

        .no-image-placeholder i {
            color: #94a3b8;
            font-size: 1.3rem;
        }

        /* Badge & Name */
        .banner-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.92rem;
        }

        /* Date */
        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 0.78rem;
            border-radius: 6px;
            padding: 4px 10px;
        }

        /* Action buttons */
        .btn-action {
            width: 34px;
            height: 34px;
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
        }

        .btn-delete-action {
            background: #fff1f2;
            color: #e11d48;
        }

        .btn-delete-action:hover {
            background: #fecdd3;
            color: #9f1239;
        }

        /* Empty state */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state-icon {
            width: 72px;
            height: 72px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .empty-state-icon i {
            font-size: 1.8rem;
            color: #94a3b8;
        }

        /* Row number */
        .row-number {
            background: #e8f0fe;
            color: #3b5bdb;
            font-weight: 700;
            font-size: 0.78rem;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
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

    <div class="page-header-banner d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div style="position:relative;z-index:1;">
            <h4><i class="fas fa-images me-2"></i>Daftar Banner (Slide Show)</h4>
            <p>Kelola banner yang tampil di halaman depan website Anda.</p>
        </div>
        <a href="{{ route('banner.create') }}" class="btn-add-banner" style="position:relative;z-index:1;">
            <i class="fas fa-plus"></i> Tambah Banner
        </a>
    </div>

    <div class="banner-card card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="bannerTable" class="table">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="130">Gambar</th>
                            <th>Nama Banner</th>
                            <th>Tanggal Dibuat</th>
                            <th width="100" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $banner)
                            <tr>
                                <td><span class="row-number"></span></td>
                                <td>
                                    @if ($banner->path)
                                        <img src="{{ Storage::url($banner->path) }}" alt="{{ $banner->name }}"
                                            class="banner-thumb">
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="banner-name">{{ $banner->name }}</span>
                                </td>
                                <td>
                                    <span class="date-badge">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $banner->created_at->format('d M Y, H:i') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('banner.edit', $banner) }}" class="btn-action btn-edit-action me-1"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('banner.destroy', $banner) }}" method="POST"
                                        class="d-inline form-delete-banner">
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
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-image"></i>
                                        </div>
                                        <p class="fw-semibold text-secondary mb-1">Belum ada banner</p>
                                        <small class="text-muted">Tambahkan banner pertama Anda dengan klik tombol di
                                            atas.</small>
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
        document.addEventListener('DOMContentLoaded', function() {
            const table = new DataTable('#bannerTable', {
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                },
                pageLength: 15,
                lengthMenu: [10, 15, 25, 50, 100],
                responsive: true,
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, row, meta) {
                            return '<span class="row-number">' + (meta.row + 1) + '</span>';
                        }
                    },
                    {
                        orderable: false,
                        targets: [1, 2, 3, 4]
                    }
                ]
            });

            document.querySelectorAll('.form-delete-banner').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus banner ini?',
                        text: 'Data yang dihapus tidak dapat dikembalikan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e11d48',
                        cancelButtonColor: '#94a3b8',
                        confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        borderRadius: '12px',
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
