@extends('backend.layouts.app')

@section('title', 'Admin - Edit Banner')

@push('styles')
    <style>
        .page-header-banner {
            background: linear-gradient(135deg, #7c3d12 0%, #c2611f 60%, #f97316 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(124, 61, 18, 0.2);
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
            border-color: #c2611f;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(194, 97, 31, 0.12);
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

        /* Current image display */
        .current-image-wrapper {
            position: relative;
            display: inline-block;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .current-image-wrapper img {
            max-width: 340px;
            max-height: 210px;
            object-fit: cover;
            display: block;
        }

        .current-image-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(124, 61, 18, 0.85);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
        }

        .no-image-box {
            width: 220px;
            height: 140px;
            background: #f1f5f9;
            border-radius: 12px;
            border: 2px dashed #cbd5e1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #94a3b8;
            font-size: 0.85rem;
        }

        /* Upload Zone */
        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .upload-zone:hover,
        .upload-zone.dragover {
            border-color: #c2611f;
            background: #fff7ed;
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
            width: 44px;
            height: 44px;
            background: #ffedd5;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .upload-icon i {
            color: #c2611f;
            font-size: 1.2rem;
        }

        .upload-title {
            font-weight: 600;
            color: #374151;
            font-size: 0.88rem;
            margin-bottom: 3px;
        }

        .upload-subtitle {
            font-size: 0.78rem;
            color: #94a3b8;
        }

        /* New Preview */
        .preview-new-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff7ed;
            color: #c2611f;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 10px;
            border: 1px solid #fed7aa;
        }

        .preview-container-new {
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #fed7aa;
            position: relative;
            background: #fff7ed;
        }

        .preview-container-new img {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            display: block;
        }

        /* Buttons */
        .btn-update {
            background: linear-gradient(135deg, #7c3d12, #c2611f);
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
            box-shadow: 0 4px 12px rgba(124, 61, 18, 0.25);
        }

        .btn-update:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(124, 61, 18, 0.35);
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

        /* Change indicator arrow */
        .change-arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin: 12px 0;
        }

        .arrow-icon {
            width: 32px;
            height: 32px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
        }
    </style>
@endpush

@section('content')

    <div class="page-header-banner d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div style="position:relative;z-index:1;">
            <h4><i class="fas fa-edit me-2"></i>Edit Banner</h4>
            <p>Perbarui data banner &ldquo;<strong>{{ $banner->name }}</strong>&rdquo;</p>
        </div>
        <a href="{{ route('banner.index') }}" class="btn-back" style="position:relative;z-index:1;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-9">
            <div class="form-card card">
                <div class="card-body">
                    <form action="{{ route('banner.update', $banner) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Informasi --}}
                        <p class="form-section-title"><i class="fas fa-info-circle me-1"></i> Informasi Banner</p>

                        <div class="mb-4">
                            <label for="name" class="form-label">
                                Nama Banner <span class="required-star">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $banner->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Gambar Saat Ini --}}
                        <p class="form-section-title"><i class="fas fa-image me-1"></i> Gambar Banner</p>

                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label>
                            @if ($banner->path)
                                <div>
                                    <div class="current-image-wrapper">
                                        <span class="current-image-badge"><i class="fas fa-check-circle me-1"></i>
                                            Aktif</span>
                                        <img src="{{ Storage::url($banner->path) }}" alt="{{ $banner->name }}"
                                            id="current-image">
                                    </div>
                                </div>
                            @else
                                <div class="no-image-box">
                                    <i class="fas fa-image fa-2x"></i>
                                    <span>Tidak ada gambar</span>
                                </div>
                            @endif
                            <p class="form-hint mt-2"><i class="fas fa-info-circle"></i> Biarkan kosong jika tidak ingin
                                mengganti gambar.</p>
                        </div>

                        {{-- Upload Gambar Baru --}}
                        <div class="mb-3">
                            <label class="form-label">Ganti Gambar <span
                                    class="text-muted fw-normal">(Opsional)</span></label>
                            <div class="upload-zone" id="uploadZoneEdit">
                                <input type="file" name="file" id="file"
                                    class="@error('file') is-invalid @enderror"
                                    accept="image/jpeg,image/png,image/jpg,image/webp">
                                <div class="upload-icon">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <p class="upload-title">Klik untuk memilih gambar baru</p>
                                <p class="upload-subtitle">JPG, PNG, JPEG, WEBP &bull; Maks 5MB</p>
                            </div>
                            @error('file')
                                <div class="text-danger mt-2" style="font-size:0.8rem;"><i
                                        class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Preview Gambar Baru --}}
                        <div class="mb-4 d-none" id="preview-wrapper-edit">
                            <div class="change-arrow">
                                <div>
                                    <small class="text-muted d-block mb-1" style="font-size:0.72rem;">SEBELUM</small>
                                    @if ($banner->path)
                                        <img src="{{ Storage::url($banner->path) }}"
                                            style="width:120px;height:75px;object-fit:cover;border-radius:8px;border:2px solid #e2e8f0;">
                                    @else
                                        <div
                                            style="width:120px;height:75px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="arrow-icon"><i class="fas fa-arrow-right"></i></div>
                                <div>
                                    <small class="text-muted d-block mb-1" style="font-size:0.72rem;">SESUDAH</small>
                                    <img id="preview-image-edit" src="#"
                                        style="width:120px;height:75px;object-fit:cover;border-radius:8px;border:2px solid #fed7aa;">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4" style="border-color:#f1f5f9;">

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn-update">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('banner.index') }}" class="btn-cancel">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Info Sidebar --}}
        <div class="col-12 col-xl-3 mt-4 mt-xl-0">
            <div class="card border-0 rounded-4" style="background:#fff7ed;box-shadow:none;">
                <div class="card-body p-4">
                    <p class="form-section-title mb-3"><i class="fas fa-exclamation-triangle me-1 text-warning"></i>
                        Perhatian</p>
                    <ul class="list-unstyled mb-0" style="font-size:0.83rem;color:#78350f;line-height:1.9;">
                        <li><i class="fas fa-info-circle me-2 text-orange"></i>Gambar lama akan <strong>terhapus</strong>
                            saat diganti.</li>
                        <li><i class="fas fa-info-circle me-2"></i>Kosongkan field gambar untuk tetap memakai gambar
                            sekarang.</li>
                        <li><i class="fas fa-check-circle me-2 text-success"></i>Format: JPG, PNG, WEBP</li>
                        <li><i class="fas fa-check-circle me-2 text-success"></i>Ukuran maks <strong>5MB</strong></li>
                        <li><i class="fas fa-check-circle me-2 text-success"></i>Rasio <strong>16:9</strong> disarankan</li>
                    </ul>
                </div>
            </div>

            {{-- Meta info --}}
            <div class="card border-0 rounded-4 mt-3" style="background:#f8fafc;box-shadow:none;">
                <div class="card-body p-4">
                    <p class="form-section-title mb-3"><i class="fas fa-clock me-1"></i> Informasi</p>
                    <div style="font-size:0.82rem;color:#64748b;">
                        <p class="mb-2"><span
                                class="fw-semibold">Dibuat:</span><br>{{ $banner->created_at->format('d M Y, H:i') }}</p>
                        <p class="mb-0"><span class="fw-semibold">Terakhir
                                diperbarui:</span><br>{{ $banner->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFile = document.getElementById('file');
            const previewWrapper = document.getElementById('preview-wrapper-edit');
            const previewImage = document.getElementById('preview-image-edit');
            const uploadZone = document.getElementById('uploadZoneEdit');

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
