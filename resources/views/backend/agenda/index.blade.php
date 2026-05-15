@extends('backend.layouts.app')
@section('title', 'Agenda')

@section('content')
<div class="row">
    <div class="col-12">
        {{-- Alert --}}
        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session("success") }}',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
        @endif

        {{-- Statistik Cards --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar bg-light-primary rounded-3 p-3">
                                    <i class="ti ti-calendar-event text-primary fs-3"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-muted mb-1 small">Total Agenda</p>
                                <h4 class="mb-0 fw-bold">{{ $agendas->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar bg-light-success rounded-3 p-3">
                                    <i class="ti ti-calendar-check text-success fs-3"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-muted mb-1 small">Agenda Mendatang</p>
                                <h4 class="mb-0 fw-bold">{{ $agendas->where('tanggal', '>=', now()->toDateString())->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar bg-light-warning rounded-3 p-3">
                                    <i class="ti ti-calendar-off text-warning fs-3"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-muted mb-1 small">Agenda Selesai</p>
                                <h4 class="mb-0 fw-bold">{{ $agendas->where('tanggal', '<', now()->toDateString())->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Utama --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div>
                        <h5 class="mb-1 fw-bold"><i class="ti ti-calendar-event me-2"></i>Daftar Agenda</h5>
                        <p class="text-muted mb-0 small">Kelola semua agenda kegiatan Anda</p>
                    </div>
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Tambah Agenda
                    </a>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="table-responsive">
                    <table id="agenda-table" class="table table-hover align-middle" style="width:100%">
                        <thead>
                            <tr class="bg-light">
                                <th width="5%" class="text-center">No</th>
                                <th>Agenda</th>
                                <th width="15%" class="text-center">Tanggal</th>
                                <th width="12%" class="text-center">Status</th>
                                <th width="12%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agendas as $key => $agenda)
                            <tr>
                                <td class="text-center fw-semibold">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="avtar bg-light-primary rounded-2 flex-shrink-0 d-none d-md-flex"
                                             style="width:45px; height:45px;">
                                            <i class="ti ti-calendar text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1 fw-semibold">{{ $agenda->title }}</h6>
                                            <p class="text-muted mb-0 small">
                                                {{ Str::limit(strip_tags($agenda->keterangan), 100) ?: '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div>
                                        <span class="d-block fw-semibold">
                                            {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d M Y') }}
                                        </span>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($agenda->tanggal)->diffForHumans() }}
                                        </small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if(\Carbon\Carbon::parse($agenda->tanggal)->isToday())
                                        <span class="badge bg-primary rounded-pill px-3 py-2">Hari Ini</span>
                                    @elseif(\Carbon\Carbon::parse($agenda->tanggal)->isFuture())
                                        <span class="badge bg-success rounded-pill px-3 py-2">Mendatang</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-3 py-2">Selesai</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('agenda.edit', $agenda) }}"
                                           class="btn btn-icon btn-outline-warning btn-sm rounded-2"
                                           data-bs-toggle="tooltip" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <button class="btn btn-icon btn-outline-danger btn-sm rounded-2 btn-delete"
                                            data-url="{{ route('agenda.destroy', $agenda) }}"
                                            data-name="{{ $agenda->title }}"
                                            data-bs-toggle="tooltip" title="Hapus">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ti ti-calendar-off text-muted mb-3" style="font-size: 3rem;"></i>
                                        <h6 class="text-muted">Belum ada data agenda</h6>
                                        <p class="text-muted small">Silakan tambahkan agenda baru untuk memulai</p>
                                        <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm mt-2">
                                            <i class="ti ti-plus me-1"></i> Tambah Agenda
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
    </div>
</div>

{{-- Form hidden delete --}}
<form id="delete-form" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('styles')
<style>
    #agenda-table tbody tr {
        transition: all 0.2s ease;
    }
    #agenda-table tbody tr:hover {
        background-color: rgba(var(--bs-primary-rgb), 0.04);
    }
    .avtar {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .bg-light-primary { background-color: rgba(var(--bs-primary-rgb), 0.1); }
    .bg-light-success { background-color: rgba(25, 135, 84, 0.1); }
    .bg-light-warning { background-color: rgba(255, 193, 7, 0.1); }
    .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#agenda-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
            },
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: [0, 4] }
            ]
        });

        // Tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(el) { return new bootstrap.Tooltip(el); });

        // SweetAlert delete
        $(document).on('click', '.btn-delete', function() {
            const url  = $(this).data('url');
            const name = $(this).data('name');

            Swal.fire({
                title: 'Hapus Agenda?',
                html: `Agenda <strong>"${name}"</strong> akan dihapus secara permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="ti ti-trash"></i> Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form');
                    form.action = url;
                    form.submit();
                }
            });
        });
    });
</script>
@endpush