@extends('backend.layouts.app')

@section('title', 'Admin - Daftar FAQ')

@push('styles')
    <style>
        .page-header-faq {
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5f9e 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(30, 58, 95, 0.25);
        }

        .page-header-faq::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 240px;
            height: 240px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .header-icon-wrap {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #fff;
        }

        .faq-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        #faqTable thead th {
            background: #f8fafc;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .faq-title {
            font-weight: 600;
            color: #1e293b;
        }
    </style>
@endpush

@section('content')
    <div class="page-header-faq d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="header-icon-wrap">
                <i class="fas fa-question-circle"></i>
            </div>
            <div>
                <h4 class="mb-0 text-white">Daftar FAQ</h4>
                <p class="text-white-50 mb-0">Kelola pertanyaan yang sering ditanyakan pengunjung website</p>
            </div>
        </div>
        <a href="{{ route('katalog-faq.create') }}" class="btn btn-light btn-lg">
            <i class="fas fa-plus"></i> Tambah FAQ Baru
        </a>
    </div>

    <div class="faq-card card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="faqTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th width="auto">No</th>
                            <th width="auto">Judul</th>
                            <th width="auto">Deskripsi</th>
                            <th width="auto" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($faqs as $faq)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="faq-title">{{ $faq->title }}</td>
                                <td>{{ Str::limit(strip_tags($faq->deskripsi), 100) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('katalog-faq.edit', $faq) }}"
                                        class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('katalog-faq.destroy', $faq) }}" method="POST"
                                        class="d-inline form-delete">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                                    <h6>Belum ada FAQ</h6>
                                    <p class="text-muted">Klik tombol di atas untuk menambahkan FAQ pertama</p>
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
            new DataTable('#faqTable', {
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                },
                pageLength: 15,
                responsive: true
            });

            // SweetAlert Delete
            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus FAQ ini?',
                        text: 'Tindakan ini tidak dapat dibatalkan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e11d48',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Ya, Hapus!'
                    }).then(result => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
@endpush
