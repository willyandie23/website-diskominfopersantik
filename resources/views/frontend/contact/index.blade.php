@extends('frontend.layouts.app')
@section('title')
    Hubungi Kami - DISKOMINFOSANTIK
@endsection
@push('css')
    <style>
        .contact-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .section-title h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 8px;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #007bff;
            border-radius: 2px;
        }

        .section-title p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .contact-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            padding: 36px;
            height: 100%;
        }

        .map-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .map-card iframe {
            flex: 1;
            min-height: 380px;
            border: none;
            width: 100%;
        }

        .map-info {
            padding: 20px 24px;
            border-top: 1px solid #e9ecef;
        }

        .map-info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 0.88rem;
            color: #495057;
        }

        .map-info-item:last-child {
            margin-bottom: 0;
        }

        .map-info-item i {
            color: #007bff;
            margin-top: 2px;
            flex-shrink: 0;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.875rem;
            color: #495057;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            font-size: 0.9rem;
            padding: 10px 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .btn-submit {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            padding: 12px 32px;
            font-size: 0.95rem;
            width: 100%;
            transition: background-color 0.2s, transform 0.1s;
        }

        .btn-submit:hover {
            background-color: #0056b3;
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .alert-success {
            border-radius: 10px;
            font-size: 0.9rem;
        }

        @media (max-width: 767px) {
            .map-card {
                margin-top: 24px;
            }

            .contact-card {
                padding: 24px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="page-content bg-white">
        <div class="contact-section">
            <div class="container">
                <div class="section-title mb-3">
                    <h2>Hubungi Kami</h2>
                    <p>Silakan kirimkan pertanyaan, saran, atau laporan Anda kepada kami.</p>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row g-4">
                    {{-- KOLOM KIRI — Form Kontak --}}
                    <div class="col-lg-6">
                        <div class="contact-card">
                            <h5 class="fw-bold mb-1">Kirim Pesan</h5>
                            <p class="text-muted small mb-4">Isi formulir di bawah ini dan kami akan merespons secepatnya.
                            </p>
                            <form action="{{ route('frontend.contact.store') }}" method="POST" id="contactForm">
                                @csrf
                                {{-- Nama --}}
                                <div class="mb-3">
                                    <label for="nama" class="form-label">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="nama" id="nama"
                                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                        placeholder="Masukkan nama lengkap Anda" autocomplete="off">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Email / No. HP --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        Email / No. HP (WhatsApp) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="contoh@email.com atau 08123456789"
                                        autocomplete="off">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Bisa diisi dengan alamat email atau nomor WhatsApp.
                                    </div>
                                </div>
                                {{-- Subjek --}}
                                <div class="mb-3">
                                    <label for="subjek" class="form-label">
                                        Subjek <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="subjek" id="subjek"
                                        class="form-control @error('subjek') is-invalid @enderror"
                                        value="{{ old('subjek') }}" placeholder="Topik pesan Anda">
                                    @error('subjek')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Isi Pesan --}}
                                <div class="mb-4">
                                    <label for="isi" class="form-label">
                                        Isi Pesan <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="isi" id="isi" rows="5" class="form-control @error('isi') is-invalid @enderror"
                                        placeholder="Tuliskan pesan Anda di sini...">{{ old('isi') }}</textarea>
                                    @error('isi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Submit --}}
                                <button type="submit" class="btn-submit" id="btnSubmit">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- KOLOM KANAN — Peta & Info --}}
                    <div class="col-lg-6">
                        <div class="map-card">
                            <iframe src="{{ $mapUrl ?? 'https://maps.app.goo.gl/jms4AZNAUee61dwp6' }}" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi DISKOMINFOSANTIK">
                            </iframe>
                            <div class="map-info">
                                <h6 class="fw-bold mb-3">Informasi Kantor</h6>
                                <div class="map-info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <strong class="fw-bold">Alamat</strong><br>
                                        {{ $address ?? 'Daerah Perkantoran Kereng Humbang, Kasongan, Katingan Hilir' }}
                                    </div>
                                </div>
                                <div class="map-info-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <div>
                                        <strong class="fw-bold">Telepon</strong><br>
                                        {{ $phone ?? '(+62) 000-0000' }}
                                    </div>
                                </div>
                                <div class="map-info-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <strong class="fw-bold">Email</strong><br>
                                        {{ $mail ?? 'info@diskominfopersantik.go.id' }}
                                    </div>
                                </div>
                                <div class="map-info-item">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong class="fw-bold">Jam Operasional</strong><br>
                                        Senin – Kamis: 07.30 – 16.00 WIB | Jumat: 07.30 – 16:30 WIB
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.getElementById('contactForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...';
        });
    </script>
@endpush
