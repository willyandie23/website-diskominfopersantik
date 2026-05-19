@extends('backend.layouts.app')

@section('title', 'Admin - Daftar Unduhan')

@push('styles')
    <style>
        .page-header-download {
            background: linear-gradient(135deg, #0f4c3a 0%, #1a7a5a 60%, #22c55e 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(15, 76, 58, 0.18);
        }

        .page-header-download::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .page-header-download::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: 80px;
            width: 140px;
            height: 140px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .page-header-download h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.35rem;
            margin-bottom: 4px;
        }

        .page-header-download p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.88rem;
            margin: 0;
        }

        .btn-add-download {
            background: #fff;
            color: #0f4c3a;
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

        .btn-add-download:hover {
            background: #e6faf0;
            color: #0f4c3a;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .download-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .download-card .card-body {
            padding: 24px;
        }

        #downloadTable thead th {
            background: #f4f7fb;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: none;
            padding: 14px 16px;
        }

        #downloadTable tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s;
        }

        #downloadTable tbody tr:hover {
            background: #f0fdf4;
        }

        #downloadTable tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border: none;
            font-size: 0.9rem;
        }

        .file-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.92rem;
        }

        .file-path {
            color: #94a3b8;
            font-size: 0.78rem;
            margin-top: 2px;
        }

        .file-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .file-icon-pdf {
            background: #fff1f2;
            color: #e11d48;
        }

        .file-icon-doc {
            background: #eff6ff;
            color: #2563eb;
        }

        .file-icon-xls {
            background: #f0fdf4;
            color: #16a34a;
        }

        .file-icon-ppt {
            background: #fff7ed;
            color: #ea580c;
        }

        .file-icon-zip {
            background: #faf5ff;
            color: #9333ea;
        }

        .file-icon-default {
            background: #f1f5f9;
            color: #64748b;
        }

        .hits-badge {
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
            color: #0369a1;
            font-weight: 700;
            font-size: 0.78rem;
            padding: 5px 12px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

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

        .btn-download-action {
            background: #e0f2fe;
            color: #0284c7;
        }

        .btn-download-action:hover {
            background: #bae6fd;
            color: #0369a1;
        }

        .btn-delete-action {
            background: #fff1f2;
            color: #e11d48;
        }

        .btn-delete-action:hover {
            background: #fecdd3;
            color: #9f1239;
        }

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

        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state-icon {
            width: 72px;
            height: 72px;
            background: #f0fdf4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .empty-state-icon i {
            font-size: 1.8rem;
            color: #86efac;
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

    <div class="page-header-download d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div style="position:relative;z-index:1;">
            <h4><i class="fas fa-download me-2"></i>Daftar Unduhan</h4>
            <p>Kelola file yang dapat diunduh oleh pengguna website Anda.</p>
        </div>
        <a href="{{ route('unduhan.create') }}" class="btn-add-download" style="position:relative;z-index:1;">
            <i class="fas fa-plus"></i> Tambah File Unduhan
        </a>
    </div>

    <div class="download-card card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="downloadTable" class="table">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama File</th>
                            <th width="100" class="text-center">Hits</th>
                            <th>Tanggal Dibuat</th>
                            <th width="140" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($downloads as $download)
                            @php
                                $ext = strtolower(pathinfo($download->file, PATHINFO_EXTENSION));
                                $iconMap = [
                                    'pdf' => ['fas fa-file-pdf', 'file-icon-pdf'],
                                    'doc' => ['fas fa-file-word', 'file-icon-doc'],
                                    'docx' => ['fas fa-file-word', 'file-icon-doc'],
                                    'xls' => ['fas fa-file-excel', 'file-icon-xls'],
                                    'xlsx' => ['fas fa-file-excel', 'file-icon-xls'],
                                    'ppt' => ['fas fa-file-powerpoint', 'file-icon-ppt'],
                                    'pptx' => ['fas fa-file-powerpoint', 'file-icon-ppt'],
                                    'zip' => ['fas fa-file-archive', 'file-icon-zip'],
                                    'rar' => ['fas fa-file-archive', 'file-icon-zip'],
                                ];
                                $icon = $iconMap[$ext] ?? ['fas fa-file', 'file-icon-default'];
                            @endphp
                            <tr>
                                <td><span class="row-number"></span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="file-icon {{ $icon[1] }}">
                                            <i class="{{ $icon[0] }}"></i>
                                        </div>
                                        <div>
                                            <div class="file-name">{{ $download->name }}</div>
                                            <div class="file-path">{{ $download->file }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="hits-badge">
                                        <i class="fas fa-eye" style="font-size:0.7rem;"></i>
                                        {{ $download->hits ?? 0 }}
                                    </span>
                                </td>
                                <td>
                                    <span class="date-badge">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $download->created_at->format('d M Y, H:i') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('unduhan.edit', $download) }}" class="btn-action btn-edit-action me-1"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{ route('download.file', $download) }}"
                                        class="btn-action btn-download-action me-1" title="Download" target="_blank">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form action="{{ route('unduhan.destroy', $download) }}" method="POST"
                                        class="d-inline form-delete-download">
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
                                            <i class="fas fa-download"></i>
                                        </div>
                                        <p class="fw-semibold text-secondary mb-1">Belum ada file unduhan</p>
                                        <small class="text-muted">Tambahkan file unduhan pertama Anda dengan klik tombol di
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
            const table = new DataTable('#downloadTable', {
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

            document.querySelectorAll('.form-delete-download').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus file unduhan ini?',
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
