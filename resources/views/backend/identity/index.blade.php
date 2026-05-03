@extends('backend.layouts.app')
@section('title', 'Admin - Identitas Website')

@push('css')
    <style>
        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: #f8f9fa;
            padding: 4px;
        }

        .favicon-preview {
            width: 48px;
            height: 48px;
        }

        .key-badge {
            font-size: 0.75rem;
            background: #e8eaf6;
            color: #3949ab;
            padding: 2px 8px;
            border-radius: 20px;
            font-family: monospace;
        }

        .section-divider {
            border-left: 4px solid #4680ff;
            padding-left: 12px;
            margin-bottom: 1.2rem;
        }

        .delete-row td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        {{-- ===== FORM UTAMA ===== --}}
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="ti ti-id-badge me-2 text-primary"></i>Identitas Website</h5>
                    <small class="text-muted">Kelola informasi & aset situs Anda</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('identity.store') }}" method="POST" enctype="multipart/form-data"
                        id="identityForm">
                        @csrf

                        {{-- ASET VISUAL --}}
                        <div class="section-divider">
                            <h6 class="text-uppercase text-muted fw-bold mb-0" style="font-size:.8rem">
                                <i class="ti ti-photo me-1"></i> Aset Visual
                            </h6>
                        </div>

                        {{-- Logo --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Logo Website</label>
                            <span class="key-badge ms-1">logo</span>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                @if (!empty($identities['logo']))
                                    <img src="{{ Storage::url($identities['logo']) }}" alt="Logo" id="logoPreview"
                                        class="preview-img">
                                @else
                                    <div class="preview-img d-flex align-items-center justify-content-center text-muted"
                                        id="logoPreview">
                                        <i class="ti ti-photo" style="font-size:2rem"></i>
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <input type="file" name="logo" id="logoInput"
                                        class="form-control @error('logo') is-invalid @enderror"
                                        accept="image/png,image/jpeg,image/jpg,image/svg+xml,image/webp"
                                        onchange="previewFile(event, 'logoPreview')">
                                    <small class="text-muted">Format: PNG, JPG, SVG, WebP. Maks 2 MB.</small>
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Favicon --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Favicon Website</label>
                            <span class="key-badge ms-1">favicon</span>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                @if (!empty($identities['favicon']))
                                    <img src="{{ Storage::url($identities['favicon']) }}" alt="Favicon" id="faviconPreview"
                                        class="preview-img favicon-preview">
                                @else
                                    <div class="preview-img favicon-preview d-flex align-items-center justify-content-center text-muted"
                                        id="faviconPreview">
                                        <i class="ti ti-star" style="font-size:1.2rem"></i>
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <input type="file" name="favicon" id="faviconInput"
                                        class="form-control @error('favicon') is-invalid @enderror"
                                        accept="image/png,image/jpeg,image/x-icon,image/svg+xml"
                                        onchange="previewFile(event, 'faviconPreview')">
                                    <small class="text-muted">Format: PNG, ICO, SVG. Maks 2 MB.</small>
                                    @error('favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- MEDIA SOSIAL --}}
                        <div class="section-divider">
                            <h6 class="text-uppercase text-muted fw-bold mb-0" style="font-size:.8rem">
                                <i class="ti ti-brand-instagram me-1"></i> Media Sosial
                            </h6>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-semibold">Instagram</label>
                                <span class="key-badge ms-1">instagram</span>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-brand-instagram"></i></span>
                                    <input type="url" name="instagram"
                                        class="form-control @error('instagram') is-invalid @enderror"
                                        placeholder="https://instagram.com/username"
                                        value="{{ old('instagram', $identities['instagram'] ?? '') }}">
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Facebook</label>
                                <span class="key-badge ms-1">facebook</span>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-brand-facebook"></i></span>
                                    <input type="url" name="facebook"
                                        class="form-control @error('facebook') is-invalid @enderror"
                                        placeholder="https://facebook.com/pagename"
                                        value="{{ old('facebook', $identities['facebook'] ?? '') }}">
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- INFO KANTOR --}}
                        <div class="section-divider">
                            <h6 class="text-uppercase text-muted fw-bold mb-0" style="font-size:.8rem">
                                <i class="ti ti-building me-1"></i> Informasi Kantor
                            </h6>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Kantor</label>
                            <span class="key-badge ms-1">office_address</span>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-map-pin"></i></span>
                                <textarea name="office_address" rows="2" class="form-control @error('office_address') is-invalid @enderror"
                                    placeholder="Jl. Contoh No. 1, Kota, Provinsi">{{ old('office_address', $identities['office_address'] ?? '') }}</textarea>
                                @error('office_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-semibold">Nomor HP Kantor</label>
                                <span class="key-badge ms-1">office_phone</span>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-phone"></i></span>
                                    <input type="text" name="office_phone"
                                        class="form-control @error('office_phone') is-invalid @enderror"
                                        placeholder="+62 8xx xxxx xxxx"
                                        value="{{ old('office_phone', $identities['office_phone'] ?? '') }}">
                                    @error('office_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Kantor</label>
                                <span class="key-badge ms-1">office_email</span>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                    <input type="email" name="office_email"
                                        class="form-control @error('office_email') is-invalid @enderror"
                                        placeholder="info@kantor.com"
                                        value="{{ old('office_email', $identities['office_email'] ?? '') }}">
                                    @error('office_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Link Embed Peta</label>
                            <span class="key-badge ms-1">office_map</span>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-map"></i></span>
                                <textarea name="office_map" rows="2" class="form-control @error('office_map') is-invalid @enderror"
                                    placeholder="<iframe src='https://maps.google.com/...' ...></iframe>">{{ old('office_map', $identities['office_map'] ?? '') }}</textarea>
                                @error('office_map')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Tempel kode embed dari Google Maps.</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                <i class="ti ti-device-floppy me-1"></i> Simpan Identitas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ===== PANEL DATA TERSIMPAN + DELETE ===== --}}
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0"><i class="ti ti-list-details me-2 text-warning"></i>Data Tersimpan</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:45%">Key</th>
                                    <th>Nilai</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $keyLabels = [
                                        'logo' => 'Logo',
                                        'favicon' => 'Favicon',
                                        'instagram' => 'Instagram',
                                        'facebook' => 'Facebook',
                                        'office_address' => 'Alamat',
                                        'office_phone' => 'No. HP',
                                        'office_email' => 'Email',
                                        'office_map' => 'Peta',
                                    ];
                                    $fileKeys = ['logo', 'favicon'];
                                @endphp
                                @foreach ($keyLabels as $k => $label)
                                    <tr class="delete-row">
                                        <td>
                                            <span class="key-badge">{{ $k }}</span>
                                            <div class="text-muted" style="font-size:.75rem">{{ $label }}</div>
                                        </td>
                                        <td>
                                            @if (!empty($identities[$k]))
                                                @if (in_array($k, $fileKeys))
                                                    <img src="{{ Storage::url($identities[$k]) }}"
                                                        alt="{{ $label }}"
                                                        style="width:40px;height:40px;object-fit:contain;border-radius:4px;border:1px solid #dee2e6;">
                                                @else
                                                    <span class="text-truncate d-inline-block"
                                                        style="max-width:100px;font-size:.78rem"
                                                        title="{{ $identities[$k] }}">
                                                        {{ Str::limit($identities[$k], 30) }}
                                                    </span>
                                                @endif
                                            @else
                                                <span class="badge bg-light text-muted">kosong</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (!empty($identities[$k]))
                                                <form action="{{ route('identity.destroy', $k) }}" method="POST"
                                                    class="delete-form d-inline" data-label="{{ $label }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Hapus {{ $label }}">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Preview Peta --}}
            @if (!empty($identities['office_map']))
                <div class="card shadow-sm mt-3">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="ti ti-map-2 me-2 text-info"></i>Preview Peta</h6>
                    </div>
                    <div class="card-body p-2">
                        <div style="width:100%;height:200px;overflow:hidden;border-radius:6px;">
                            {!! $identities['office_map'] !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // ----- Preview file upload -----
        function previewFile(event, previewId) {
            const file = event.target.files[0];
            if (!file) return;

            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                // Jika preview sudah berupa img, update src-nya
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    // Ganti div placeholder dengan img
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.id = previewId;
                    img.alt = 'Preview';
                    img.className = preview.className;
                    preview.replaceWith(img);
                }
            };
            reader.readAsDataURL(file);
        }

        // ----- SweetAlert untuk konfirmasi hapus -----
        document.querySelectorAll('.delete-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const label = form.dataset.label || 'data ini';
                Swal.fire({
                    title: 'Hapus ' + label + '?',
                    text: 'Data tidak dapat dikembalikan setelah dihapus.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                }).then(function(result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // ----- SweetAlert untuk notifikasi session flash -----
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        @endif

        // ----- Loading state saat submit -----
        document.getElementById('identityForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
        });
    </script>
@endpush
