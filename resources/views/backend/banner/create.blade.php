@extends('backend.layouts.app')

@section('title', 'Admin - Tambah Banner')

@push('styles')
    <style>
        .page-header-banner {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 60%, #1a8cff 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(30, 58, 95, 0.18);
        }

        .page-header-banner::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .page-header-banner h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 4px;
        }

        .page-header-banner p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.88rem;
            margin: 0;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1.5px solid rgba(255, 255, 255, 0.35);
            border-radius: 10px;
            padding: 8px 16px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
        }

        .form-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .form-card .card-body {
            padding: 32px;
        }

        /* Form Controls */
        .form-section-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.875rem;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            color: #1e293b;
            transition: all 0.2s;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: #2d6a9f;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(45, 106, 159, 0.12);
        }

        .form-control.is-invalid {
            border-color: #e11d48;
            background: #fff1f2;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            color: #e11d48;
        }

        .form-hint {
            font-size: 0.78rem;
            color: #94a3b8;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* File Upload Zone */
        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            padding: 28px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .upload-zone:hover,
        .upload-zone.dragover {
            border-color: #2d6a9f;
            background: #eff6ff;
        }

        .upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
        }

        .upload-zone input[type="file"].is-invalid {
            border: none;
            background: none;
        }

        .upload-icon {
            width: 52px;
            height: 52px;
            background: #dbeafe;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .upload-icon i {
            color: #2d6a9f;
            font-size: 1.4rem;
        }

        .upload-title {
            font-weight: 600;
            color: #374151;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .upload-subtitle {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* Preview */
        .preview-container {
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            position: relative;
            background: #f8fafc;
        }

        .preview-container img {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            display: block;
        }

        .preview-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(30, 58, 95, 0.85);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
        }

        /* Buttons */
        .btn-save {
            background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 11px 24px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(30, 58, 95, 0.25);
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(30, 58, 95, 0.35);
            color: #fff;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #64748b;
            border: none;
            border-radius: 10px;
            padding: 11px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
            color: #475569;
        }

        .required-star {
            color: #e11d48;
        }
    </style>
@endpush

@section('content')

    <div class="page-header-banner d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div style="position:relative;z-index:1;">
            <h4><i class="fas fa-plus-circle me-2"></i>Tambah Banner Baru</h4>
            <p>Lengkapi data di bawah untuk menambahkan banner baru.</p>
        </div>
        <a href="{{ route('banner.index') }}" class="btn-back" style="position:relative;z-index:1;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-9">
            <div class="form-card card">
                <div class="card-body">
                    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data"
                        id="bannerCreateForm">
                        @csrf

                        {{-- Section: Informasi Banner --}}
                        <p class="form-section-title"><i class="fas fa-info-circle me-1"></i> Informasi Banner</p>

                        <div class="mb-4">
                            <label for="name" class="form-label">
                                Nama Banner <span class="required-star">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Contoh: Banner Utama Halaman Depan" required>
                            @error('name')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <p class="form-hint"><i class="fas fa-lightbulb"></i> Gunakan nama deskriptif agar mudah
                                dikenali.</p>
                        </div>

                        {{-- Section: Upload Gambar --}}
                        <p class="form-section-title"><i class="fas fa-image me-1"></i> Gambar Banner</p>

                        <div class="mb-3">
                            <label class="form-label">
                                Pilih Gambar <span class="required-star">*</span>
                            </label>

                            <div class="upload-zone" id="uploadZone">
                                <input type="file" name="file" id="file"
                                    class="@error('file') is-invalid @enderror"
                                    accept="image/jpeg,image/png,image/jpg,image/webp" required>
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="upload-title">Klik atau seret gambar ke sini</p>
                                <p class="upload-subtitle">JPG, PNG, JPEG, WEBP &bull; Maks 5MB &bull; Rasio 16:9 disarankan
                                </p>
                            </div>
                            @error('file')
                                <div class="text-danger mt-2" style="font-size:0.8rem;"><i
                                        class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Preview --}}
                        <div class="mb-4 d-none" id="preview-wrapper">
                            <label class="form-label">Preview Gambar</label>
                            <div class="preview-container">
                                <span class="preview-badge"><i class="fas fa-eye me-1"></i> Preview</span>
                                <img id="preview-image" src="#" alt="Preview Banner">
                            </div>
                        </div>

                        <hr class="my-4" style="border-color:#f1f5f9;">

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Simpan Banner
                            </button>
                            <a href="{{ route('banner.index') }}" class="btn-cancel">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tips Sidebar --}}
        <div class="col-12 col-xl-3 mt-4 mt-xl-0">
            <div class="card border-0 rounded-4" style="background:#f0f7ff;box-shadow:none;">
                <div class="card-body p-4">
                    <p class="form-section-title mb-3"><i class="fas fa-star me-1 text-warning"></i> Tips Upload Banner</p>
                    <ul class="list-unstyled mb-0" style="font-size:0.83rem;color:#475569;line-height:1.9;">
                        <li><i class="fas fa-check-circle text-success me-2"></i>Gunakan rasio <strong>16:9</strong></li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Resolusi minimal
                            <strong>1280×720px</strong>
                        </li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Format JPG/PNG/WEBP</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Ukuran maks <strong>5MB</strong></li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Hindari teks terlalu kecil di gambar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFile = document.getElementById('file');
            const previewWrapper = document.getElementById('preview-wrapper');
            const previewImage = document.getElementById('preview-image');
            const uploadZone = document.getElementById('uploadZone');

            if (inputFile) {
                inputFile.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        previewWrapper.classList.add('d-none');
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        previewWrapper.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                });
            }

            // Drag & drop visual feedback
            if (uploadZone) {
                uploadZone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    uploadZone.classList.add('dragover');
                });
                uploadZone.addEventListener('dragleave', () => {
                    uploadZone.classList.remove('dragover');
                });
                uploadZone.addEventListener('drop', () => {
                    uploadZone.classList.remove('dragover');
                });
            }
        });
    </script>
@endpush
