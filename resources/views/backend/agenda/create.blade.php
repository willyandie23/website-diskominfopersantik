@extends('backend.layouts.app')

@section('title', 'Admin - Tambah Agenda')

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
                            <h5 class="mb-0 fw-bold">Tambah Agenda Baru</h5>
                            <p class="text-muted mb-0 small">Isi informasi agenda kegiatan di bawah ini</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('agenda.store') }}" method="POST">
                        @csrf

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
                                    value="{{ old('title') }}" placeholder="Contoh: Rapat Koordinasi Bulanan" required>
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
                                    value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Keterangan CKEditor --}}
                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan / Deskripsi</label>
                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted mt-1 d-block">
                                <i class="ti ti-info-circle me-1"></i>Gunakan editor di atas untuk memformat teks, menambah
                                gambar, dll.
                            </small>
                        </div>

                        <hr class="my-4">

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('agenda.index') }}" class="btn btn-light">
                                <i class="ti ti-x me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="ti ti-device-floppy me-1"></i> Simpan Agenda
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar Tips --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm">
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
                            <small class="text-muted">Gunakan keterangan untuk detail seperti lokasi, waktu, dan
                                peserta.</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

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
    </script>
@endpush
