@extends('backend.layouts.app')

@section('title', 'Detail Keluhan #' . $case->id . ' - DISKOMINFOPERSANTIK')

@push('css')
    <style>
        /* Badge Status */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-status.secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .badge-status.info {
            background: #eff6ff;
            color: #2563eb;
        }

        .badge-status.primary {
            background: #eef2ff;
            color: #4f46e5;
        }

        .badge-status.warning {
            background: #fffbeb;
            color: #d97706;
        }

        .badge-status.success {
            background: #f0fdf4;
            color: #16a34a;
        }

        .badge-status.danger {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Section Label */
        .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #4f46e5;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f5f9;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .info-item label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            display: block;
            margin-bottom: 4px;
        }

        .info-item .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        .info-item .info-value.muted {
            color: #94a3b8;
            font-weight: 400;
            font-style: italic;
        }

        /* Description Box */
        .desc-box {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px 18px;
            font-size: 14px;
            color: #374151;
            line-height: 1.7;
            white-space: pre-wrap;
            word-break: break-word;
            min-height: 80px;
        }

        /* Attachment */
        .attachment-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .attachment-box:hover {
            border-color: #4f46e5;
            background: #eef2ff;
        }

        .attachment-box .attach-icon {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .attachment-box .attach-icon i {
            color: #fff;
            font-size: 17px;
        }

        .attachment-box .attach-name {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            flex: 1;
        }

        .attachment-box .attach-hint {
            font-size: 11px;
            color: #94a3b8;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 28px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 18px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-item .tl-dot {
            position: absolute;
            left: -24px;
            top: 4px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 2.5px solid #fff;
            box-shadow: 0 0 0 2px currentColor;
            background: currentColor;
        }

        .timeline-item.secondary .tl-dot {
            color: #94a3b8;
        }

        .timeline-item.info .tl-dot {
            color: #2563eb;
        }

        .timeline-item.primary .tl-dot {
            color: #4f46e5;
        }

        .timeline-item.warning .tl-dot {
            color: #d97706;
        }

        .timeline-item.success .tl-dot {
            color: #16a34a;
        }

        .timeline-item.danger .tl-dot {
            color: #dc2626;
        }

        .timeline-item .tl-content {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
        }

        .timeline-item.success .tl-content {
            background: #f0fdf4;
            border-color: #86efac;
        }

        .timeline-item .tl-status {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 2px;
        }

        .timeline-item .tl-time {
            font-size: 12px;
            color: #94a3b8;
        }

        /* Update Status Card */
        .status-update-card {
            background: linear-gradient(135deg, #f8faff, #eef2ff);
            border: 1.5px solid #c7d2fe;
            border-radius: 14px;
            padding: 22px;
        }

        .status-update-card .form-select {
            border: 1.5px solid #c7d2fe;
            border-radius: 10px;
            font-size: 14px;
            padding: 10px 14px;
            color: #1e293b;
            background-color: #fff;
        }

        .status-update-card .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 03px rgba(79, 70, 229, 0.12);
            outline: none;
        }

        .btn-update-status {
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 700;
            font-size: 14px;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-update-status:hover {
            background: #3730a3;
            color: #fff;
            transform: translateY(-1px);
        }

        /* Ticket ID Box */
        .ticket-id-box {
            background: linear-gradient(135deg, #4f46e5, #1a56a8);
            border-radius: 14px;
            padding: 22px;
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

        .ticket-id-box .label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.8;
            margin-bottom: 6px;
        }

        .ticket-id-box .number {
            font-size: 38px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -1px;
        }

        .ticket-id-box .date {
            font-size: 12px;
            opacity: 0.75;
            margin-top: 6px;
        }

        @media (max-width: 576px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- Page Header --}}
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h4 class="mb-1 fw-bold">Detail Keluhan</h4>
                <p class="text-muted mb-0" style="font-size:13px;">
                    Informasi lengkap tiket keluhan #{{ $case->id }}
                </p>
            </div>
            <a href="{{ route('cases.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3" role="alert">
            <i class="ti ti-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show rounded-3 mb-3" role="alert">
            <i class="ti ti-alert-triangle me-2"></i> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- LEFT: Detail Keluhan --}}
        <div class="col-lg-8">

            {{-- Ticket Header --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                        <div>
                            <div class="text-muted mb-1"
                                style="font-size:12px; font-weight:700;
                            letter-spacing:1px; text-transform:uppercase;">
                                <i class="ti ti-ticket me-1"></i> Tiket #{{ $case->id }}
                            </div>
                            <h5 class="fw-bold mb-2" style="color:#1e293b;">{{ $case->title }}</h5>
                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                @php
                                    $currentStatus = $statuses->get($case->status);
                                    $badgeClass = $currentStatus ? $currentStatus->value2 : 'secondary';
                                    $statusLabel = $currentStatus ? $currentStatus->label : $case->status;
                                @endphp
                                <span class="badge-status {{ $badgeClass }}">
                                    <i class="ti ti-circle-filled" style="font-size:6px;"></i>
                                    {{ $statusLabel }}
                                </span>
                                <span class="text-muted" style="font-size:13px;">
                                    <i class="ti ti-tag me-1"></i>
                                    {{ $category ? $category->label : $case->category }}
                                </span>
                                <span class="text-muted" style="font-size:13px;">
                                    <i class="ti ti-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($case->created_at)->translatedFormat('d F Y, H:i') }} WIB
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Pelapor --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <p class="section-label">
                        <i class="ti ti-user me-1"></i> Data Pelapor
                    </p>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Nama Lengkap</label>
                            <div class="info-value">{{ $case->requester_name }}</div>
                        </div>
                        <div class="info-item">
                            <label>NIP</label>
                            <div class="info-value {{ !$case->nip ? 'muted' : '' }}">
                                {{ $case->nip ?? 'Tidak diisi' }}
                            </div>
                        </div>
                        <div class="info-item">
                            <label>Unit / Instansi</label>
                            <div class="info-value">{{ $case->unit_name }}</div>
                        </div>
                        <div class="info-item">
                            <label>Nomor Telepon</label>
                            <div class="info-value">
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $case->phone) }}" target="_blank"
                                    class="text-decoration-none" style="color:inherit;">
                                    {{ $case->phone }}
                                    <i class="ti ti-brand-whatsapp text-success ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="info-item" style="grid-column: 1 / -1;">
                            <label>Email</label>
                            <div class="info-value">
                                <a href="mailto:{{ $case->email }}" class="text-decoration-none" style="color:inherit;">
                                    {{ $case->email }}
                                    <i class="ti ti-mail text-primary ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Keluhan --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <p class="section-label">
                        <i class="ti ti-clipboard-text me-1"></i> Detail Keluhan
                    </p>
                    <div class="info-grid mb-4">
                        <div class="info-item">
                            <label>Kategori</label>
                            <div class="info-value">
                                {{ $category ? $category->label : $case->category }}
                            </div>
                        </div>
                        <div class="info-item">
                            <label>Batas Waktu yang Diharapkan</label>
                            <div class="info-value {{ !$case->deadline_by_requester ? 'muted' : '' }}">
                                @if ($case->deadline_by_requester)
                                    {{ \Carbon\Carbon::parse($case->deadline_by_requester)->translatedFormat('d F Y') }}
                                @else
                                    Tidak ditentukan
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="info-item mb-2">
                            <label>Deskripsi Keluhan</label>
                        </div>
                        <div class="desc-box">{{ $case->desc }}</div>
                    </div>
                </div>
            </div>

            {{-- File Lampiran --}}
            @if ($case->file_attachment)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <p class="section-label">
                            <i class="ti ti-paperclip me-1"></i> File Lampiran
                        </p>
                        <a href="{{ asset('storage/' . $case->file_attachment) }}" target="_blank" class="attachment-box">
                            @php
                                $ext = strtolower(pathinfo($case->file_attachment, PATHINFO_EXTENSION));
                                $icon = in_array($ext, ['jpg', 'jpeg', 'png']) ? 'ti-photo' : 'ti-file-type-pdf';
                            @endphp
                            <div class="attach-icon">
                                <i class="ti {{ $icon }}"></i>
                            </div>
                            <div>
                                <div class="attach-name">
                                    {{ basename($case->file_attachment) }}
                                </div>
                                <div class="attach-hint">Klik untuk membuka file lampiran</div>
                            </div>
                            <i class="ti ti-external-link ms-2 text-primary" style="font-size:17px; flex-shrink:0;"></i>
                        </a>
                    </div>
                </div>
            @endif

        </div>

        {{-- RIGHT: Sidebar --}}
        <div class="col-lg-4">
            <div class="d-flex flex-column gap-4">

                {{-- Ticket ID Box --}}
                <div class="ticket-id-box">
                    <div class="label">Nomor Tiket</div>
                    <div class="number">#{{ $case->id }}</div>
                    <div class="date">
                        <i class="ti ti-calendar me-1"></i>
                        {{ \Carbon\Carbon::parse($case->created_at)->translatedFormat('d F Y') }}
                    </div>
                </div>

                {{-- Update Status --}}
                <div class="status-update-card">
                    <p class="section-label mb-3">
                        <i class="ti ti-settings me-1"></i> Update Status Keluhan
                    </p>
                    <form action="{{ route('cases.update', $case->id) }}" method="POST" id="formUpdateStatus">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:13px;">
                                Status Saat Ini
                            </label>
                            <div class="mb-2">
                                <span class="badge-status {{ $badgeClass }}">
                                    <i class="ti ti-circle-filled" style="font-size:6px;"></i>
                                    {{ $statusLabel }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:13px;">
                                Ubah Status ke
                            </label>
                            <select name="status" class="form-select" id="selectStatus" required>
                                <option value="" disabled selected>-- Pilih Status Baru --</option>
                                @foreach ($statuses as $key => $status)
                                    <option value="{{ $status->value }}"
                                        {{ $case->status === $status->value ? 'disabled' : '' }}>
                                        {{ $status->label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-update-status" id="btnUpdateStatus">
                            <i class="ti ti-device-floppy me-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                {{-- Riwayat Status --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <p class="section-label">
                            <i class="ti ti-history me-1"></i> Riwayat Status
                        </p>

                        @if ($case->histories->count() > 0)
                            <div class="timeline">
                                @foreach ($case->histories->sortByDesc('id') as $history)
                                    @php
                                        $histStatus = $statuses->get($history->status);
                                        $histClass = $histStatus ? $histStatus->value2 : 'secondary';
                                        $histLabel = $histStatus ? $histStatus->label : $history->status;
                                    @endphp
                                    <div class="timeline-item {{ $histClass }}">
                                        <div class="tl-dot"></div>
                                        <div class="tl-content">
                                            <div class="tl-status">{{ $histLabel }}</div>
                                            @if (isset($history->created_at))
                                                <div class="tl-time">
                                                    <i class="ti ti-clock me-1"></i>
                                                    {{ \Carbon\Carbon::parse($history->created_at)->translatedFormat('d F Y, H:i') }}
                                                    WIB
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="ti ti-clock text-muted" style="font-size:32px;"></i>
                                <p class="text-muted mt-2 mb-0" style="font-size:13px;">
                                    Belum ada riwayat status.
                                </p>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Kontak Pelapor --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <p class="section-label">
                            <i class="ti ti-headset me-1"></i> Hubungi Pelapor
                        </p>
                        <div class="d-flex flex-column gap-2">
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $case->phone) }}?text=Halo%20{{ urlencode($case->requester_name) }},%20kami%20dari%20DISKOMINFOPERSANTIK%20ingin%20menghubungi%20Anda%20terkait%20tiket%20keluhan%20%23{{ $case->id }}"
                                target="_blank" class="btn btn-sm d-flex align-items-center justify-content-center gap-2"
                                style="background:#25D366; color:#fff; border-radius:8px;
                                   font-weight:600; font-size:13px;">
                                <i class="ti ti-brand-whatsapp" style="font-size:16px;"></i>
                                WhatsApp Pelapor
                            </a>
                            <a href="mailto:{{ $case->email }}"
                                class="btn btn-sm btn-outline-primary d-flex align-items-center
                                   justify-content-center gap-2"
                                style="border-radius:8px; font-weight:600; font-size:13px;">
                                <i class="ti ti-mail" style="font-size:16px;"></i>
                                Kirim Email
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
        $(document).ready(function() {

            // Konfirmasi SweetAlert sebelum update status
            $('#btnUpdateStatus').on('click', function() {
                const select = document.getElementById('selectStatus');
                const statusVal = select.value;
                const statusTxt = select.options[select.selectedIndex]?.text;

                if (!statusVal) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilih Status',
                        text: 'Silakan pilih status baru terlebih dahulu.',
                        confirmButtonColor: '#4f46e5',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Update Status?',
                    html: `Status keluhan <strong>#{{ $case->id }}</strong> akan diubah menjadi <strong>${statusTxt}</strong>.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Update!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('formUpdateStatus').submit();
                    }
                });
            });

        });
    </script>
@endpush
