@extends('backend.layouts.app')

@section('title', 'Daftar Keluhan - DISKOMINFOPERSANTIK')

@push('css')
    <style>
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-status.secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .badge-status.info {
            background: #eff6ff;
            color: #2563eb;
        }

        .badge-status.primary {
            background: #eef2ff;
            color: #4f46e5;
        }

        .badge-status.warning {
            background: #fffbeb;
            color: #d97706;
        }

        .badge-status.success {
            background: #f0fdf4;
            color: #16a34a;
        }

        .badge-status.danger {
            background: #fef2f2;
            color: #dc2626;
        }

        .table-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .table-action-btn.view {
            background: #eff6ff;
            color: #2563eb;
        }

        .table-action-btn.view:hover {
            background: #2563eb;
            color: #fff;
        }

        .table-action-btn.delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .table-action-btn.delete:hover {
            background: #dc2626;
            color: #fff;
        }

        /* Filter Bar */
        .filter-bar {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 20px;
        }

        .filter-bar .form-select,
        .filter-bar .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13px;
            padding: 7px 12px;
        }

        .filter-bar .form-select:focus,
        .filter-bar .form-control:focus {
            border-color: #4f46e5;
            box-shadow: none;
        }

        /* Stats Card */
        .stat-card {
            border-radius: 12px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid #e2e8f0;
            background: #fff;
        }

        .stat-card .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .stat-card .stat-value {
            font-size: 22px;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
            margin-bottom: 2px;
        }

        .stat-card .stat-label {
            font-size: 12px;
            color: #94a3b8;
            font-weight: 500;
        }
    </style>
@endpush

@section('content')

    {{-- Page Header --}}
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h4 class="mb-1 fw-bold">Daftar Keluhan</h4>
                <p class="text-muted mb-0" style="font-size:13px;">
                    Manajemen tiket keluhan yang masuk dari pengguna
                </p>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3" role="alert">
            <i class="ti ti-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show rounded-3 mb-3" role="alert">
            <i class="ti ti-alert-triangle me-2"></i> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Stats Summary --}}
    <div class="row g-3 mb-4">
        @php
            $totalAll = $cases->count();
            $totalSent = $cases->where('status', 'sent')->count();
            $totalProgress = $cases->where('status', 'in_progress')->count();
            $totalDone = $cases->where('status', 'done')->count();
            $totalReject = $cases->where('status', 'reject')->count();
        @endphp
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#eff6ff;">
                    <i class="ti ti-ticket" style="color:#2563eb;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalAll }}</div>
                    <div class="stat-label">Total Keluhan</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#f1f5f9;">
                    <i class="ti ti-send" style="color:#475569;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalSent }}</div>
                    <div class="stat-label">Belum Diproses</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fffbeb;">
                    <i class="ti ti-loader" style="color:#d97706;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalProgress }}</div>
                    <div class="stat-label">Dalam Proses</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#f0fdf4;">
                    <i class="ti ti-circle-check" style="color:#16a34a;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalDone }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            {{-- Filter Bar --}}
            <div class="filter-bar">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <select id="filterStatus" class="form-select">
                            <option value="">Semua Status</option>
                            @foreach ($statuses as $key => $status)
                                <option value="{{ $status->label }}">{{ $status->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select id="filterCategory" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $key => $cat)
                                <option value="{{ $cat->label }}">{{ $cat->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-secondary btn-sm w-100" id="btnResetFilter">
                            <i class="ti ti-refresh me-1"></i> Reset Filter
                        </button>
                    </div>
                </div>
            </div>

            {{-- DataTable --}}
            <div class="table-responsive">
                <table id="casesTable" class="table table-hover align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Tiket</th>
                            <th>Pelapor</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th style="width:100px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cases as $index => $case)
                            @php
                                $status = $statuses->get($case->status);
                                $badgeCls = $status ? $status->value2 : 'secondary';
                                $label = $status ? $status->label : $case->status;
                                $cat = $categories->get($case->category);
                                $catLabel = $cat ? $cat->label : $case->category;
                            @endphp
                            <tr>
                                <td class="text-muted" style="font-size:13px;">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold" style="font-size:14px; color:#1e293b;">
                                        #{{ $case->id }}
                                    </div>
                                    <div class="text-muted text-truncate" style="font-size:12px; max-width:200px;">
                                        {{ $case->title }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold" style="font-size:13px;">
                                        {{ $case->requester_name }}
                                    </div>
                                    <div class="text-muted" style="font-size:12px;">
                                        {{ $case->unit_name }}
                                    </div>
                                </td>
                                <td>
                                    <span style="font-size:12px; color:#475569;">{{ $catLabel }}</span>
                                </td>
                                <td>
                                    <span class="badge-status {{ $badgeCls }}">
                                        <i class="ti ti-circle-filled" style="font-size:6px;"></i>
                                        {{ $label }}
                                    </span>
                                    {{-- Hidden cell for DataTables filter --}}
                                    <span class="d-none">{{ $label }}</span>
                                </td>
                                <td>
                                    <span style="font-size:12px; color:#64748b;">
                                        {{ \Carbon\Carbon::parse($case->created_at)->translatedFormat('d M Y') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        {{-- View --}}
                                        <a href="{{ route('cases.show', $case->id) }}" class="table-action-btn view"
                                            data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="ti ti-eye" style="font-size:15px;"></i>
                                        </a>
                                        {{-- Delete --}}
                                        <button type="button" class="table-action-btn delete btn-delete"
                                            data-id="{{ $case->id }}" data-title="{{ $case->title }}"
                                            data-bs-toggle="tooltip" title="Hapus">
                                            <i class="ti ti-trash" style="font-size:15px;"></i>
                                        </button>
                                        {{-- Delete Form --}}
                                        <form id="delete-form-{{ $case->id }}"
                                            action="{{ route('cases.destroy', $case->id) }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="ti ti-inbox text-muted" style="font-size:40px;"></i>
                                    <p class="text-muted mt-2 mb-0">Belum ada data keluhan.</p>
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

            // Init DataTable
            const table = $('#casesTable').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data keluhan",
                    zeroRecords: "Data tidak ditemukan"
                },
                columnDefs: [{
                    orderable: false,
                    targets: [6]
                }],
                order: [
                    [0, 'asc']
                ]
            });

            // Filter by Status (kolom ke-4)
            $('#filterStatus').on('change', function() {
                table.column(4).search($(this).val()).draw();
            });

            // Filter by Category (kolom ke-3)
            $('#filterCategory').on('change', function() {
                table.column(3).search($(this).val()).draw();
            });

            // Reset Filter
            $('#btnResetFilter').on('click', function() {
                $('#filterStatus').val('');
                $('#filterCategory').val('');
                table.search('').columns().search('').draw();
            });

            // Tooltip Bootstrap
            const tooltipEls = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipEls.forEach(el => new bootstrap.Tooltip(el));

            // Delete Confirmation dengan SweetAlert2
            $(document).on('click', '.btn-delete', function() {
                const id = $(this).data('id');
                const title = $(this).data('title');

                Swal.fire({
                    title: 'Hapus Keluhan?',
                    html: `Keluhan <strong>#${id} - ${title}</strong> akan dihapus secara permanen dari daftar.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    borderRadius: '12px',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });

        });
    </script>
@endpush
