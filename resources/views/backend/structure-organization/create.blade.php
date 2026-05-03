@extends('backend.layouts.app')
@section('title', 'Admin - Buat Struktur Organisasi')

@push('css')
<style>
    /* ===== KAIDA ADMIN - CREATE FORM ===== */
    .page-header-card {
        background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
        border-radius: 12px;
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.3);
    }
    .page-header-card h4 { font-size: 1.3rem; font-weight: 700; margin: 0; }
    .page-header-card .breadcrumb { margin: 0; font-size: 0.82rem; opacity: 0.85; }
    .page-header-card .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.6); }

    .main-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        overflow: hidden;
    }
    .main-card .card-header {
        background: #fff;
        border-bottom: 2px solid #e0e7ff;
        padding: 1.1rem 1.5rem;
    }
    .main-card .card-body { padding: 2rem; }

    /* Form section */
    .form-section-title {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #9ca3af;
        padding-bottom: 8px;
        border-bottom: 1px dashed #e5e7eb;
        margin-bottom: 1.2rem;
        margin-top: 1.5rem;
    }
    .form-section-title:first-of-type { margin-top: 0; }

    /* Form controls */
    .form-label { font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 5px; }
    .form-control, .form-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.875rem;
        color: #1f2937;
        padding: 9px 13px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        outline: none;
    }
    .form-control.is-invalid { border-color: #ef4444; }
    .invalid-feedback { font-size: 0.78rem; color: #ef4444; }

    /* Photo upload area */
    .photo-upload-area {
        border: 2px dashed #c7d2fe;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        background: #f5f3ff;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }
    .photo-upload-area:hover, .photo-upload-area.drag-over {
        border-color: #4f46e5;
        background: #eef2ff;
    }
    .photo-upload-area input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .upload-icon { font-size: 2rem; color: #a5b4fc; margin-bottom: 8px; }
    .upload-text { font-size: 0.85rem; color: #6366f1; font-weight: 600; }
    .upload-subtext { font-size: 0.75rem; color: #9ca3af; }

    /* Preview */
    #photoPreviewWrapper {
        display: none;
        text-align: center;
        margin-top: 12px;
    }
    #photoPreviewImg {
        width: 100px; height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #c7d2fe;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    #photoPreviewName { font-size: 0.78rem; color: #4f46e5; margin-top: 6px; font-weight: 600; }
    .btn-remove-photo {
        background: #fee2e2; color: #dc2626;
        border: none; border-radius: 6px;
        padding: 3px 10px; font-size: 0.75rem;
        cursor: pointer; margin-top: 6px;
        display: inline-block;
    }

    /* Checkbox */
    .custom-check-wrapper {
        background: #f0f9ff;
        border: 1.5px solid #bae6fd;
        border-radius: 10px;
        padding: 12px 16px;
        display: flex; align-items: center; gap: 10px;
    }
    .form-check-input { width: 18px; height: 18px; border-radius: 5px; cursor: pointer; }
    .form-check-input:checked { background-color: #4f46e5; border-color: #4f46e5; }

    /* Buttons */
    .btn-submit {
        background: linear-gradient(135deg, #4f46e5, #2563eb);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 28px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
        box-shadow: 0 3px 10px rgba(79, 70, 229, 0.35);
    }
    .btn-submit:hover { background: linear-gradient(135deg, #4338ca, #1d4ed8); color: #fff; transform: translateY(-1px); }
    .btn-cancel {
        background: #f3f4f6; color: #374151;
        border: none; border-radius: 10px;
        padding: 10px 22px;
        font-weight: 600; font-size: 0.9rem;
        transition: all 0.2s;
    }
    .btn-cancel:hover { background: #e5e7eb; }

    /* Tips card */
    .tips-card {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 10px;
        padding: 1rem 1.2rem;
        font-size: 0.8rem;
        color: #92400e;
    }
    .tips-card .tips-title { font-weight: 700; margin-bottom: 6px; font-size: 0.82rem; }
    .tips-card ul { margin: 0; padding-left: 16px; }
    .tips-card li { margin-bottom: 3px; }

    @media (max-width: 768px) {
        .main-card .card-body { padding: 1.2rem; }
        .page-header-card { padding: 1.1rem 1.2rem; }
    }
</style>
@endpush

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header-card text-white">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
        <div>
            <h4 class="text-white"><i class="fas fa-plus-circle me-2"></i>Tambah Struktur Organisasi</h4>
            {{-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-white text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('struktur-organisasi.index') }}" class="text-white text-decoration-none">Struktur Organisasi</a></li>
                    <li class="breadcrumb-item active text-white">Tambah Baru</li>
                </ol>
            </nav> --}}
        </div>
        <a href="{{ route('structure-organization.index') }}" class="btn btn-light btn-sm fw-semibold px-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<!-- ===== MAIN FORM CARD ===== -->
<div class="row justify-content-center">
    <div class="col-12 col-xl-12">

        <!-- Tips -->
        <div class="tips-card mb-3">
            <div class="tips-title"><i class="fas fa-lightbulb me-1"></i>Petunjuk Pengisian</div>
            <ul>
                <li>Kolom bertanda <strong class="text-danger">*</strong> wajib diisi.</li>
                <li>Unggah foto berformat JPG/PNG dengan ukuran maksimal <strong>2MB</strong>.</li>
                <li>Centang <strong>Aktif</strong> agar data tampil di halaman publik.</li>
            </ul>
        </div>

        <div class="main-card card">
            <div class="card-header d-flex align-items-center gap-2">
                <div style="width:36px;height:36px;background:#eef2ff;border-radius:9px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-user-plus" style="color:#4f46e5;"></i>
                </div>
                <div>
                    <h5 class="mb-0" style="font-size:0.97rem;font-weight:700;color:#1f2937;">Form Tambah Anggota</h5>
                    <small class="text-muted" style="font-size:0.76rem;">Isi seluruh data yang dibutuhkan</small>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('struktur-organisasi.store') }}"
                      method="POST" enctype="multipart/form-data" id="createForm">
                    @csrf

                    <!-- SECTION: Info Dasar -->
                    <div class="form-section-title">
                        <i class="fas fa-id-card me-1"></i> Informasi Dasar
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama') }}"
                                   placeholder="Masukkan nama lengkap" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan"
                                   class="form-control @error('jabatan') is-invalid @enderror"
                                   value="{{ old('jabatan') }}"
                                   placeholder="Contoh: Kepala Bidang" required>
                            @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bidang</label>
                            <select name="field_id" class="form-select">
                                <option value="">— Pilih Bidang —</option>
                                @foreach($fields as $field)
                                    <option value="{{ $field->id }}"
                                        {{ old('field_id') == $field->id ? 'selected' : '' }}>
                                        {{ $field->nama_bidang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Golongan</label>
                            <input type="text" name="golongan" class="form-control"
                                   value="{{ old('golongan') }}"
                                   placeholder="Contoh: III/b">
                        </div>
                    </div>

                    <!-- SECTION: Foto -->
                    <div class="form-section-title mt-4">
                        <i class="fas fa-camera me-1"></i> Foto Profil
                    </div>
                    <div class="photo-upload-area" id="uploadArea">
                        <input type="file" name="gambar" id="photoInput"
                               class="@error('gambar') is-invalid @enderror"
                               accept="image/*">
                        <div id="uploadPlaceholder">
                            <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="upload-text">Klik atau seret foto ke sini</div>
                            <div class="upload-subtext">JPG, PNG, GIF — Maks. 2MB</div>
                        </div>
                    </div>
                    @error('gambar')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    <div id="photoPreviewWrapper">
                        <img id="photoPreviewImg" src="#" alt="Preview">
                        <div id="photoPreviewName"></div>
                        <button type="button" class="btn-remove-photo" onclick="removePhoto()">
                            <i class="fas fa-times me-1"></i> Hapus
                        </button>
                    </div>

                    <!-- SECTION: Status -->
                    <div class="form-section-title mt-4">
                        <i class="fas fa-toggle-on me-1"></i> Status
                    </div>
                    <div class="custom-check-wrapper">
                        <input type="checkbox" name="is_active" id="is_active"
                               class="form-check-input"
                               value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active" style="font-size:0.875rem;font-weight:600;color:#374151;cursor:pointer;">
                            Aktif
                            <small class="d-block fw-normal text-muted" style="font-size:0.75rem;">
                                Data akan ditampilkan di halaman publik jika diaktifkan
                            </small>
                        </label>
                    </div>

                    <!-- BUTTONS -->
                    <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn-submit" id="btnSubmit">
                            <i class="fas fa-save me-1"></i> Simpan Data
                        </button>
                        <a href="{{ route('structure-organization.index') }}" class="btn-cancel">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // ===== Photo preview =====
    const photoInput  = document.getElementById('photoInput');
    const previewWrap = document.getElementById('photoPreviewWrapper');
    const previewImg  = document.getElementById('photoPreviewImg');
    const previewName = document.getElementById('photoPreviewName');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');

    photoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                previewImg.src = ev.target.result;
                previewName.textContent = file.name;
                previewWrap.style.display = 'block';
                uploadPlaceholder.style.opacity = '0.4';
            };
            reader.readAsDataURL(file);
        }
    });

    function removePhoto() {
        photoInput.value = '';
        previewWrap.style.display = 'none';
        uploadPlaceholder.style.opacity = '1';
        previewImg.src = '#';
    }

    // ===== Drag & drop visual feedback =====
    const uploadArea = document.getElementById('uploadArea');
    uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.classList.add('drag-over'); });
    uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('drag-over'));
    uploadArea.addEventListener('drop', () => uploadArea.classList.remove('drag-over'));

    // ===== Submit with loading =====
    document.getElementById('createForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('btnSubmit');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
        btn.disabled  = true;
    });

    // ===== Error validation alert =====
    @if($errors->any())
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: 'Mohon periksa kembali form Anda',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
    });
    @endif

    @if(session('success'))
    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: '{{ session('success') }}', showConfirmButton: false, timer: 3000, timerProgressBar: true });
    @endif
</script>
@endpush