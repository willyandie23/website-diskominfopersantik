@extends('backend.layouts.app')

@section('title', 'Admin - Tambah Gallery')

@push('styles')

    <style>
        /* ── Page Header ── */
        .page-header-galeri {
            background: linear-gradient(135deg, #1a3c5e 0%, #1e6fa8 55%, #0ea5e9 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(14, 103, 168, 0.22);
        }
        .page-header-galeri::before {
            content: '';
            position: absolute;
            top: -50px; right: -50px;
            width: 220px; height: 220px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
        }
        .page-header-galeri::after {
            content: '';
            position: absolute;
            bottom: -70px; right: 100px;
            width: 160px; height: 160px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }
        .page-header-galeri .header-icon-wrap {
            width: 52px; height: 52px;
            background: rgba(255,255,255,0.15);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: #fff;
            flex-shrink: 0;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .page-header-galeri h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 3px;
        }
        .page-header-galeri p {
            color: rgba(255,255,255,0.72);
            font-size: 0.87rem;
            margin: 0;
        }
        .btn-back {
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-weight: 600;
            font-size: 0.84rem;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 10px;
            padding: 9px 18px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            backdrop-filter: blur(4px);
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
            position: relative; z-index: 1;
        }
        .btn-back:hover {
            background: rgba(255,255,255,0.25);
            color: #fff;
            transform: translateY(-1px);
        }

        /* ── Card ── */
        .galeri-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 24px rgba(0,0,0,0.07);
            overflow: visible;
        }
        .galeri-card .card-body {
            padding: 28px 32px;
        }

        /* ── Section divider ── */
        .form-section-title {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e8edf5;
        }

        /* ── Form inputs ── */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }
        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.9rem;
            padding: 10px 14px;
            color: #1e293b;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: #1e6fa8;
            box-shadow: 0 0 0 3px rgba(30, 111, 168, 0.1);
            outline: none;
        }
        .form-control.is-invalid {
            border-color: #e11d48;
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.08);
        }
        .invalid-feedback { font-size: 0.8rem; }

        /* ── Upload zone ── */
        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 32px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            background: #f8fafc;
            position: relative;
        }
        .upload-zone:hover,
        .upload-zone.dragover {
            border-color: #1e6fa8;
            background: #f0f7ff;
        }
        .upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }
        .upload-zone .upload-icon {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px;
        }
        .upload-zone .upload-icon i {
            font-size: 1.5rem;
            color: #2563eb;
        }
        .upload-zone h6 {
            font-weight: 700;
            color: #1e293b;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }
        .upload-zone p {
            color: #94a3b8;
            font-size: 0.8rem;
            margin: 0;
        }
        .upload-zone .upload-browse {
            color: #1e6fa8;
            font-weight: 600;
            text-decoration: underline;
        }
        .upload-zone.is-invalid-zone {
            border-color: #e11d48;
            background: #fff5f7;
        }

        /* ── Preview ── */
        .preview-section {
            margin-top: 16px;
            display: none;
        }
        .preview-section.visible { display: block; }
        .preview-box {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .preview-img {
            width: 120px; height: 80px;
            object-fit: cover;
            border-radius: 9px;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            flex-shrink: 0;
        }
        .preview-info .preview-filename {
            font-size: 0.85rem;
            font-weight: 600;
            color: #1e293b;
            word-break: break-all;
        }
        .preview-info .preview-size {
            font-size: 0.78rem;
            color: #94a3b8;
            margin-top: 3px;
        }
        .preview-info .preview-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #dcfce7;
            color: #16a34a;
            font-size: 0.72rem;
            font-weight: 600;
            border-radius: 6px;
            padding: 3px 8px;
            margin-top: 6px;
        }
        .btn-remove-preview {
            margin-left: auto;
            width: 32px; height: 32px;
            border-radius: 8px;
            background: #fff1f2;
            color: #e11d48;
            border: none;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.82rem;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .btn-remove-preview:hover { background: #fecdd3; }

        /* ── Tips card ── */
        .tips-card {
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, #f0f7ff 0%, #f8fafc 100%);
            border: 1.5px solid #dbeafe;
            box-shadow: none;
            height: 100%;
        }
        .tips-card .card-body { padding: 24px; }
        .tips-card-title {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #1e6fa8;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .tips-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 14px;
        }
        .tips-item:last-child { margin-bottom: 0; }
        .tips-item-icon {
            width: 30px; height: 30px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.82rem;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .tips-item-icon.blue { background: #dbeafe; color: #2563eb; }
        .tips-item-icon.green { background: #dcfce7; color: #16a34a; }
        .tips-item-icon.amber { background: #fef9c3; color: #ca8a04; }
        .tips-item-icon.purple { background: #ede9fe; color: #7c3aed; }
        .tips-item-text strong {
            font-size: 0.82rem;
            font-weight: 700;
            color: #1e293b;
            display: block;
            margin-bottom: 2px;
        }
        .tips-item-text span {
            font-size: 0.78rem;
            color: #64748b;
            line-height: 1.45;
        }

        /* ── Action buttons ── */
        .btn-submit-galeri {
            background: linear-gradient(135deg, #1e6fa8, #0ea5e9);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 11px 26px;
            font-size: 0.88rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.3);
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-submit-galeri:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.38);
            color: #fff;
        }
        .btn-cancel-galeri {
            background: #f1f5f9;
            color: #64748b;
            border: none;
            border-radius: 10px;
            padding: 11px 22px;
            font-size: 0.88rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-cancel-galeri:hover {
            background: #e2e8f0;
            color: #475569;
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

    {{-- Page Header --}}
    <div class="page-header-galeri d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3" style="position:relative;z-index:1;">
            <div class="header-icon-wrap">
                <i class="fas fa-plus-circle"></i>
            </div>
            <div>
                <h4 class="mb-0">Tambah Gallery Baru</h4>
                <p>Tambahkan gambar baru untuk ditampilkan pada halaman galeri.</p>
            </div>
        </div>
        <a href="{{ route('gallery.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    {{-- Content --}}
    <div class="row g-4">
        {{-- Form --}}
        <div class="col-12 col-xl-8">
            <div class="galeri-card card">
                <div class="card-body">
                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" id="formCreateGaleri">
                        @csrf

                        {{-- Nama --}}
                        <p class="form-section-title"><i class="fas fa-tag me-1"></i> Informasi Gallery</p>
                        <div class="mb-4">
                            <label for="name" class="form-label">
                                Nama Gallery <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="Contoh: Kegiatan Panen Raya 2024"
                                autocomplete="off"
                                required>
                            @error('name')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload --}}
                        <p class="form-section-title"><i class="fas fa-image me-1"></i> Upload Gambar</p>
                        <div class="mb-2">
                            <label class="form-label">
                                Pilih Gambar <span class="text-danger">*</span>
                            </label>
                            <div class="upload-zone @error('file') is-invalid-zone @enderror" id="uploadZone">
                                <input type="file"
                                    name="file"
                                    id="file"
                                    accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp"
                                    required>
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <h6>Klik atau seret gambar ke sini</h6>
                                <p>
                                    <span class="upload-browse">Browse file</span> atau drag & drop
                                </p>
                                <p class="mt-1">JPG, PNG, WEBP, GIF, SVG &mdash; Maks. 2MB</p>
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Preview --}}
                        <div class="preview-section" id="previewSection">
                            <div class="preview-box">
                                <img id="previewImage" src="#" alt="Preview" class="preview-img">
                                <div class="preview-info">
                                    <div class="preview-filename" id="previewFilename">—</div>
                                    <div class="preview-size" id="previewSize">—</div>
                                    <div class="preview-badge">
                                        <i class="fas fa-check-circle"></i> Siap diupload
                                    </div>
                                </div>
                                <button type="button" class="btn-remove-preview" id="btnRemovePreview" title="Hapus pilihan">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Action buttons --}}
                        <div class="d-flex align-items-center gap-3 mt-4 pt-3" style="border-top: 1px solid #f1f5f9;">
                            <button type="submit" class="btn-submit-galeri">
                                <i class="fas fa-save"></i> Simpan Gallery
                            </button>
                            <a href="{{ route('gallery.index') }}" class="btn-cancel-galeri">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tips --}}
        <div class="col-12 col-xl-4">
            <div class="tips-card card">
                <div class="card-body">
                    <div class="tips-card-title">
                        <i class="fas fa-lightbulb"></i> Tips Upload Gambar
                    </div>
                    <div class="tips-item">
                        <div class="tips-item-icon blue"><i class="fas fa-file-image"></i></div>
                        <div class="tips-item-text">
                            <strong>Format yang Didukung</strong>
                            <span>Gunakan format JPG, PNG, WEBP, atau GIF untuk hasil terbaik di semua browser.</span>
                        </div>
                    </div>
                    <div class="tips-item">
                        <div class="tips-item-icon green"><i class="fas fa-expand-arrows-alt"></i></div>
                        <div class="tips-item-text">
                            <strong>Ukuran Gambar Ideal</strong>
                            <span>Gunakan resolusi minimal 800×600px agar gambar tampil tajam di galeri.</span>
                        </div>
                    </div>
                    <div class="tips-item">
                        <div class="tips-item-icon amber"><i class="fas fa-weight-hanging"></i></div>
                        <div class="tips-item-text">
                            <strong>Batas Ukuran File</strong>
                            <span>Maksimum file yang dapat diupload adalah <strong>2MB</strong>. Kompres gambar jika terlalu besar.</span>
                        </div>
                    </div>
                    <div class="tips-item">
                        <div class="tips-item-icon purple"><i class="fas fa-tag"></i></div>
                        <div class="tips-item-text">
                            <strong>Nama Deskriptif</strong>
                            <span>Berikan nama yang jelas dan deskriptif agar mudah ditemukan di daftar gallery.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFile       = document.getElementById('file');
            const uploadZone      = document.getElementById('uploadZone');
            const previewSection  = document.getElementById('previewSection');
            const previewImage    = document.getElementById('previewImage');
            const previewFilename = document.getElementById('previewFilename');
            const previewSize     = document.getElementById('previewSize');
            const btnRemove       = document.getElementById('btnRemovePreview');

            function formatBytes(bytes) {
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / 1048576).toFixed(2) + ' MB';
            }

            function showPreview(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src    = e.target.result;
                    previewFilename.textContent = file.name;
                    previewSize.textContent     = formatBytes(file.size);
                    previewSection.classList.add('visible');
                };
                reader.readAsDataURL(file);
            }

            function resetPreview() {
                previewSection.classList.remove('visible');
                previewImage.src = '#';
                inputFile.value  = '';
            }

            inputFile.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    showPreview(this.files[0]);
                } else {
                    resetPreview();
                }
            });

            btnRemove.addEventListener('click', resetPreview);

            // Drag & drop visual feedback
            uploadZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });
            uploadZone.addEventListener('dragleave', function() {
                this.classList.remove('dragover');
            });
            uploadZone.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                if (e.dataTransfer.files.length) {
                    inputFile.files = e.dataTransfer.files;
                    showPreview(e.dataTransfer.files[0]);
                }
            });
        });
    </script>
@endpush