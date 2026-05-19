@extends('frontend.layouts.app')

@section('title')
    Tiket #{{ $case->id }} - Keluhan DISKOMINFOSANTIK
@endsection

@push('css')
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

        /* Ticket Header */
        .ticket-header {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            padding: 28px 32px;
            margin-bottom: 24px;
        }

        .ticket-number {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #94a3b8;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .ticket-title {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .ticket-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
        }

        .ticket-meta .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #64748b;
        }

        .ticket-meta .meta-item i {
            font-size: 15px;
            color: var(--primary);
        }

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

        /* Card */
        .detail-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            padding: 28px;
            margin-bottom: 24px;
        }

        .detail-card .card-section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f5f9;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .info-grid.full {
            grid-template-columns: 1fr;
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
            border-color: var(--primary);
            background: #eff6ff;
        }

        .attachment-box .attach-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .attachment-box .attach-icon i {
            color: #fff;
            font-size: 18px;
        }

        .attachment-box .attach-name {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
        }

        .attachment-box .attach-hint {
            font-size: 12px;
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
            margin-bottom: 24px;
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
            padding: 12px 16px;
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

        /* Ticket ID Box */
        .ticket-id-box {
            background: linear-gradient(135deg, var(--primary), #1a56a8);
            border-radius: 14px;
            padding: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
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
            font-size: 42px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -1px;
        }

        .ticket-id-box .hint {
            font-size: 12px;
            opacity: 0.75;
            margin-top: 6px;
        }

        /* Alert success */
        .alert-success-custom {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #86efac;
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 24px;
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

        /* Action Buttons */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #f1f5f9;
            color: #475569;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }

        .btn-back:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--primary);
            color: #fff;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }

        .btn-new:hover {
            background: var(--primary-dark, #003580);
            color: #fff;
        }

        @media (max-width: 576px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .ticket-title {
                font-size: 18px;
            }

            .ticket-id-box .number {
                font-size: 32px;
            }
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
                        <h1 class="mb-2">Detail Tiket Keluhan</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb dz-breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('main.index') }}">Beranda</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('frontend.cases.index') }}">Keluhan</a>
                                </li>
                                <li class="breadcrumb-item active">Tiket #{{ $case->id }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-5">

            {{-- Success Alert --}}
            @if (session('success'))
                <div class="alert-success-custom">
                    <div class="alert-icon">
                        <i class="mdi mdi-check-circle"></i>
                    </div>
                    <div class="alert-content">
                        <strong>Keluhan Berhasil Dikirim!</strong>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="row g-4">

                {{-- LEFT: Detail Keluhan --}}
                <div class="col-lg-8">

                    {{-- Ticket Header --}}
                    <div class="ticket-header">
                        <div class="ticket-number">
                            <i class="mdi mdi-ticket-outline me-1"></i> Tiket #{{ $case->id }}
                        </div>
                        <div class="ticket-title">{{ $case->title }}</div>
                        <div class="ticket-meta">
                            {{-- Status Badge --}}
                            @php
                                $currentStatus = $statuses->get($case->status);
                                $badgeClass = $currentStatus ? $currentStatus->value2 : 'secondary';
                                $statusLabel = $currentStatus ? $currentStatus->label : $case->status;
                            @endphp
                            <span class="badge-status {{ $badgeClass }}">
                                <i class="mdi mdi-circle" style="font-size:8px;"></i>
                                {{ $statusLabel }}
                            </span>

                            {{-- Kategori --}}
                            <div class="meta-item">
                                <i class="mdi mdi-tag-outline"></i>
                                <span>{{ $category ? $category->label : $case->category }}</span>
                            </div>

                            {{-- Tanggal --}}
                            <div class="meta-item">
                                <i class="mdi mdi-calendar-outline"></i>
                                <span>{{ \Carbon\Carbon::parse($case->created_at)->translatedFormat('d F Y, H:i') }}
                                    WIB</span>
                            </div>
                        </div>
                    </div>

                    {{-- Data Pelapor --}}
                    <div class="detail-card">
                        <p class="card-section-label">
                            <i class="mdi mdi-account-outline me-1"></i> Data Pelapor
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
                                <div class="info-value">{{ $case->phone }}</div>
                            </div>
                            <div class="info-item" style="grid-column: 1 / -1;">
                                <label>Email</label>
                                <div class="info-value">{{ $case->email }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Detail Keluhan --}}
                    <div class="detail-card">
                        <p class="card-section-label">
                            <i class="mdi mdi-clipboard-text-outline me-1"></i> Detail Keluhan
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

                        <div class="mb-4">
                            <label class="info-item">
                                <label>Deskripsi Keluhan</label>
                            </label>
                            <div class="desc-box">{{ $case->desc }}</div>
                        </div>

                        {{-- File Lampiran --}}
                        @if ($case->file_attachment)
                            <div>
                                <div class="info-item mb-2">
                                    <label>File Lampiran</label>
                                </div>
                                <a href="{{ asset('storage/' . $case->file_attachment) }}" target="_blank"
                                    class="attachment-box">
                                    <div class="attach-icon">
                                        @php
                                            $ext = pathinfo($case->file_attachment, PATHINFO_EXTENSION);
                                            $icon = in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])
                                                ? 'mdi-file-image-outline'
                                                : 'mdi-file-pdf-box';
                                        @endphp
                                        <i class="mdi {{ $icon }}"></i>
                                    </div>
                                    <div>
                                        <div class="attach-name">
                                            {{ basename($case->file_attachment) }}
                                        </div>
                                        <div class="attach-hint">Klik untuk membuka file lampiran</div>
                                    </div>
                                    <i class="mdi mdi-open-in-new ms-auto text-primary" style="font-size:18px;"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('frontend.cases.index') }}" class="btn-back">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('frontend.cases.index') }}" class="btn-new">
                            <i class="mdi mdi-pencil-plus-outline"></i> Ajukan Keluhan Baru
                        </a>
                    </div>

                </div>

                {{-- RIGHT: Sidebar --}}
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-4">

                        {{-- Ticket ID Box --}}
                        <div class="ticket-id-box">
                            <div class="label">Nomor Tiket Anda</div>
                            <div class="number">#{{ $case->id }}</div>
                            <div class="hint">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Simpan nomor ini untuk melacak status keluhan
                            </div>
                        </div>

                        {{-- Riwayat Status --}}
                        <div class="detail-card mb-0">
                            <p class="card-section-label">
                                <i class="mdi mdi-history me-1"></i> Riwayat Status
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
                                                        <i class="mdi mdi-clock-outline me-1"></i>
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
                                    <i class="mdi mdi-clock-outline text-muted" style="font-size:32px;"></i>
                                    <p class="text-muted mt-2 mb-0" style="font-size:13px;">
                                        Belum ada riwayat status.
                                    </p>
                                </div>
                            @endif
                        </div>

                        {{-- Info Box --}}
                        <div
                            style="background:linear-gradient(135deg,#eff6ff,#dbeafe);border:1px solid #bfdbfe;border-radius:12px;padding:20px;">
                            <p style="font-weight:700;color:#1d4ed8;font-size:14px;margin-bottom:10px;">
                                <i class="mdi mdi-information-outline me-1"></i> Informasi
                            </p>
                            <ul style="margin:0;padding-left:18px;">
                                <li style="font-size:13px;color:#1e40af;margin-bottom:4px;">
                                    Tim kami akan segera menindaklanjuti keluhan Anda.
                                </li>
                                <li style="font-size:13px;color:#1e40af;margin-bottom:4px;">
                                    Pantau status keluhan secara berkala menggunakan nomor tiket.
                                </li>
                                <li style="font-size:13px;color:#1e40af;">
                                    Hubungi kami via WhatsApp jika membutuhkan informasi lebih lanjut.
                                </li>
                            </ul>
                        </div>

                        {{-- Kontak WhatsApp --}}
                        <a href="https://wa.me/628115221321?text=Halo,%20saya%20ingin%20menanyakan%20status%20tiket%20keluhan%20%23{{ $case->id }}"
                            target="_blank" class="btn d-flex align-items-center justify-content-center gap-2"
                            style="background:#25D366;color:#fff;border-radius:10px;padding:12px;font-weight:600;font-size:14px;text-decoration:none;">
                            <i class="fab fa-whatsapp" style="font-size:20px;"></i>
                            Tanya via WhatsApp
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Set locale Carbon ke Indonesia
        moment && moment.locale('id');
    </script>
@endpush
