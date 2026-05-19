@extends('backend.layouts.app')

@section('title', 'Tambah Katalog Layanan')

@push('styles')
    <style>
        .form-section {
            background: #f8f9fc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e3e6f0;
        }

        .form-section-title {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            color: #4e73df;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .form-section-title i {
            margin-right: 8px;
        }

        .custom-file-upload {
            border: 2px dashed #d1d3e2;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fff;
        }

        .custom-file-upload:hover {
            border-color: #4e73df;
            background: #f8f9ff;
        }

        .custom-file-upload i {
            font-size: 2rem;
            color: #b7b9cc;
            margin-bottom: 10px;
        }

        .custom-file-upload p {
            margin: 0;
            color: #858796;
            font-size: 13px;
        }

        .preview-image {
            max-height: 200px;
            border-radius: 8px;
            margin-top: 10px;
            display: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .input-icon-group {
            position: relative;
        }

        .input-icon-group .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #b7b9cc;
        }

        .input-icon-group input {
            padding-left: 38px;
        }

        .card-header-custom {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: #fff;
            padding: 20px 25px;
            border-radius: 10px 10px 0 0 !important;
        }

        .card-header-custom h5 {
            color: #fff;
            margin: 0;
            font-weight: 600;
        }

        .card-header-custom p {
            color: rgba(255, 255, 255, 0.8);
            margin: 5px 0 0;
            font-size: 13px;
        }

        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .btn-submit {
            padding: 10px 30px;
            font-weight: 600;
            border-radius: 8px;
        }

        /* CKEditor Styling (tambahan agar sesuai tema) */
        .ck-editor__editable {
            min-height: 320px !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="card card-custom">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-plus-circle me-2"></i>Tambah Layanan Baru</h5>
                        <p>Lengkapi formulir berikut untuk menambahkan katalog layanan baru</p>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('katalog-layanan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Section: Informasi Utama --}}
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-info-circle"></i>Informasi Utama
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-semibold">Judul Layanan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title"
                                        class="form-control form-control-lg @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}" placeholder="Masukkan judul layanan...">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-0">
                                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span
                                            class="text-danger">*</span></label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                        placeholder="Tuliskan deskripsi lengkap layanan...">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted mt-1 d-block">Berikan deskripsi yang jelas dan informatif
                                        tentang layanan ini.</small>
                                </div>
                            </div>

                            {{-- Section: Media (tidak diubah) --}}
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-image"></i>Media & Gambar
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-semibold">Upload Gambar</label>
                                    <div class="custom-file-upload" onclick="document.getElementById('image').click()">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <p><strong>Klik untuk upload</strong> atau drag & drop</p>
                                        <p class="mt-1">JPG, PNG, JPEG (Maks. 2MB)</p>
                                    </div>
                                    <input type="file" name="image" id="image"
                                        class="d-none @error('image') is-invalid @enderror" accept="image/*"
                                        onchange="previewFile(this)">
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <img id="imagePreview" class="preview-image" alt="Preview">
                                </div>
                            </div>

                            {{-- Section: Tautan (tidak diubah) --}}
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-link"></i>Tautan / URL
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="url_video" class="form-label fw-semibold">URL Video</label>
                                        <div class="input-icon-group">
                                            <i class="fas fa-video input-icon"></i>
                                            <input type="url" name="url_video" id="url_video"
                                                class="form-control @error('url_video') is-invalid @enderror"
                                                value="{{ old('url_video') }}" placeholder="https://youtube.com/...">
                                        </div>
                                        @error('url_video')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="url_website" class="form-label fw-semibold">URL Website</label>
                                        <div class="input-icon-group">
                                            <i class="fas fa-globe input-icon"></i>
                                            <input type="url" name="url_website" id="url_website"
                                                class="form-control @error('url_website') is-invalid @enderror"
                                                value="{{ old('url_website') }}" placeholder="https://example.com">
                                        </div>
                                        @error('url_website')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <a href="{{ route('katalog-layanan.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="fas fa-save me-1"></i> Simpan Layanan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Preview gambar (tetap)
        function previewFile(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // === CKEditor 5 Initialization ===
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#deskripsi'), {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'underline', '|',
                        'bulletedList', 'numberedList', '|',
                        'alignment', '|',
                        'link', 'blockQuote', 'insertTable', '|',
                        'undo', 'redo'
                    ],
                    language: 'id',
                    height: '320px'
                })
                .catch(error => {
                    console.error('CKEditor error:', error);
                });
        });
    </script>
@endpush
