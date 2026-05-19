@extends('frontend.layouts.app')

@section('title')
    Pengajuan - DISKOMINFOSANTIK
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        /* Page Banner */
        .page-banner {
            background: linear-gradient(135deg, var(--primary) 0%, #1a56a8 100%);
            padding: 50px 0 30px;
        }

        .page-banner h1 {
            color: #fff;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .dz-breadcrumb .breadcrumb-item a,
        .dz-breadcrumb .breadcrumb-item {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .dz-breadcrumb .breadcrumb-item.active {
            color: #fff;
        }

        .dz-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Tab Switcher */
        .tab-switcher {
            display: flex;
            background: #f1f5f9;
            border-radius: 12px;
            padding: 4px;
            gap: 4px;
            margin-bottom: 32px;
        }

        .tab-switcher .tab-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: transparent;
            color: #64748b;
        }

        .tab-switcher .tab-btn.active {
            background: #fff;
            color: var(--primary);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Card */
        .form-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            padding: 36px;
        }

        .form-card .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #f1f5f9;
        }

        .form-card .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-card .form-label span.required {
            color: #ef4444;
            margin-left: 2px;
        }

        .form-card .form-control,
        .form-card .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            color: #1e293b;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-card .form-control:focus,
        .form-card .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb, 0, 82, 204), 0.12);
            outline: none;
        }

        .form-card .form-control.is-invalid,
        .form-card .form-select.is-invalid {
            border-color: #ef4444;
        }

        .form-card textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* File Upload Area */
        .file-upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 22px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fafc;
            position: relative;
        }

        .file-upload-area:hover,
        .file-upload-area.dragover {
            border-color: var(--primary);
            background: rgba(var(--primary-rgb, 0, 82, 204), 0.04);
        }

        .file-upload-area.required-file {
            border-color: #94a3b8;
        }

        .file-upload-area.required-file:hover {
            border-color: var(--primary);
        }

        .file-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-upload-area .upload-icon {
            font-size: 28px;
            color: #94a3b8;
            margin-bottom: 6px;
        }

        .file-upload-area .upload-text {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }

        .file-upload-area .upload-text strong {
            color: var(--primary);
        }

        .file-preview {
            display: none;
            align-items: center;
            gap: 10px;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 12px;
            margin-top: 8px;
            font-size: 13px;
            color: #374151;
            text-align: left;
        }

        .file-preview.show {
            display: flex;
        }

        .file-preview .file-name {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Submit Button */
        .btn-submit {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: var(--primary-dark, #003580);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(var(--primary-rgb, 0, 82, 204), 0.35);
        }

        /* Track Card */
        .track-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            padding: 36px;
        }

        .track-input-group {
            display: flex;
            gap: 12px;
        }

        .track-input-group .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 15px;
            flex: 1;
        }

        .track-input-group .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb, 0, 82, 204), 0.12);
            outline: none;
        }

        .btn-track {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 14px;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .btn-track:hover {
            background: var(--primary-dark, #003580);
            color: #fff;
        }

        /* Alert */
        .alert-success-custom {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #86efac;
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-success-custom .alert-icon {
            font-size: 22px;
            color: #16a34a;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-success-custom .alert-content strong {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #15803d;
            margin-bottom: 2px;
        }

        .alert-success-custom .alert-content span {
            font-size: 13px;
            color: #166534;
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 20px;
        }

        .info-box .info-title {
            font-weight: 700;
            color: #1d4ed8;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .info-box ul {
            margin: 0;
            padding-left: 18px;
        }

        .info-box ul li {
            font-size: 13px;
            color: #1e40af;
            margin-bottom: 4px;
        }

        /* File addition badge */
        .badge-optional {
            font-size: 10px;
            font-weight: 600;
            background: #f1f5f9;
            color: #64748b;
            border-radius: 6px;
            padding: 2px 8px;
            margin-left: 6px;
            vertical-align: middle;
        }

        /* DataTable Pagination Primary Color */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #fff !important;
        }

        /* Bootstrap Pagination Override (jika pakai Bootstrap pagination) */
        .page-item.active .page-link {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #fff !important;
        }

        .page-link:hover {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #fff !important;
        }

        .page-link {
            color: var(--primary);
        }
    </style>
@endpush

@section('content')
    <div class="page-content bg-white">

        {{-- Page Banner --}}
        <div class="page-banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="mb-2">Help Desk - Pengajuan</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb dz-breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('main.index') }}">Beranda</a>
                                </li>
                                <li class="breadcrumb-item active">Pengajuan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="container py-5">

            {{-- Success Alert --}}
            @if (session('success'))
                <div class="alert-success-custom mb-4">
                    <div class="alert-icon">
                        <i class="mdi mdi-check-circle"></i>
                    </div>
                    <div class="alert-content">
                        <strong>Berhasil!</strong>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="row g-4">

                {{-- LEFT: Form & Track --}}
                <div class="col-lg-8">

                    {{-- Tab Switcher --}}
                    <div class="tab-switcher">
                        <button class="tab-btn active" id="tab-form-btn" onclick="switchTab('form')">
                            <i class="mdi mdi-pencil-plus-outline me-1"></i> Ajukan Permohonan Baru
                        </button>
                        <button class="tab-btn" id="tab-track-btn" onclick="switchTab('track')">
                            <i class="mdi mdi-magnify me-1"></i> Lacak Status Tiket
                        </button>
                        <button class="tab-btn" id="tab-list-btn" onclick="switchTab('list')">
                            <i class="mdi mdi-format-list-bulleted me-1"></i> Daftar Pengajuan
                        </button>
                    </div>

                    {{-- FORM TAB --}}
                    <div id="tab-form" class="form-card">
                        <form action="{{ route('frontend.requests.store') }}" method="POST" enctype="multipart/form-data"
                            novalidate>
                            @csrf

                            {{-- Data Pemohon --}}
                            <p class="section-label">
                                <i class="mdi mdi-account-outline me-1"></i> Data Pemohon
                            </p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Nama Lengkap <span class="required">*</span>
                                    </label>
                                    <input type="text" name="requester_name"
                                        class="form-control @error('requester_name') is-invalid @enderror"
                                        placeholder="Masukkan nama lengkap" value="{{ old('requester_name') }}">
                                    @error('requester_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        NIP <span class="text-muted fw-normal">(Opsional)</span>
                                    </label>
                                    <input type="text" name="nip"
                                        class="form-control @error('nip') is-invalid @enderror"
                                        placeholder="Masukkan NIP jika ada" value="{{ old('nip') }}">
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Nama Unit / Instansi <span class="required">*</span>
                                    </label>
                                    <input type="text" name="unit_name"
                                        class="form-control @error('unit_name') is-invalid @enderror"
                                        placeholder="Nama unit atau instansi Anda" value="{{ old('unit_name') }}">
                                    @error('unit_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Nomor Telepon / WhatsApp <span class="required">*</span>
                                    </label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Contoh: 08123456789" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">
                                        Alamat Email <span class="required">*</span>
                                    </label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Contoh: nama@instansi.go.id" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Detail Pengajuan --}}
                            <p class="section-label">
                                <i class="mdi mdi-clipboard-text-outline me-1"></i> Detail Pengajuan
                            </p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Kategori Pengajuan <span class="required">*</span>
                                    </label>
                                    <select name="category" class="form-select @error('category') is-invalid @enderror">
                                        <option value="" disabled {{ old('category') ? '' : 'selected' }}>
                                            -- Pilih Kategori --
                                        </option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->value }}"
                                                {{ old('category') == $cat->value ? 'selected' : '' }}>
                                                {{ $cat->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Batas Waktu yang Diharapkan
                                        <span class="text-muted fw-normal">(Opsional)</span>
                                    </label>
                                    <input type="date" name="deadline_by_requester"
                                        class="form-control @error('deadline_by_requester') is-invalid @enderror"
                                        value="{{ old('deadline_by_requester') }}" min="{{ date('Y-m-d') }}">
                                    @error('deadline_by_requester')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">
                                        Judul Pengajuan <span class="required">*</span>
                                    </label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Ringkasan singkat mengenai pengajuan Anda"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">
                                        Deskripsi Pengajuan <span class="required">*</span>
                                    </label>
                                    <textarea name="desc" class="form-control @error('desc') is-invalid @enderror"
                                        placeholder="Jelaskan pengajuan Anda secara detail...">{{ old('desc') }}</textarea>
                                    @error('desc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- File Lampiran --}}
                            <p class="section-label">
                                <i class="mdi mdi-paperclip me-1"></i> File Lampiran
                            </p>
                            <div class="row g-3 mb-4">

                                {{-- Surat Pengantar (Wajib) --}}
                                <div class="col-12">
                                    <label class="form-label">
                                        Surat Pengantar <span class="required">*</span>
                                    </label>
                                    <div class="file-upload-area required-file" id="area-surat">
                                        <input type="file" name="file_surat_pengantar" id="file-surat"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            onchange="handleFile(this, 'preview-surat', 'placeholder-surat')">
                                        <div id="placeholder-surat">
                                            <div class="upload-icon">
                                                <i class="mdi mdi-file-document-outline"></i>
                                            </div>
                                            <p class="upload-text">
                                                <strong>Klik untuk upload</strong> surat pengantar
                                            </p>
                                            <p class="upload-text mt-1" style="font-size:12px;">
                                                PDF, JPG, JPEG, PNG — Maks. 5MB
                                            </p>
                                        </div>
                                        <div class="file-preview" id="preview-surat">
                                            <i class="mdi mdi-file-outline text-primary" style="font-size:18px;"></i>
                                            <span class="file-name"></span>
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0 ms-auto"
                                                onclick="clearFile('file-surat', 'preview-surat', 'placeholder-surat')">
                                                <i class="mdi mdi-close-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('file_surat_pengantar')
                                        <div class="text-danger mt-1" style="font-size:13px;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- File Addition 1 --}}
                                <div class="col-md-4">
                                    <label class="form-label">
                                        File Tambahan 1
                                        <span class="badge-optional">Opsional</span>
                                    </label>
                                    <div class="file-upload-area" id="area-add1">
                                        <input type="file" name="file_addition1" id="file-add1"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            onchange="handleFile(this, 'preview-add1', 'placeholder-add1')">
                                        <div id="placeholder-add1">
                                            <div class="upload-icon" style="font-size:22px;">
                                                <i class="mdi mdi-plus-circle-outline"></i>
                                            </div>
                                            <p class="upload-text" style="font-size:12px;">
                                                <strong>Upload file</strong> tambahan
                                            </p>
                                        </div>
                                        <div class="file-preview" id="preview-add1">
                                            <i class="mdi mdi-file-outline text-primary" style="font-size:16px;"></i>
                                            <span class="file-name" style="font-size:12px;"></span>
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0 ms-auto"
                                                onclick="clearFile('file-add1', 'preview-add1', 'placeholder-add1')">
                                                <i class="mdi mdi-close-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('file_addition1')
                                        <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- File Addition 2 --}}
                                <div class="col-md-4">
                                    <label class="form-label">
                                        File Tambahan 2
                                        <span class="badge-optional">Opsional</span>
                                    </label>
                                    <div class="file-upload-area" id="area-add2">
                                        <input type="file" name="file_addition2" id="file-add2"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            onchange="handleFile(this, 'preview-add2', 'placeholder-add2')">
                                        <div id="placeholder-add2">
                                            <div class="upload-icon" style="font-size:22px;">
                                                <i class="mdi mdi-plus-circle-outline"></i>
                                            </div>
                                            <p class="upload-text" style="font-size:12px;">
                                                <strong>Upload file</strong> tambahan
                                            </p>
                                        </div>
                                        <div class="file-preview" id="preview-add2">
                                            <i class="mdi mdi-file-outline text-primary" style="font-size:16px;"></i>
                                            <span class="file-name" style="font-size:12px;"></span>
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0 ms-auto"
                                                onclick="clearFile('file-add2', 'preview-add2', 'placeholder-add2')">
                                                <i class="mdi mdi-close-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('file_addition2')
                                        <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- File Addition 3 --}}
                                <div class="col-md-4">
                                    <label class="form-label">
                                        File Tambahan 3
                                        <span class="badge-optional">Opsional</span>
                                    </label>
                                    <div class="file-upload-area" id="area-add3">
                                        <input type="file" name="file_addition3" id="file-add3"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            onchange="handleFile(this, 'preview-add3', 'placeholder-add3')">
                                        <div id="placeholder-add3">
                                            <div class="upload-icon" style="font-size:22px;">
                                                <i class="mdi mdi-plus-circle-outline"></i>
                                            </div>
                                            <p class="upload-text" style="font-size:12px;">
                                                <strong>Upload file</strong> tambahan
                                            </p>
                                        </div>
                                        <div class="file-preview" id="preview-add3">
                                            <i class="mdi mdi-file-outline text-primary" style="font-size:16px;"></i>
                                            <span class="file-name" style="font-size:12px;"></span>
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0 ms-auto"
                                                onclick="clearFile('file-add3', 'preview-add3', 'placeholder-add3')">
                                                <i class="mdi mdi-close-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('file_addition3')
                                        <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <button type="submit" class="btn btn-submit">
                                <i class="mdi mdi-send me-2"></i> Kirim Pengajuan
                            </button>

                        </form>
                    </div>

                    {{-- TRACK TAB --}}
                    <div id="tab-track" class="track-card" style="display:none;">
                        <h5 class="fw-700 mb-2" style="font-size:18px;">Lacak Status Tiket Pengajuan</h5>
                        <p class="text-muted mb-4" style="font-size:14px;">
                            Masukkan nomor tiket yang Anda terima setelah mengajukan permohonan
                            untuk melihat status terkini.
                        </p>
                        <form action="{{ route('frontend.requests.track') }}" method="GET">
                            @if ($errors->has('ticket_id'))
                                <div class="alert alert-danger rounded-3 mb-3 py-2 px-3" style="font-size:13px;">
                                    <i class="mdi mdi-alert-circle me-1"></i>
                                    {{ $errors->first('ticket_id') }}
                                </div>
                            @endif
                            <div class="track-input-group">
                                <input type="number" name="ticket_id" class="form-control"
                                    placeholder="Masukkan nomor tiket, contoh: 12" value="{{ old('ticket_id') }}"
                                    min="1">
                                <button type="submit" class="btn btn-track">
                                    <i class="mdi mdi-magnify me-1"></i> Lacak
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- LIST TAB --}}
                    <div id="tab-list" class="form-card" style="display:none;">
                        <h5 class="fw-700 mb-3" style="font-size:18px;">Daftar Pengajuan</h5>
                        <div class="table-responsive">
                            <table id="requestsTable" class="table table-striped table-bordered w-100"
                                style="font-size:13px;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemohon</th>
                                        <th>Unit / Instansi</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $i => $req)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $req->requester_name }}</td>
                                            <td>{{ $req->unit_name }}</td>
                                            <td>
                                                {{ $req->title }}
                                            </td>
                                            <td>
                                                @php
                                                    $catLabel = $categories->firstWhere('value', $req->category);
                                                @endphp
                                                {{ $catLabel ? $catLabel->label : $req->category }}
                                            </td>
                                            <td>
                                                @php
                                                    $statusOption = $statuses->firstWhere('value', $req->status);
                                                    $badgeColor = match ($req->status) {
                                                        'sent' => '#3b82f6',
                                                        'on_progress' => '#f59e0b',
                                                        'done' => '#10b981',
                                                        'rejected' => '#ef4444',
                                                        default => '#64748b',
                                                    };
                                                @endphp
                                                <span class="badge"
                                                    style="background:{{ $badgeColor }}; font-size:11px; padding:5px 10px; border-radius:6px;">
                                                    {{ $statusOption ? $statusOption->label : ucfirst($req->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                {{-- RIGHT: Info Panel --}}
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-3">

                        {{-- Kategori Pengajuan --}}
                        <div class="form-card p-4">
                            <p class="section-label mb-3">
                                <i class="mdi mdi-tag-multiple-outline me-1"></i> Kategori Pengajuan
                            </p>
                            <div class="d-flex flex-column gap-2">
                                @foreach ($categories as $cat)
                                    <div class="d-flex align-items-center gap-2 p-2 rounded-3"
                                        style="background:#f8fafc; font-size:13px;">
                                        <i class="mdi mdi-circle-small text-primary" style="font-size:18px;"></i>
                                        <span class="text-secondary">{{ $cat->label }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Info Pengajuan --}}
                        <div class="info-box">
                            <p class="info-title">
                                <i class="mdi mdi-information-outline me-1"></i> Informasi Penting
                            </p>
                            <ul>
                                <li>Pastikan data yang diisi sudah benar dan lengkap.</li>
                                <li><strong>Surat pengantar</strong> dari instansi wajib dilampirkan.</li>
                                <li>File tambahan (1-3) bersifat opsional sesuai kebutuhan.</li>
                                <li>Nomor tiket akan diberikan setelah pengajuan berhasil dikirim.</li>
                                <li>Simpan nomor tiket untuk melacak status pengajuan Anda.</li>
                                <li>Setiap file maksimal <strong>5MB</strong> (PDF, JPG, PNG).</li>
                            </ul>
                        </div>

                        {{-- Kontak Bantuan --}}
                        <div class="form-card p-4">
                            <p class="section-label mb-3">
                                <i class="mdi mdi-headset me-1"></i> Butuh Bantuan?
                            </p>
                            <p class="text-muted mb-3" style="font-size:13px;">
                                Jika mengalami kendala dalam pengisian form, hubungi kami melalui:
                            </p>
                            <a href="https://wa.me/{{ $site_identity->get('office_phone') }}" target="_blank"
                                class="btn d-flex align-items-center justify-content-center gap-2 w-100"
                                style="background:#25D366; color:#fff; border-radius:10px;
                                   font-weight:600; font-size:14px;">
                                <i class="fab fa-whatsapp" style="font-size:18px;"></i>
                                Chat via WhatsApp
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Tab Switcher
        function switchTab(tab) {
            const tabs = ['form', 'track', 'list'];
            tabs.forEach(function(t) {
                document.getElementById('tab-' + t).style.display = (t === tab) ? 'block' : 'none';
                document.getElementById('tab-' + t + '-btn').classList.toggle('active', t === tab);
            });
            if (tab === 'list' && !$.fn.DataTable.isDataTable('#requestsTable')) {
                $('#requestsTable').DataTable({
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        paginate: {
                            previous: "‹",
                            next: "›"
                        },
                        zeroRecords: "Tidak ada data ditemukan",
                        infoEmpty: "Tidak ada data",
                    }
                });
            }
        }

        // Otomatis pindah ke tab yang sesuai berdasarkan error
        @if ($errors->has('ticket_id'))
            switchTab('track');
        @endif
        @if (
            $errors->hasAny([
                'title',
                'category',
                'unit_name',
                'requester_name',
                'phone',
                'email',
                'desc',
                'file_surat_pengantar',
                'file_addition1',
                'file_addition2',
                'file_addition3',
            ]))
            switchTab('form');
        @endif

        // File Upload Handler
        function handleFile(input, previewId, placeholderId) {
            if (!input.files || !input.files[0]) return;

            const file = input.files[0];
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);
            const nameEl = preview.querySelector('.file-name');

            placeholder.style.display = 'none';
            preview.classList.add('show');
            nameEl.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
        }

        function clearFile(inputId, previewId, placeholderId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).classList.remove('show');
            document.getElementById(placeholderId).style.display = 'block';
        }

        // Drag & Drop untuk setiap area upload
        document.querySelectorAll('.file-upload-area').forEach(function(area) {
            area.addEventListener('dragover', function(e) {
                e.preventDefault();
                area.classList.add('dragover');
            });
            area.addEventListener('dragleave', function() {
                area.classList.remove('dragover');
            });
            area.addEventListener('drop', function(e) {
                e.preventDefault();
                area.classList.remove('dragover');
                const input = area.querySelector('input[type="file"]');
                if (input && e.dataTransfer.files.length) {
                    input.files = e.dataTransfer.files;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });
    </script>
@endpush
