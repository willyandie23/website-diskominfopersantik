@extends('backend.layouts.app')
@section('title', 'Edit Agenda')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('agenda.index') }}" class="btn btn-icon btn-outline-secondary rounded-2">
                        <i class="ti ti-arrow-left"></i>
                    </a>
                    <div>
                        <h5 class="mb-0 fw-bold">Edit Agenda</h5>
                        <p class="text-muted mb-0 small">Perbarui informasi agenda kegiatan di bawah ini</p>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('agenda.update', $agenda) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">
                            Judul Agenda <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="ti ti-calendar-event text-muted"></i>
                            </span>
                            <input type="text" name="title" id="title"
                                class="form-control border-start-0 @error('title') is-invalid @enderror"
                                value="{{ old('title', $agenda->title) }}"
                                placeholder="Contoh: Rapat Koordinasi Bulanan" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-4">
                        <label for="tanggal" class="form-label fw-semibold">
                            Tanggal Pelaksanaan <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="ti ti-calendar text-muted"></i>
                            </span>
                            <input type="date" name="tanggal" id="tanggal"
                                class="form-control border-start-0 @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', $agenda->tanggal) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Keterangan CKEditor --}}
                    <div class="mb-4">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan / Deskripsi</label>
                        <textarea name="keterangan" id="keterangan"
                            class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $agenda->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted mt-1 d-block">
                            <i class="ti ti-info-circle me-1"></i>Gunakan editor di atas untuk memformat teks, menambah gambar, dll.
                        </small>
                    </div>

                    <hr class="my-4">

                    {{-- Info terakhir diupdate --}}
                    <div class="alert alert-light border d-flex align-items-center gap-2 mb-4">
                        <i class="ti ti-clock text-muted"></i>
                        <small class="text-muted">
                            Terakhir diperbarui: {{ $agenda->updated_at->translatedFormat('d F Y, H:i') }} WIB
                        </small>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('agenda.index') }}" class="btn btn-light">
                            <i class="ti ti-x me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="ti ti-device-floppy me-1"></i> Perbarui Agenda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Sidebar Info --}}
    <div class="col-lg-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="ti ti-info-circle text-primary me-2"></i>Info Agenda</h6>
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Dibuat pada</small>
                    <span class="fw-semibold small">{{ $agenda->created_at->translatedFormat('d F Y, H:i') }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Status</small>
                    @if(\Carbon\Carbon::parse($agenda->tanggal)->isToday())
                        <span class="badge bg-primary rounded-pill px-3 py-2">Hari Ini</span>
                    @elseif(\Carbon\Carbon::parse($agenda->tanggal)->isFuture())
                        <span class="badge bg-success rounded-pill px-3 py-2">Mendatang</span>
                    @else
                        <span class="badge bg-secondary rounded-pill px-3 py-2">Selesai</span>
                    @endif
                </div>
                <hr>
                <button class="btn btn-outline-danger btn-sm w-100 btn-delete-edit"
                    data-url="{{ route('agenda.destroy', $agenda) }}"
                    data-name="{{ $agenda->title }}">
                    <i class="ti ti-trash me-1"></i> Hapus Agenda Ini
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="ti ti-bulb text-warning me-2"></i>Tips Pengisian</h6>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-start mb-3">
                        <i class="ti ti-circle-check text-success me-2 mt-1 flex-shrink-0"></i>
                        <small class="text-muted">Tulis judul yang singkat dan jelas agar mudah dipahami.</small>
                    </li>
                    <li class="d-flex align-items-start mb-3">
                        <i class="ti ti-circle-check text-success me-2 mt-1 flex-shrink-0"></i>
                        <small class="text-muted">Pastikan tanggal sesuai dengan pelaksanaan kegiatan.</small>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="ti ti-circle-check text-success me-2 mt-1 flex-shrink-0"></i>
                        <small class="text-muted">Gunakan keterangan untuk detail seperti lokasi, waktu, dan peserta.</small>
                    </li>
                </ul>
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
    .btn-icon {
        width: 38px;
        height: 38px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .ck-editor__editable {
        min-height: 300px !important;
        border-radius: 0 0 8px 8px !important;
    }
    .ck.ck-toolbar {
        border-radius: 8px 8px 0 0 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#keterangan'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', 'strikethrough', '|',
                'bulletedList', 'numberedList', 'blockQuote', '|',
                'link', 'insertTable', '|',
                'undo', 'redo'
            ],
            placeholder: 'Tuliskan detail agenda kegiatan di sini...'
        })
        .catch(error => {
            console.error(error);
        });

    // Delete dari halaman edit
    document.querySelector('.btn-delete-edit')?.addEventListener('click', function() {
        const url  = this.dataset.url;
        const name = this.dataset.name;

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
</script>
@endpush