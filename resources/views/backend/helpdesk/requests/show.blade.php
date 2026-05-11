@extends('backend.layouts.app')
@section('title', 'Detail Pengajuan #' . $requestData->id . ' - DISKOMINFOPERSANTIK')

@push('css')
    <style>
        /* Detail Card */
        .detail-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
        }

        .detail-card-header {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            padding: 20px 24px;
        }

        .detail-card-header .ticket-id {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .detail-card-header .ticket-date {
            font-size: 12px;
            opacity: 0.85;
        }

        .detail-card-body {
            padding: 24px;
        }

        /* Section Title */
        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: #4f46e5;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #eef2ff;
        }

        /* Info Row */
        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 180px;
            flex-shrink: 0;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        .info-value {
            font-size: 13px;
            color: #1e293b;
            flex: 1;
        }

        /* Badge Status */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
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

        /* Sidebar Card */
        .sidebar-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
            padding: 20px;
            margin-bottom: 16px;
        }

        .sidebar-card-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
        }

        /* Timeline */
        .timeline-item {
            position: relative;
            padding-left: 24px;
            padding-bottom: 20px;
            border-left: 2px solid #e2e8f0;
        }

        .timeline-item:last-child {
            border-left-color: transparent;
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 2px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #4f46e5;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #e2e8f0;
        }

        .timeline-item:first-child::before {
            background: #16a34a;
            box-shadow: 0 0 0 2px #bbf7d0;
        }

        .timeline-status {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
        }

        .timeline-date {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* Attachment */
        .attachment-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: all 0.2s;
        }

        .attachment-item:hover {
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .attachment-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #eef2ff;
            color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .attachment-name {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
        }

        .attachment-meta {
            font-size: 11px;
            color: #94a3b8;
        }

        /* Contact Button */
        .contact-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            text-decoration: none;
            transition: all 0.2s;
            width: 100%;
            margin-bottom: 8px;
        }

        .contact-btn:hover {
            border-color: #4f46e5;
            color: #4f46e5;
            background: #eef2ff;
        }

        .contact-btn .contact-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }
    </style>
@endpush

@section('content')
    {{-- Page Header --}}
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <a href="{{ route('requests.index') }}" class="text-muted text-decoration-none" style="font-size:13px;">
                    <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Pengajuan
                </a>
                <h4 class="mb-0 mt-2 fw-bold">Detail Pengajuan</h4>
            </div>
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

    {{-- MAIN CONTENT --}}
    <div class="row g-4">
        {{-- LEFT COLUMN --}}
        <div class="col-lg-8">
            {{-- Detail Card --}}
            <div class="detail-card mb-4">
                <div class="detail-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <div class="ticket-id">Pengajuan #{{ $requestData->id }}</div>
                        <div class="ticket-date">
                            <i class="ti ti-calendar me-1"></i>
                            Dibuat pada
                            {{ \Carbon\Carbon::parse($requestData->created_at)->translatedFormat('d F Y, H:i') }} WIB
                        </div>
                    </div>
                    @php
                        $currentStatus = $statuses->get($requestData->status);
                        $badgeCls = $currentStatus ? $currentStatus->value2 : 'secondary';
                        $statusLabel = $currentStatus ? $currentStatus->label : $requestData->status;
                    @endphp
                    <span class="badge-status {{ $badgeCls }}" style="font-size:13px; padding:6px 16px;">
                        <i class="ti ti-circle-filled" style="font-size:7px;"></i>
                        {{ $statusLabel }}
                    </span>
                </div>

                <div class="detail-card-body">
                    {{-- Data Pemohon --}}
                    <!-- SECTION: REQUESTER DATA -->
                    <div class="section-title">
                        <i class="ti ti-user me-1"></i> Data Pemohon
                    </div>
                    <div class="info-row">
                        <div class="info-label">Nama Pemohon</div>
                        <div class="info-value">{{ $requestData->requester_name }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">NIP</div>
                        <div class="info-value">{{ $requestData->nip ?? '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Unit / OPD</div>
                        <div class="info-value">{{ $requestData->unit_name ?? '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">No. WhatsApp</div>
                        <div class="info-value">{{ $requestData->phone ?? '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $requestData->email ?? '-' }}</div>
                    </div>

                    <div class="my-4"></div>

                    {{-- Detail Pengajuan --}}
                    <!-- SECTION: REQUEST DETAIL -->
                    <div class="section-title">
                        <i class="ti ti-file-text me-1"></i> Detail Pengajuan
                    </div>
                    <div class="info-row">
                        <div class="info-label">Judul</div>
                        <div class="info-value fw-semibold">{{ $requestData->title }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Kategori</div>
                        <div class="info-value">{{ $category ? $category->label : $requestData->category }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Deskripsi</div>
                        <div class="info-value">{!! nl2br(e($requestData->desc)) !!}</div>
                    </div>

                    <div class="my-4"></div>

                    {{-- Lampiran --}}
                    <!-- SECTION: ATTACHMENTS -->
                    <div class="section-title">
                        <i class="ti ti-paperclip me-1"></i> Lampiran
                    </div>
                    @php
                        $attachments = collect([
                            ['label' => 'Surat Pengantar', 'file' => $requestData->file_surat_pengantar],
                            ['label' => 'Lampiran Tambahan 1', 'file' => $requestData->file_addition1],
                            ['label' => 'Lampiran Tambahan 2', 'file' => $requestData->file_addition2],
                            ['label' => 'Lampiran Tambahan 3', 'file' => $requestData->file_addition3],
                        ])->filter(fn($a) => !empty($a['file']));
                    @endphp

                    @if ($attachments->isNotEmpty())
                        @foreach ($attachments as $att)
                            <div class="attachment-item">
                                <div class="attachment-icon">
                                    <i class="ti ti-file-description"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="attachment-name">{{ $att['label'] }}</div>
                                    <div class="attachment-meta">{{ basename($att['file']) }}</div>
                                </div>
                                <a href="{{ asset('storage/' . $att['file']) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary" style="border-radius:8px; font-size:12px;">
                                    <i class="ti ti-download me-1"></i> Unduh
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="ti ti-file-off text-muted" style="font-size:32px;"></i>
                            <p class="text-muted mt-2 mb-0" style="font-size:13px;">Tidak ada lampiran.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN / SIDEBAR --}}
        <div class="col-lg-4">
            <!-- SIDEBAR: TICKET ID BOX -->
            <div class="sidebar-card text-center">
                <div
                    style="font-size:12px; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">
                    Nomor Tiket</div>
                <div style="font-size:28px; font-weight:800; color:#4f46e5; margin-top:4px;">#{{ $requestData->id }}</div>
                <div style="font-size:12px; color:#94a3b8; margin-top:4px;">
                    {{ \Carbon\Carbon::parse($requestData->created_at)->translatedFormat('d F Y') }}
                </div>
            </div>

            <!-- SIDEBAR: UPDATE STATUS -->
            <div class="sidebar-card">
                <div class="sidebar-card-title">
                    <i class="ti ti-refresh me-1"></i> Update Status
                </div>
                <form action="{{ route('requests.update', $requestData->id) }}" method="POST" id="formUpdateStatus">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <select name="status" id="statusSelect" class="form-select"
                            style="border-radius:8px; font-size:13px;">
                            @foreach ($statuses as $key => $status)
                                <option value="{{ $status->value }}"
                                    {{ $requestData->status === $status->value ? 'selected' : '' }}>
                                    {{ $status->label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-primary w-100" id="btnUpdateStatus"
                        style="border-radius:8px; font-size:13px;">
                        <i class="ti ti-check me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>

            <!-- SIDEBAR: STATUS HISTORY -->
            <div class="sidebar-card">
                <div class="sidebar-card-title">
                    <i class="ti ti-history me-1"></i> Riwayat Status
                </div>
                @if ($requestData->histories->isNotEmpty())
                    <div class="ps-2">
                        @foreach ($requestData->histories->sortByDesc('created_at') as $history)
                            @php
                                $hStatus = $statuses->get($history->status);
                                $hLabel = $hStatus ? $hStatus->label : $history->status;
                                $hBadge = $hStatus ? $hStatus->value2 : 'secondary';
                            @endphp
                            <div class="timeline-item">
                                <div class="timeline-status">
                                    <span class="badge-status {{ $hBadge }}">
                                        <i class="ti ti-circle-filled" style="font-size:5px;"></i>
                                        {{ $hLabel }}
                                    </span>
                                </div>
                                <div class="timeline-date">
                                    {{ \Carbon\Carbon::parse($history->created_at)->translatedFormat('d M Y, H:i') }} WIB
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-3">
                        <p class="text-muted mb-0" style="font-size:13px;">Belum ada riwayat.</p>
                    </div>
                @endif
            </div>

            <!-- SIDEBAR: CONTACT REPORTER -->
            <div class="sidebar-card">
                <div class="sidebar-card-title">
                    <i class="ti ti-address-book me-1"></i> Hubungi Pemohon
                </div>
                @if ($requestData->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $requestData->phone) }}" target="_blank"
                        class="contact-btn">
                        <div class="contact-icon" style="background:#f0fdf4; color:#16a34a;">
                            <i class="ti ti-brand-whatsapp"></i>
                        </div>
                        <div>
                            <div style="font-size:13px; font-weight:600;">WhatsApp</div>
                            <div style="font-size:11px; color:#94a3b8;">{{ $requestData->phone }}</div>
                        </div>
                    </a>
                @endif
                @if ($requestData->email)
                    <a href="mailto:{{ $requestData->email }}" class="contact-btn">
                        <div class="contact-icon" style="background:#eff6ff; color:#2563eb;">
                            <i class="ti ti-mail"></i>
                        </div>
                        <div>
                            <div style="font-size:13px; font-weight:600;">Email</div>
                            <div style="font-size:11px; color:#94a3b8;">{{ $requestData->email }}</div>
                        </div>
                    </a>
                @endif
                @if (!$requestData->phone && !$requestData->email)
                    <div class="text-center py-3">
                        <p class="text-muted mb-0" style="font-size:13px;">Tidak ada kontak tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Tooltip
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
                .forEach(el => new bootstrap.Tooltip(el));

            // Update Status dengan SweetAlert2
            $('#btnUpdateStatus').on('click', function() {
                const selectedStatus = $('#statusSelect option:selected').text().trim();

                Swal.fire({
                    title: 'Update Status?',
                    html: `Status pengajuan akan diubah menjadi <strong>${selectedStatus}</strong>.`,
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
