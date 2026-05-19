@extends('backend.layouts.app')

@section('title', 'Admin - Edit Berita')

@push('styles')
    <style>
        .page-header-news {
            background: linear-gradient(135deg, #713f12 0%, #a16207 60%, #eab308 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(113, 63, 18, 0.22);
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
            border-color: #a16207;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.12);
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

        /* Current image */
        .current-image-wrapper {
            position: relative;
            display: inline-block;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .current-image-wrapper img {
            max-width: 360px;
            max-height: 220px;
            object-fit: cover;
            display: block;
        }

        .current-image-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(113, 63, 18, 0.85);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
        }

        .no-image-box {
            width: 200px;
            height: 130px;
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

        /* Upload zone */
        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            padding: 22px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .upload-zone:hover,
        .upload-zone.dragover {
            border-color: #a16207;
            background: #fefce8;
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
            width: 44px;
            height: 44px;
            background: #fef9c3;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .upload-icon i {
            color: #a16207;
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

        /* Before/After preview */
        .change-arrow {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 16px;
            flex-wrap: wrap;
            margin: 12px 0;
            padding: 16px;
            background: #fffbeb;
            border-radius: 12px;
            border: 1px solid #fde68a;
        }

        .change-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #92400e;
            margin-bottom: 6px;
        }

        .arrow-icon {
            width: 32px;
            height: 32px;
            background: #fef3c7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a16207;
            font-size: 0.9rem;
        }

        /* CKEditor */
        .editor-wrapper {
            border-radius: 12px;
            overflow: hidden;
            border: 1.5px solid #e2e8f0;
            transition: border-color 0.2s;
        }

        .editor-wrapper:focus-within {
            border-color: #a16207;
            box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
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
            border-bottom: 1px solid #f1f5f9 !important;
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
        .btn-update {
            background: linear-gradient(135deg, #713f12, #a16207);
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
            box-shadow: 0 4px 12px rgba(113, 63, 18, 0.25);
        }

        .btn-update:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(113, 63, 18, 0.35);
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
            <h4><i class="fas fa-edit me-2"></i>Edit Berita</h4>
            <p>Perbarui konten berita &ldquo;<strong>{{ Str::limit($beritum->title, 50) }}</strong>&rdquo;</p>
        </div>
        <a href="{{ route('news.index') }}" class="btn-back" style="position:relative;z-index:1;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="form-card card">
                <div class="card-body">
                    <form action="{{ route('berita.update', $beritum) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Informasi --}}
                        <p class="form-section-title"><i class="fas fa-align-left me-1"></i> Informasi Berita</p>

                        <div class="mb-4">
                            <label class="form-label">
                                Judul Berita <span class="required-star">*</span>
                            </label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $beritum->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Gambar Saat Ini --}}
                        <p class="form-section-title"><i class="fas fa-image me-1"></i> Gambar Berita</p>

                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label>
                            @if ($beritum->image)
                                <div>
                                    <div class="current-image-wrapper">
                                        <span class="current-image-badge"><i class="fas fa-check-circle me-1"></i>
                                            Aktif</span>
                                        <img src="{{ $beritum->image_url }}" alt="{{ $beritum->title }}">
                                    </div>
                                </div>
                            @else
                                <div class="no-image-box">
                                    <i class="fas fa-newspaper fa-2x"></i>
                                    <span>Tidak ada gambar</span>
                                </div>
                            @endif
                            <p class="form-hint mt-2"><i class="fas fa-info-circle"></i> Biarkan kosong jika tidak ingin
                                mengganti gambar.</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ganti Gambar <span
                                    class="text-muted fw-normal">(Opsional)</span></label>
                            <div class="upload-zone" id="uploadZoneEdit">
                                <input type="file" name="image" id="image-edit"
                                    class="@error('image') is-invalid @enderror" accept="image/*">
                                <div class="upload-icon">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <p class="upload-title">Klik untuk memilih gambar baru</p>
                                <p class="upload-subtitle">JPG, PNG, WEBP &bull; Maks 5MB</p>
                            </div>
                            @error('image')
                                <div class="text-danger mt-2" style="font-size:0.8rem;"><i
                                        class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Before/After Preview --}}
                        <div class="mb-4 d-none" id="preview-wrapper-news-edit">
                            <div class="change-arrow">
                                <div>
                                    <p class="change-label">Sebelum</p>
                                    @if ($beritum->image)
                                        <img src="{{ $beritum->image_url }}"
                                            style="width:130px;height:80px;object-fit:cover;border-radius:8px;border:2px solid #e2e8f0;">
                                    @else
                                        <div
                                            style="width:130px;height:80px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="arrow-icon"><i class="fas fa-arrow-right"></i></div>
                                <div>
                                    <p class="change-label">Sesudah</p>
                                    <img id="preview-image-news-edit" src="#"
                                        style="width:130px;height:80px;object-fit:cover;border-radius:8px;border:2px solid #fde68a;">
                                </div>
                            </div>
                        </div>

                        {{-- Isi Berita --}}
                        <p class="form-section-title"><i class="fas fa-edit me-1"></i> Isi Berita</p>

                        <div class="mb-4">
                            <label class="form-label">
                                Konten Berita <span class="required-star">*</span>
                            </label>
                            <div class="editor-wrapper">
                                <textarea name="content" id="content" class="@error('content') is-invalid @enderror" rows="12">{{ old('content', $beritum->content) }}</textarea>
                            </div>
                            @error('content')
                                <div class="text-danger mt-2" style="font-size:0.8rem;"><i
                                        class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4" style="border-color:#f1f5f9;">

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn-update">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('news.index') }}" class="btn-cancel">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-12 col-xl-4 mt-4 mt-xl-0">
            {{-- Meta info --}}
            <div class="card border-0 rounded-4 mb-3" style="background:#fffbeb;box-shadow:none;">
                <div class="card-body p-4">
                    <p class="form-section-title mb-3"><i class="fas fa-info-circle me-1"></i> Informasi Berita</p>
                    <div style="font-size:0.83rem;color:#78350f;line-height:2;">
                        <p class="mb-1"><span class="fw-semibold">Dibuat:</span>
                            {{ $beritum->created_at->format('d M Y, H:i') }}</p>
                        <p class="mb-1"><span class="fw-semibold">Diperbarui:</span>
                            {{ $beritum->updated_at->format('d M Y, H:i') }}</p>
                        <p class="mb-0">
                            <span class="fw-semibold">Dibaca:</span>
                            <span style="background:#fef3c7;padding:2px 8px;border-radius:6px;font-weight:700;">
                                {{ number_format($beritum->counter) }}x
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card border-0 rounded-4" style="background:#f8fafc;box-shadow:none;">
                <div class="card-body p-4">
                    <p class="form-section-title mb-3"><i class="fas fa-exclamation-triangle me-1 text-warning"></i>
                        Perhatian</p>
                    <ul class="list-unstyled mb-0" style="font-size:0.83rem;color:#475569;line-height:1.9;">
                        <li><i class="fas fa-info-circle me-2 text-primary"></i>Gambar lama akan <strong>terhapus</strong>
                            saat diganti.</li>
                        <li><i class="fas fa-info-circle me-2 text-primary"></i>Kosongkan field gambar untuk mempertahankan
                            gambar lama.</li>
                        <li><i class="fas fa-check-circle me-2 text-success"></i>Perubahan konten langsung tampil di
                            website.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFile = document.getElementById('image-edit');
            const previewWrapper = document.getElementById('preview-wrapper-news-edit');
            const previewImage = document.getElementById('preview-image-news-edit');
            const uploadZone = document.getElementById('uploadZoneEdit');

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
