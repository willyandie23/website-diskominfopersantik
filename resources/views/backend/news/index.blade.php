@extends('backend.layouts.app')

@section('title', 'Admin - Daftar Berita')

@push('styles')

    <style>
        .page-header-news {
            background: linear-gradient(135deg, #0f4c2a 0%, #1a7a47 60%, #22c55e 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(15, 76, 42, 0.2);
        }

        .page-header-news::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .page-header-news::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: 80px;
            width: 140px;
            height: 140px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .page-header-news h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.35rem;
            margin-bottom: 4px;
        }

        .page-header-news p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.88rem;
            margin: 0;
        }

        .btn-add-news {
            background: #fff;
            color: #0f4c2a;
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

        .btn-add-news:hover {
            background: #dcfce7;
            color: #0f4c2a;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .news-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .news-card .card-body {
            padding: 24px;
        }

        /* Table */
        #newsTable thead th {
            background: #f4f7fb;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: none;
            padding: 14px 16px;
        }

        #newsTable tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s;
        }

        #newsTable tbody tr:hover {
            background: #f8fff9;
        }

        #newsTable tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border: none;
            font-size: 0.9rem;
        }

        /* Thumbnail */
        .news-thumb {
            width: 90px;
            height: 62px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e8edf5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s;
        }

        .news-thumb:hover {
            transform: scale(1.06);
        }

        .no-image-placeholder {
            width: 90px;
            height: 62px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #cbd5e1;
        }

        .no-image-placeholder i {
            color: #94a3b8;
            font-size: 1.1rem;
        }

        /* Title */
        .news-title {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-width: 300px;
        }

        /* Creator */
        .creator-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f1f5f9;
            color: #475569;
            font-size: 0.78rem;
            border-radius: 20px;
            padding: 4px 10px;
            font-weight: 500;
        }

        .creator-chip i {
            color: #94a3b8;
        }

        /* Counter badge */
        .counter-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #ecfdf5;
            color: #059669;
            font-weight: 700;
            font-size: 0.8rem;
            border-radius: 8px;
            padding: 4px 10px;
            border: 1px solid #a7f3d0;
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

        /* Row number */
        .row-number {
            background: #dcfce7;
            color: #15803d;
            font-weight: 700;
            font-size: 0.78rem;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

    <div class="page-header-news d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div style="position:relative;z-index:1;">
            <h4><i class="fas fa-newspaper me-2"></i>Daftar Berita</h4>
            <p>Kelola berita yang tampil di halaman website Anda.</p>
        </div>
        <a href="{{ route('berita.create') }}" class="btn-add-news" style="position:relative;z-index:1;">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>

    <div class="news-card card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="newsTable" class="table">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="110">Gambar</th>
                            <th>Judul Berita</th>
                            <th>Pembuat</th>
                            <th width="90" class="text-center">Views</th>
                            <th width="160">Tanggal Dibuat</th>
                            <th width="100" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $item)
                            <tr>
                                <td><span class="row-number"></span></td>
                                <td>
                                    @if ($item->image)
                                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="news-thumb">
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="news-title">{{ $item->title }}</span>
                                </td>
                                <td>
                                    <span class="creator-chip">
                                        <i class="fas fa-user-circle"></i>
                                        {{ $item->creator?->name ?? 'Admin' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="counter-badge">
                                        <i class="fas fa-eye"></i>
                                        {{ number_format($item->counter) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="date-badge">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $item->created_at->format('d M Y, H:i') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('berita.edit', $item) }}" class="btn-action btn-edit-action me-1"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('berita.destroy', $item) }}" method="POST"
                                        class="d-inline form-delete-news">
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
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                        <p class="fw-semibold text-secondary mb-1">Belum ada berita</p>
                                        <small class="text-muted">Tambahkan berita pertama Anda dengan klik tombol di
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
            new DataTable('#newsTable', {
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                },
                pageLength: 15,
                lengthMenu: [10, 15, 25, 50, 100],
                responsive: true,
                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        render: (data, type, row, meta) =>
                            '<span class="row-number">' + (meta.row + 1) + '</span>'
                    },
                    {
                        targets: [1, 6],
                        orderable: false
                    }
                ]
            });

            document.querySelectorAll('.form-delete-news').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus berita ini?',
                        text: 'Data yang dihapus tidak dapat dikembalikan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e11d48',
                        cancelButtonColor: '#94a3b8',
                        confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
@endpush
