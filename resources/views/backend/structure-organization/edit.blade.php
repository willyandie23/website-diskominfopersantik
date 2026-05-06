@extends('backend.layouts.app')
@section('title', 'Admin - Edit Struktur Organisasi')

@push('css')
<style>
    /* ===== KAIDA ADMIN - EDIT FORM ===== */
    .page-header-card {
        background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
        border-radius: 12px;
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(217, 119, 6, 0.3);
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
        border-bottom: 2px solid #fef3c7;
        padding: 1.1rem 1.5rem;
    }
    .main-card .card-body { padding: 2rem; }

    /* Section divider */
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
        background: #fff;
    }
    .form-control:focus, .form-select:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
        outline: none;
    }
    .form-control.is-invalid { border-color: #ef4444; }
    .invalid-feedback { font-size: 0.78rem; color: #ef4444; }

    /* Current image preview */
    .current-photo-wrapper {
        background: #fffbeb;
        border: 2px dashed #fcd34d;
        border-radius: 12px;
        padding: 1.2rem;
        text-align: center;
        position: relative;
    }
    .current-photo-wrapper .photo-badge {
        position: absolute; top: -10px; left: 50%; transform: translateX(-50%);
        background: #f59e0b; color: #fff;
        font-size: 0.7rem; font-weight: 700;
        padding: 2px 10px; border-radius: 20px;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .current-photo-wrapper img {
        width: 100px; height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .current-photo-wrapper p { font-size: 0.8rem; color: #92400e; margin-top: 8px; margin-bottom: 0; }

    /* New photo preview */
    #photoPreviewWrapper {
        display: none;
        background: #f0fdf4;
        border: 2px dashed #86efac;
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        margin-top: 8px;
    }
    #photoPreviewImg {
        width: 90px; height: 90px;
        object-fit: cover; border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    #photoPreviewWrapper p { font-size: 0.78rem; color: #15803d; margin-top: 6px; margin-bottom: 0; }

    /* Checkbox custom */
    .custom-check-wrapper {
        background: #fffbeb;
        border: 1.5px solid #fde68a;
        border-radius: 10px;
        padding: 12px 16px;
        display: flex; align-items: center; gap: 10px;
    }
    .form-check-input { width: 18px; height: 18px; border-radius: 5px; cursor: pointer; }
    .form-check-input:checked { background-color: #f59e0b; border-color: #f59e0b; }

    /* Buttons */
    .btn-submit {
        background: linear-gradient(135deg, #d97706, #f59e0b);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 28px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
        box-shadow: 0 3px 10px rgba(245, 158, 11, 0.35);
    }
    .btn-submit:hover { background: linear-gradient(135deg, #b45309, #d97706); color: #fff; transform: translateY(-1px); }
    .btn-cancel {
        background: #f3f4f6; color: #374151;
        border: none; border-radius: 10px;
        padding: 10px 22px;
        font-weight: 600; font-size: 0.9rem;
        transition: all 0.2s;
    }
    .btn-cancel:hover { background: #e5e7eb; color: #111827; }

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
            <h4 class="text-white"><i class="fas fa-edit me-2"></i>Edit Struktur Organisasi</h4>
            {{-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-white text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('struktur-organisasi.index') }}" class="text-white text-decoration-none">Struktur Organisasi</a></li>
                    <li class="breadcrumb-item active text-white">Edit</li>
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
        <div class="main-card card">
            <div class="card-header d-flex align-items-center gap-2">
                <div style="width:36px;height:36px;background:#fffbeb;border-radius:9px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-user-edit" style="color:#d97706;"></i>
                </div>
                <div>
                    <h5 class="mb-0" style="font-size:0.97rem;font-weight:700;color:#1f2937;">
                        Edit Data: <span style="color:#d97706;">{{ $strukturOrganisasi->nama }}</span>
                    </h5>
                    <small class="text-muted" style="font-size:0.76rem;">Perbarui informasi anggota struktur organisasi</small>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('struktur-organisasi.update', $strukturOrganisasi) }}"
                      method="POST" enctype="multipart/form-data" id="editForm">
                    @csrf
                    @method('PUT')

                    <!-- SECTION: Info Dasar -->
                    <div class="form-section-title">
                        <i class="fas fa-id-card me-1"></i> Informasi Dasar
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $strukturOrganisasi->nama) }}"
                                   placeholder="Masukkan nama lengkap" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan"
                                   class="form-control @error('jabatan') is-invalid @enderror"
                                   value="{{ old('jabatan', $strukturOrganisasi->jabatan) }}"
                                   placeholder="Contoh: Kepala Bidang" required>
                            @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bidang</label>
                            <select name="field_id" class="form-select">
                                <option value="">— Pilih Bidang —</option>
                                @foreach($fields as $field)
                                    <option value="{{ $field->id }}"
                                        {{ old('field_id', $strukturOrganisasi->field_id) == $field->id ? 'selected' : '' }}>
                                        {{ $field->nama_bidang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIP</label>
                            <input type="text" name="golongan" class="form-control"
                                   value="{{ old('golongan', $strukturOrganisasi->golongan) }}"
                                   placeholder="Contoh: 12344559 32165 0 001">
                        </div>
                    </div>

                    <!-- SECTION: Foto -->
                    <div class="form-section-title mt-4">
                        <i class="fas fa-camera me-1"></i> Foto Profil
                    </div>
                    <div class="row g-3 align-items-start">
                        @if ($strukturOrganisasi->gambar)
                        <div class="col-md-4">
                            <label class="form-label">Foto Saat Ini</label>
                            <div class="current-photo-wrapper">
                                <span class="photo-badge">Terpasang</span>
                                <img src="{{ $strukturOrganisasi->gambar_url }}" alt="{{ $strukturOrganisasi->nama }}">
                                <p>{{ $strukturOrganisasi->nama }}</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                        @else
                        <div class="col-12">
                        @endif
                            <label class="form-label">
                                {{ $strukturOrganisasi->gambar ? 'Ganti Foto (Opsional)' : 'Upload Foto' }}
                            </label>
                            <input type="file" name="gambar" id="photoInput"
                                   class="form-control @error('gambar') is-invalid @enderror"
                                   accept="image/*">
                            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div id="photoPreviewWrapper">
                                <img id="photoPreviewImg" src="#" alt="Preview">
                                <p><i class="fas fa-check-circle me-1"></i>Foto baru siap diunggah</p>
                            </div>
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-info-circle me-1"></i>
                                Format: JPG, PNG, GIF. Maks: 2MB.
                            </small>
                        </div>
                    </div>

                    <!-- SECTION: Status -->
                    <div class="form-section-title mt-4">
                        <i class="fas fa-toggle-on me-1"></i> Status
                    </div>
                    <div class="custom-check-wrapper">
                        <input type="checkbox" name="is_active" id="is_active"
                               class="form-check-input"
                               value="1" {{ old('is_active', $strukturOrganisasi->is_active) ? 'checked' : '' }}>
                        <label for="is_active" style="font-size:0.875rem;font-weight:600;color:#374151;cursor:pointer;">
                            Aktif
                            <small class="d-block fw-normal text-muted" style="font-size:0.75rem;">
                                Data akan ditampilkan di halaman publik jika diaktifkan
                            </small>
                        </label>
                    </div>

                    <!-- BUTTONS -->
                    <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-1"></i> Update Data
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
    // Photo preview
    document.getElementById('photoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('photoPreviewImg').src = ev.target.result;
                document.getElementById('photoPreviewWrapper').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // SweetAlert on submit
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: 'Data akan diperbarui sesuai informasi yang dimasukkan.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d97706',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-save me-1"></i> Ya, Update!',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-4' },
            buttonsStyling: true
        }).then(result => { if (result.isConfirmed) form.submit(); });
    });

    @if(session('success'))
    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: '{{ session('success') }}', showConfirmButton: false, timer: 3000, timerProgressBar: true });
    @endif
</script>
@endpush