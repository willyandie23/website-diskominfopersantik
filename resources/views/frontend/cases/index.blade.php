@extends('frontend.layouts.app')

@section('title')
    Keluhan - DISKOMINFOPERSANTIK
@endsection

@push('css')
    <style>
        .cases-hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark, #003580) 100%);
            padding: 60px 0 40px;
            position: relative;
            overflow: hidden;
        }

        .cases-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .cases-hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
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
            padding: 28px 20px;
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

        .file-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-upload-area .upload-icon {
            font-size: 32px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .file-upload-area .upload-text {
            font-size: 14px;
            color: #64748b;
            margin: 0;
        }

        .file-upload-area .upload-text strong {
            color: var(--primary);
        }

        .file-upload-area .file-info {
            display: none;
            align-items: center;
            gap: 10px;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 12px;
            margin-top: 10px;
            font-size: 13px;
            color: #374151;
        }

        .file-upload-area .file-info.show {
            display: flex;
        }

        /* Submit Button */
        .btn-submit-case {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .btn-submit-case:hover {
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
            font-size: 20px;
            color: #16a34a;
            flex-shrink: 0;
            margin-top: 2px;
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

        /* Breadcrumb */
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
    </style>
@endpush

@section('content')
    <div class="page-content bg-white">

        {{-- Page Banner --}}
        <div class="page-banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="mb-2">Help Desk - Keluhan</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb dz-breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('main.index') }}">Beranda</a>
                                </li>
                                <li class="breadcrumb-item active">Keluhan</li>
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
                        <strong>Keluhan Berhasil Dikirim!</strong>
                        <span>{{ session('success') }}</span>
                        @if (session('ticket_id'))
                            <div class="mt-2 p-2 rounded-3 d-inline-block"
                                style="background:#dcfce7; border:1.5px dashed #16a34a;">
                                <span style="font-size:13px; color:#15803d;">
                                    <i class="mdi mdi-ticket-outline me-1"></i>
                                    Nomor Tiket: <strong style="font-size:16px;">#{{ session('ticket_id') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="row g-4">

                {{-- LEFT: Form & Track --}}
                <div class="col-lg-8">

                    {{-- Tab Switcher --}}
                    <div class="tab-switcher">
                        <button class="tab-btn active" id="tab-form-btn" onclick="switchTab('form')">
                            <i class="mdi mdi-pencil-plus-outline me-1"></i> Ajukan Keluhan Baru
                        </button>
                        <button class="tab-btn" id="tab-track-btn" onclick="switchTab('track')">
                            <i class="mdi mdi-magnify me-1"></i> Lacak Status Tiket
                        </button>
                    </div>

                    {{-- FORM TAB --}}
                    <div id="tab-form" class="form-card">
                        <form action="{{ route('frontend.cases.store') }}" method="POST" enctype="multipart/form-data"
                            novalidate>
                            @csrf

                            {{-- Data Pelapor --}}
                            <p class="section-label">
                                <i class="mdi mdi-account-outline me-1"></i> Data Pelapor
                            </p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" name="requester_name"
                                        class="form-control @error('requester_name') is-invalid @enderror"
                                        placeholder="Masukkan nama lengkap" value="{{ old('requester_name') }}">
                                    @error('requester_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIP <span
                                            class="text-muted fw-normal">(Opsional)</span></label>
                                    <input type="text" name="nip"
                                        class="form-control @error('nip') is-invalid @enderror"
                                        placeholder="Masukkan NIP jika ada" value="{{ old('nip') }}">
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Unit / Instansi <span class="required">*</span></label>
                                    <input type="text" name="unit_name"
                                        class="form-control @error('unit_name') is-invalid @enderror"
                                        placeholder="Nama unit atau instansi Anda" value="{{ old('unit_name') }}">
                                    @error('unit_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor Telepon / WhatsApp <span
                                            class="required">*</span></label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Contoh: 08123456789" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Alamat Email <span class="required">*</span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Contoh: nama@instansi.go.id" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Detail Keluhan --}}
                            <p class="section-label">
                                <i class="mdi mdi-clipboard-text-outline me-1"></i> Detail Keluhan
                            </p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Kategori Keluhan <span class="required">*</span></label>
                                    <select name="category" class="form-select @error('category') is-invalid @enderror">
                                        <option value="" disabled {{ old('category') ? '' : 'selected' }}>-- Pilih
                                            Kategori --</option>
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
                                    <label class="form-label">Batas Waktu yang Diharapkan <span
                                            class="text-muted fw-normal">(Opsional)</span></label>
                                    <input type="date" name="deadline_by_requester"
                                        class="form-control @error('deadline_by_requester') is-invalid @enderror"
                                        value="{{ old('deadline_by_requester') }}" min="{{ date('Y-m-d') }}">
                                    @error('deadline_by_requester')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Judul Keluhan <span class="required">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Ringkasan singkat mengenai keluhan Anda"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Deskripsi Keluhan <span class="required">*</span></label>
                                    <textarea name="desc" class="form-control @error('desc') is-invalid @enderror"
                                        placeholder="Jelaskan keluhan Anda secara detail, termasuk kapan masalah terjadi dan dampaknya...">{{ old('desc') }}</textarea>
                                    @error('desc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">File Lampiran <span
                                            class="text-muted fw-normal">(Opsional)</span></label>
                                    <div class="file-upload-area" id="fileUploadArea">
                                        <input type="file" name="file_attachment" id="fileInput"
                                            accept=".pdf,.jpg,.jpeg,.png" onchange="handleFileChange(this)">
                                        <div id="uploadPlaceholder">
                                            <div class="upload-icon">
                                                <i class="mdi mdi-cloud-upload-outline"></i>
                                            </div>
                                            <p class="upload-text">
                                                <strong>Klik untuk upload</strong> atau seret file ke sini
                                            </p>
                                            <p class="upload-text mt-1" style="font-size:12px;">
                                                PDF, JPG, JPEG, PNG — Maks. 5MB
                                            </p>
                                        </div>
                                        <div class="file-info" id="fileInfo">
                                            <i class="mdi mdi-file-outline text-primary" style="font-size:18px;"></i>
                                            <span id="fileName">-</span>
                                            <button type="button" class="ms-auto btn btn-sm btn-link text-danger p-0"
                                                onclick="clearFile()">
                                                <i class="mdi mdi-close-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('file_attachment')
                                        <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-submit-case">
                                <i class="mdi mdi-send me-2"></i> Kirim Keluhan
                            </button>
                        </form>
                    </div>

                    {{-- TRACK TAB --}}
                    <div id="tab-track" class="track-card" style="display:none;">
                        <h5 class="fw-700 mb-2" style="font-size:18px;">Lacak Status Tiket Keluhan</h5>
                        <p class="text-muted mb-4" style="font-size:14px;">
                            Masukkan nomor tiket yang Anda terima setelah mengajukan keluhan untuk melihat status terkini.
                        </p>
                        <form action="{{ route('frontend.cases.track') }}" method="GET">
                            @if ($errors->has('ticket_id'))
                                <div class="alert alert-danger rounded-3 mb-3 py-2 px-3" style="font-size:13px;">
                                    <i class="mdi mdi-alert-circle me-1"></i> {{ $errors->first('ticket_id') }}
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

                </div>

                {{-- RIGHT: Info Panel --}}
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-3">

                        {{-- Kategori Keluhan --}}
                        <div class="form-card p-4">
                            <p class="section-label mb-3">
                                <i class="mdi mdi-tag-multiple-outline me-1"></i> Kategori Keluhan
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
                                <li>Nomor tiket akan diberikan setelah keluhan berhasil dikirim.</li>
                                <li>Simpan nomor tiket untuk melacak status keluhan Anda.</li>
                                <li>Tim kami akan menindaklanjuti keluhan secepatnya.</li>
                                <li>File lampiran maksimal <strong>5MB</strong> (PDF, JPG, PNG).</li>
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
                            <a href="https://wa.me/628115221321" target="_blank"
                                class="btn d-flex align-items-center justify-content-center gap-2 w-100"
                                style="background:#25D366; color:#fff; border-radius:10px; font-weight:600; font-size:14px;">
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
    <script>
        // Tab Switcher
        function switchTab(tab) {
            const formTab = document.getElementById('tab-form');
            const trackTab = document.getElementById('tab-track');
            const formBtn = document.getElementById('tab-form-btn');
            const trackBtn = document.getElementById('tab-track-btn');

            if (tab === 'form') {
                formTab.style.display = 'block';
                trackTab.style.display = 'none';
                formBtn.classList.add('active');
                trackBtn.classList.remove('active');
            } else {
                formTab.style.display = 'none';
                trackTab.style.display = 'block';
                trackBtn.classList.add('active');
                formBtn.classList.remove('active');
            }
        }

        // Otomatis pindah ke tab track jika ada error ticket_id
        @if ($errors->has('ticket_id'))
            switchTab('track');
        @endif

        // Otomatis pindah ke tab form jika ada error form
        @if ($errors->hasAny(['title', 'category', 'unit_name', 'requester_name', 'phone', 'email', 'desc', 'file_attachment']))
            switchTab('form');
        @endif

        // File Upload Handler
        function handleFileChange(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const placeholder = document.getElementById('uploadPlaceholder');
                const fileInfo = document.getElementById('fileInfo');
                const fileName = document.getElementById('fileName');

                placeholder.style.display = 'none';
                fileInfo.classList.add('show');
                fileName.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
            }
        }

        function clearFile() {
            const input = document.getElementById('fileInput');
            const placeholder = document.getElementById('uploadPlaceholder');
            const fileInfo = document.getElementById('fileInfo');

            input.value = '';
            placeholder.style.display = 'block';
            fileInfo.classList.remove('show');
        }

        // Drag & Drop
        const uploadArea = document.getElementById('fileUploadArea');
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const fileInput = document.getElementById('fileInput');
            fileInput.files = e.dataTransfer.files;
            handleFileChange(fileInput);
        });
    </script>
@endpush
