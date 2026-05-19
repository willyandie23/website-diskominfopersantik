@extends('backend.layouts.app')

@section('title', 'Admin - Tambah Unduhan')

@push('styles')
    <style>
        .page-header-download {
            background: linear-gradient(135deg, #0f4c3a 0%, #1a7a5a 60%, #22c55e 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(15, 76, 58, 0.18);
        }

        .page-header-download::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .page-header-download::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: 80px;
            width: 140px;
            height: 140px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .page-header-download h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.35rem;
            margin-bottom: 4px;
        }

        .page-header-download p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.88rem;
            margin: 0;
        }

        .btn-back-download {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-weight: 600;
            font-size: 0.85rem;
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 9px 18px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-back-download:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
            transform: translateY(-1px);
        }

        .download-form-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .download-form-card .card-body {
            padding: 28px 32px;
        }

        .form-label-custom {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.88rem;
            margin-bottom: 6px;
        }

        .form-label-custom .required {
            color: #e11d48;
            margin-left: 2px;
        }

        .form-control-custom {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control-custom:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.12);
        }

        .form-control-custom.is-invalid {
            border-color: #e11d48;
        }

        .form-control-custom.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.12);
        }

        /* Upload zone */
        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 32px 20px;
            text-align: center;
            transition: all 0.25s;
            cursor: pointer;
            background: #fafbfc;
        }

        .upload-zone:hover,
        .upload-zone.dragover {
            border-color: #22c55e;
            background: #f0fdf4;
        }

        .upload-zone-icon {
            width: 56px;
            height: 56px;
            background: #dcfce7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .upload-zone-icon i {
            font-size: 1.4rem;
            color: #16a34a;
        }

        .upload-zone-title {
            font-weight: 600;
            color: #334155;
            font-size: 0.92rem;
            margin-bottom: 4px;
        }

        .upload-zone-sub {
            color: #94a3b8;
            font-size: 0.8rem;
        }

        .file-selected-info {
            display: none;
            align-items: center;
            gap: 12px;
            background: #f0fdf4;
            border: 1.5px solid #bbf7d0;
            border-radius: 10px;
            padding: 12px 16px;
            margin-top: 12px;
        }

        .file-selected-info.show {
            display: flex;
        }

        .file-selected-info .file-icon-sm {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: #dcfce7;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #16a34a;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .file-selected-info .file-details {
            flex: 1;
            min-width: 0;
        }

        .file-selected-info .file-details .fname {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-selected-info .file-details .fsize {
            color: #64748b;
            font-size: 0.75rem;
        }

        .file-selected-info .btn-remove-file {
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 1rem;
            cursor: pointer;
            transition: color 0.2s;
            padding: 4px;
        }

        .file-selected-info .btn-remove-file:hover {
            color: #e11d48;
        }

        /* Buttons */
        .btn-submit-download {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            color: #fff;
            font-weight: 600;
            font-size: 0.88rem;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-submit-download:hover {
            background: linear-gradient(135deg, #15803d, #16a34a);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(22, 163, 74, 0.3);
        }

        .btn-cancel-download {
            background: #f1f5f9;
            color: #64748b;
            font-weight: 600;
            font-size: 0.88rem;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-cancel-download:hover {
            background: #e2e8f0;
            color: #475569;
        }

        /* Tips sidebar */
        .tips-card {
            border: none;
            border-radius: 16px;
            background: #f0fdf4;
            border: 1.5px solid #bbf7d0;
        }

        .tips-card .tips-title {
            font-weight: 700;
            color: #15803d;
            font-size: 0.9rem;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tips-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tips-card ul li {
            color: #475569;
            font-size: 0.82rem;
            padding: 6px 0;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .tips-card ul li i {
            color: #22c55e;
            font-size: 0.7rem;
            margin-top: 4px;
            flex-shrink: 0;
        }
    </style>
@endpush

@section('content')

    <div class="page-header-download d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div style="position:relative;z-index:1;">
            <h4><i class="fas fa-plus-circle me-2"></i>Tambah File Unduhan</h4>
            <p>Lengkapi informasi file baru yang akan tersedia untuk diunduh.</p>
        </div>
        <a href="{{ route('download.index') }}" class="btn-back-download" style="position:relative;z-index:1;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="download-form-card card">
                <div class="card-body">
                    <form action="{{ route('unduhan.store') }}" method="POST" enctype="multipart/form-data"
                        id="formCreateDownload">
                        @csrf

                        {{-- Nama File --}}
                        <div class="mb-4">
                            <label for="name" class="form-label-custom">
                                Nama File <span class="required">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                class="form-control form-control-custom @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Contoh: SOP Pembangunan Aplikasi" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload File --}}
                        <div class="mb-4">
                            <label class="form-label-custom">
                                Pilih File <span class="required">*</span>
                            </label>
                            <input type="file" name="file" id="fileInput"
                                class="d-none @error('file') is-invalid @enderror"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar" required>
                            <div class="upload-zone" id="uploadZone">
                                <div class="upload-zone-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="upload-zone-title">Klik atau seret file ke sini</div>
                                <div class="upload-zone-sub">PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP, RAR (maks 10MB)
                                </div>
                            </div>
                            <div class="file-selected-info" id="fileSelectedInfo">
                                <div class="file-icon-sm"><i class="fas fa-file"></i></div>
                                <div class="file-details">
                                    <div class="fname" id="selectedFileName">-</div>
                                    <div class="fsize" id="selectedFileSize">-</div>
                                </div>
                                <button type="button" class="btn-remove-file" id="btnRemoveFile" title="Hapus file">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex align-items-center gap-3 mt-4 pt-2">
                            <button type="submit" class="btn-submit-download">
                                <i class="fas fa-save"></i> Simpan File Unduhan
                            </button>
                            <a href="{{ route('download.index') }}" class="btn-cancel-download">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="tips-card card">
                <div class="card-body">
                    <div class="tips-title">
                        <i class="fas fa-lightbulb"></i> Tips Upload File
                    </div>
                    <ul>
                        <li><i class="fas fa-circle"></i> Gunakan nama file yang jelas dan deskriptif agar mudah ditemukan.
                        </li>
                        <li><i class="fas fa-circle"></i> Ukuran maksimum file adalah 10MB.</li>
                        <li><i class="fas fa-circle"></i> Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP,
                            RAR.</li>
                        <li><i class="fas fa-circle"></i> Pastikan file tidak rusak sebelum diupload.</li>
                        <li><i class="fas fa-circle"></i> File yang diupload akan langsung tersedia untuk diunduh oleh
                            pengguna.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadZone = document.getElementById('uploadZone');
            const fileInput = document.getElementById('fileInput');
            const fileSelectedInfo = document.getElementById('fileSelectedInfo');
            const selectedFileName = document.getElementById('selectedFileName');
            const selectedFileSize = document.getElementById('selectedFileSize');
            const btnRemoveFile = document.getElementById('btnRemoveFile');

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function showFileInfo() {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    selectedFileName.textContent = file.name;
                    selectedFileSize.textContent = formatFileSize(file.size);
                    fileSelectedInfo.classList.add('show');
                    uploadZone.style.display = 'none';
                }
            }

            function clearFile() {
                fileInput.value = '';
                fileSelectedInfo.classList.remove('show');
                uploadZone.style.display = 'block';
            }

            uploadZone.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', showFileInfo);
            btnRemoveFile.addEventListener('click', clearFile);

            uploadZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });
            uploadZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });
            uploadZone.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;
                    showFileInfo();
                }
            });
        });
    </script>
@endpush
