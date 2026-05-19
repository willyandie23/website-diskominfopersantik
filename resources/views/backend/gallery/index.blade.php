@extends('backend.layouts.app')

@section('title', 'Admin - Daftar Gallery')

@push('styles')
    <style>
        /* ── Page Header ── */
        .page-header-galeri {
            background: linear-gradient(135deg, #1a3c5e 0%, #1e6fa8 55%, #0ea5e9 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(14, 103, 168, 0.22);
        }

        .page-header-galeri::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 220px;
            height: 220px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .page-header-galeri::after {
            content: '';
            position: absolute;
            bottom: -70px;
            right: 100px;
            width: 160px;
            height: 160px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .page-header-galeri .header-icon-wrap {
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #fff;
            flex-shrink: 0;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .page-header-galeri h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 3px;
        }

        .page-header-galeri p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.87rem;
            margin: 0;
        }

        .header-stats-badge {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
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

        .btn-add-galeri {
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
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
            transition: all 0.2s ease;
            text-decoration: none;
            white-space: nowrap;
            position: relative;
            z-index: 1;
        }

        .btn-add-galeri:hover {
            background: #e0f0ff;
            color: #0d4a8a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-add-galeri i {
            font-size: 0.82rem;
        }

        /* ── Card ── */
        .galeri-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 24px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .galeri-card .card-body {
            padding: 24px;
        }

        /* ── Table ── */
        #galleryTable thead th {
            background: #f4f7fb;
            color: #64748b;
            font-size: 0.73rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            border: none;
            padding: 13px 16px;
        }

        #galleryTable tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s;
        }

        #galleryTable tbody tr:hover {
            background: #f5f9ff;
        }

        #galleryTable tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            border: none;
            font-size: 0.9rem;
        }

        /* ── Thumbnail ── */
        .gallery-thumb-wrap {
            position: relative;
            display: inline-block;
        }

        .gallery-thumb {
            width: 108px;
            height: 68px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s, box-shadow 0.2s;
            display: block;
        }

        .gallery-thumb:hover {
            transform: scale(1.06);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.14);
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

        .no-image-placeholder i {
            color: #94a3b8;
            font-size: 1.2rem;
        }

        .no-image-placeholder span {
            color: #b0bec5;
            font-size: 0.65rem;
        }

        /* ── Name ── */
        .gallery-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .gallery-name-sub {
            color: #94a3b8;
            font-size: 0.75rem;
            margin-top: 2px;
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
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* ── Action buttons ── */
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
        .empty-state {
            padding: 64px 20px;
            text-align: center;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #e0eaff, #f0f4ff);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 4px 16px rgba(59, 91, 219, 0.1);
        }

        .empty-state-icon i {
            font-size: 2rem;
            color: #7c8fc2;
        }

        .empty-state h6 {
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }

        .empty-state p {
            color: #94a3b8;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }

        .btn-empty-add {
            background: linear-gradient(135deg, #1e6fa8, #0ea5e9);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 22px;
            font-size: 0.86rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.3);
        }

        .btn-empty-add:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            color: #fff;
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

    {{-- Page Header --}}
    <div class="page-header-galeri d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3" style="position:relative;z-index:1;">
            <div class="header-icon-wrap">
                <i class="fas fa-photo-video"></i>
            </div>
            <div>
                <h4 class="mb-0">Daftar Gallery</h4>
                <p>Kelola gambar yang tampil di halaman galeri website Anda.</p>
                <span class="header-stats-badge">
                    <i class="fas fa-layer-group"></i>
                    {{ $galleries->count() }} Gambar Terdaftar
                </span>
            </div>
        </div>
        <a href="{{ route('galeri.create') }}" class="btn-add-galeri">
            <i class="fas fa-plus"></i> Tambah Gallery
        </a>
    </div>

    {{-- Main Card --}}
    <div class="galeri-card card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="galleryTable" class="table">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="130">Gambar</th>
                            <th>Nama Gallery</th>
                            <th>Tanggal Dibuat</th>
                            <th width="100" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galleries as $gallery)
                            <tr>
                                <td><span class="row-number"></span></td>
                                <td>
                                    @if ($gallery->path)
                                        <div class="gallery-thumb-wrap">
                                            <img src="{{ Storage::url($gallery->path) }}" alt="{{ $gallery->name }}"
                                                class="gallery-thumb">
                                        </div>
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-image"></i>
                                            <span>No Image</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="gallery-name">{{ $gallery->name }}</div>
                                    {{-- <div class="gallery-name-sub">
                                        <i class="fas fa-hashtag me-1"></i>ID: {{ $gallery->id }}
                                    </div> --}}
                                </td>
                                <td>
                                    <span class="date-badge">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $gallery->created_at->format('d M Y, H:i') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('galeri.edit', $gallery) }}" class="btn-action btn-edit-action me-1"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('galeri.destroy', $gallery) }}" method="POST"
                                        class="d-inline form-delete-gallery">
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
                                            <i class="fas fa-images"></i>
                                        </div>
                                        <h6>Belum ada gambar gallery</h6>
                                        <p>Mulai tambahkan gambar pertama Anda ke galeri website.</p>
                                        <a href="{{ route('galeri.create') }}" class="btn-empty-add">
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
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#galleryTable', {
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                },
                pageLength: 15,
                lengthMenu: [10, 15, 25, 50, 100],
                responsive: true,
                columnDefs: [{
                        targets: 0,
                        orderable: false,
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

            document.querySelectorAll('.form-delete-gallery').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus gambar ini?',
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
