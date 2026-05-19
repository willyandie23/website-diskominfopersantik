@extends('backend.layouts.app')

@section('title', 'Admin - Tambah Berita')

@push('styles')
    <style>
        .page-header-news {
            background: linear-gradient(135deg, #0f4c2a 0%, #1a7a47 60%, #22c55e 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(15, 76, 42, 0.2);
        }

        .page-header-news::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .page-header-news h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 4px;
        }

        .page-header-news p {
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
            border-color: #1a7a47;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(26, 122, 71, 0.12);
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

        .required-star {
            color: #e11d48;
        }

        /* Upload zone */
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
            border-color: #1a7a47;
            background: #f0fdf4;
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

        .upload-icon {
            width: 48px;
            height: 48px;
            background: #dcfce7;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .upload-icon i {
            color: #1a7a47;
            font-size: 1.3rem;
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

        /* Preview */
        .preview-container {
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #bbf7d0;
            position: relative;
            background: #f0fdf4;
        }

        .preview-container img {
            width: 100%;
            max-height: 100%;
            object-fit: cover;
            display: block;
        }

        .preview-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(15, 76, 42, 0.85);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
        }

        /* CKEditor wrapper */
        .editor-wrapper {
            border-radius: 12px;
            overflow: hidden;
            border: 1.5px solid #e2e8f0;
            transition: border-color 0.2s;
        }

        .editor-wrapper:focus-within {
            border-color: #1a7a47;
            box-shadow: 0 0 0 3px rgba(26, 122, 71, 0.1);
        }

        .editor-wrapper .ck-editor__top {
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .editor-wrapper .ck.ck-editor {
            border: none !important;
            border-radius: 0 !important;
        }

        .editor-wrapper .ck.ck-toolbar {
            background: #f8fafc !important;
            border: none !important;
            border-radius: 0 !important;
            padding: 6px 10px !important;
        }

        .editor-wrapper .ck.ck-content {
            border: none !important;
            border-radius: 0 !important;
            min-height: 340px;
            font-size: 0.92rem;
            line-height: 1.7;
            padding: 16px 20px !important;
        }

        /* Buttons */
        .btn-save {
            background: linear-gradient(135deg, #0f4c2a, #1a7a47);
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
            box-shadow: 0 4px 12px rgba(15, 76, 42, 0.25);
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(15, 76, 42, 0.35);
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
    </style>
@endpush

@section('content')

    <div class="page-header-news d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div style="position:relative;z-index:1;">
            <h4><i class="fas fa-plus-circle me-2"></i>Tambah Berita Baru</h4>
            <p>Isi form di bawah untuk mempublikasikan berita baru.</p>
        </div>
        <a href="{{ route('news.index') }}" class="btn-back" style="position:relative;z-index:1;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="form-card card">
                <div class="card-body">
                    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Informasi Utama --}}
                        <p class="form-section-title"><i class="fas fa-align-left me-1"></i> Informasi Berita</p>

                        <div class="mb-4">
                            <label class="form-label">
                                Judul Berita <span class="required-star">*</span>
                            </label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" placeholder="Masukkan judul berita yang menarik..." required>
                            @error('title')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Upload Gambar --}}
                        <p class="form-section-title"><i class="fas fa-image me-1"></i> Gambar Berita</p>

                        <div class="mb-3">
                            <label class="form-label">Pilih Gambar Thumbnail</label>
                            <div class="upload-zone" id="uploadZoneNews">
                                <input type="file" name="image" id="image"
                                    class="@error('image') is-invalid @enderror" accept="image/*">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="upload-title">Klik atau seret gambar ke sini</p>
                                <p class="upload-subtitle">JPG, PNG, WEBP &bull; Maks 5MB &bull; Disarankan 1080×1080px</p>
                            </div>
                            @error('image')
                                <div class="text-danger mt-2" style="font-size:0.8rem;"><i
                                        class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 d-none" id="preview-wrapper-news">
                            <div class="preview-container">
                                <span class="preview-badge"><i class="fas fa-eye me-1"></i> Preview</span>
                                <img id="preview-image-news" src="#" alt="Preview Gambar Berita">
                            </div>
                        </div>

                        {{-- Isi Berita --}}
                        <p class="form-section-title"><i class="fas fa-edit me-1"></i> Isi Berita</p>

                        <div class="mb-4">
                            <label class="form-label">
                                Konten Berita <span class="required-star">*</span>
                            </label>
                            <div class="editor-wrapper">
                                <textarea name="content" id="content" class="@error('content') is-invalid @enderror" rows="12">{{ old('content') }}</textarea>
                            </div>
                            @error('content')
                                <div class="text-danger mt-2" style="font-size:0.8rem;"><i
                                        class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4" style="border-color:#f1f5f9;">

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-paper-plane"></i> Publikasikan Berita
                            </button>
                            <a href="{{ route('news.index') }}" class="btn-cancel">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar Tips --}}
        <div class="col-12 col-xl-4 mt-4 mt-xl-0">
            <div class="card border-0 rounded-4 mb-3" style="background:#f0fdf4;box-shadow:none;">
                <div class="card-body p-4">
                    <p class="form-section-title mb-3"><i class="fas fa-lightbulb me-1 text-warning"></i> Tips Menulis
                        Berita</p>
                    <ul class="list-unstyled mb-0" style="font-size:0.83rem;color:#374151;line-height:2;">
                        <li><i class="fas fa-check-circle text-success me-2"></i>Judul singkat, jelas, dan menarik</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Gunakan gambar berkualitas tinggi</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Awali dengan paragraf paling penting</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Gunakan heading untuk memisahkan bagian
                        </li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Periksa ejaan sebelum mempublikasikan</li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 rounded-4" style="background:#f0f7ff;box-shadow:none;">
                <div class="card-body p-4">
                    <p class="form-section-title mb-3"><i class="fas fa-image me-1"></i> Panduan Gambar</p>
                    <ul class="list-unstyled mb-0" style="font-size:0.83rem;color:#374151;line-height:2;">
                        <li><i class="fas fa-info-circle text-primary me-2"></i>Rasio <strong>1:1</strong> atau
                            <strong>16:9</strong>
                        <li><i class="fas fa-info-circle text-primary me-2"></i>Resolusi min. <strong>1080x1080px</strong>
                            atau <strong>1920x1080px</strong>
                        </li>
                        <li><i class="fas fa-info-circle text-primary me-2"></i>Format: JPG, PNG, WEBP</li>
                        <li><i class="fas fa-info-circle text-primary me-2"></i>Ukuran maks <strong>5MB</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFile = document.getElementById('image');
            const previewWrapper = document.getElementById('preview-wrapper-news');
            const previewImage = document.getElementById('preview-image-news');
            const uploadZone = document.getElementById('uploadZoneNews');

            if (inputFile) {
                inputFile.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        previewWrapper.classList.add('d-none');
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = (event) => {
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
                uploadZone.addEventListener('dragleave', () => uploadZone.classList.remove('dragover'));
                uploadZone.addEventListener('drop', () => uploadZone.classList.remove('dragover'));
            }
        });

        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment',
                        'bulletedList', 'numberedList', 'todoList',
                        'outdent', 'indent', '|',
                        'link', 'blockQuote',
                        'insertTable', 'horizontalLine',
                        'imageUpload', 'mediaEmbed',
                        'code', 'codeBlock',
                        'subscript', 'superscript',
                        'removeFormat', '|',
                        'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                }
            })
            .catch(error => console.error(error));
    </script>
@endpush
