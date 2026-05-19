@extends('backend.layouts.app')

@section('title', 'Admin - Daftar Bidang')

@push('styles')
    <style>
        :root {
            --primary-green: #10b981;
            --dark-green: #0f4c3a;
        }

        .page-header-bidang {
            background: linear-gradient(135deg, var(--dark-green) 0%, #166534 50%, var(--primary-green) 100%);
            border-radius: 20px;
            padding: 32px 36px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px -10px rgba(16, 185, 129, 0.3);
        }

        .page-header-bidang::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 240px;
            height: 240px;
            background: rgba(255, 255, 255, 0.09);
            border-radius: 50%;
            filter: blur(25px);
        }

        .page-header-bidang h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.55rem;
            margin-bottom: 6px;
        }

        .page-header-bidang p {
            color: rgba(255, 255, 255, 0.85);
            margin: 0;
            font-size: 0.95rem;
        }

        .btn-add-bidang {
            background: #fff;
            color: var(--dark-green);
            font-weight: 600;
            border-radius: 12px;
            padding: 12px 26px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }

        .btn-add-bidang:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            color: var(--dark-green);
        }

        .bidang-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            background: #fff;
        }

        #fieldTable thead th {
            background: #f8fafc;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.76rem;
            letter-spacing: 0.6px;
            padding: 16px 20px;
            border: none;
        }

        #fieldTable tbody tr {
            transition: all 0.25s ease;
            padding: 16px 20px;
        }

        #fieldTable tbody tr:hover {
            background: #f0fdfa;
            transform: scale(1.005);
        }

        #fieldTable tbody td {
            padding: 16px 20px;
            vertical-align: middle;
        }

        .nama-bidang {
            font-weight: 600;
            color: #1e293b;
            font-size: 1rem;
        }

        .btn-action {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .empty-state {
            padding: 80px 20px;
            text-align: center;
        }

        .empty-state-icon {
            width: 90px;
            height: 90px;
            background: #ecfdf5;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: #10b981;
        }
    </style>
@endpush

@section('content')

    <!-- Page Header -->
    <div class="page-header-bidang d-flex justify-content-between align-items-center flex-wrap gap-4">
        <div style="position: relative; z-index: 1;">
            <h4><i class="fas fa-sitemap me-3"></i>Daftar Bidang</h4>
            <p>Struktur bidang / bagian di lingkungan kantor Anda.</p>
        </div>
        <a href="{{ route('bidang.create') }}" class="btn-add-bidang">
            <i class="fas fa-plus"></i> Tambah Bidang Baru
        </a>
    </div>

    <div class="bidang-card card">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="fieldTable" class="table mb-0">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Bidang</th>
                            <th>Deskripsi Bidang</th>
                            <th width="140" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fields as $field)
                            <tr>
                                <td class="text-center fw-bold text-emerald-700">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="nama-bidang">{{ $field->nama_bidang }}</span>
                                </td>
                                <td>
                                    <span class="text-slate-600">
                                        {{ Str::limit(strip_tags($field->deskripsi_bidang ?? '-'), 140, '...') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('bidang.edit', $field) }}" class="btn-action btn-warning me-2"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('bidang.destroy', $field) }}" method="POST"
                                        class="d-inline form-delete-bidang">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-danger" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-sitemap"></i>
                                        </div>
                                        <h6 class="text-secondary">Belum ada data bidang</h6>
                                        <p class="text-muted mb-0">Klik tombol "Tambah Bidang Baru" untuk memulai.</p>
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
            new DataTable('#fieldTable', {
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                },
                pageLength: 15,
                lengthMenu: [10, 15, 25, 50, 100],
                // order: [[1, 'asc']],
                responsive: true,
                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        render: (data, type, row, meta) => meta.row + 1
                    },
                    {
                        targets: 3,
                        orderable: false
                    }
                ]
            });

            // SweetAlert Konfirmasi Hapus
            document.querySelectorAll('.form-delete-bidang').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin hapus bidang ini?',
                        text: 'Aksi ini tidak bisa dibatalkan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e11d48',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: '<i class="fas fa-trash-alt"></i> Ya, Hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
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
