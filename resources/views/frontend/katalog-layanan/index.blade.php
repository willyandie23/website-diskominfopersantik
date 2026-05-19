{{-- resources/views/frontend/jajak-pendapat/index.blade.php --}}
@extends('frontend.layouts.app')
@section('title', 'Katalog Layanan - DISKOMINFOSANTIK')
@push('css')
    <style>
        /* Hero Section */
        .katalog-hero {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
            padding: 80px 0 100px;
            position: relative;
            overflow: hidden;
        }

        .katalog-hero::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -15%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.07) 0%, transparent 70%);
            border-radius: 50%;
        }

        .katalog-hero::after {
            content: '';
            position: absolute;
            bottom: -40%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.04) 0%, transparent 70%);
            border-radius: 50%;
        }

        .katalog-hero .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .katalog-hero .heading-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 30px;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .katalog-hero h2 {
            font-size: 2.4rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        .katalog-hero p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.05rem;
            max-width: 620px;
            margin: 0 auto 30px;
            line-height: 1.7;
        }

        /* Search Box */
        .search-box {
            max-width: 480px;
            margin: 0 auto;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 16px 24px 16px 50px;
            border-radius: 50px;
            border: 2px solid rgba(255, 255, 255, 0.25);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-box input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .search-box .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
        }

        /* Stats Strip */
        .stats-strip {
            background: #fff;
            margin-top: -40px;
            position: relative;
            z-index: 2;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 24px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-item .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e3a8a;
            line-height: 1;
        }

        .stat-item .stat-label {
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 600;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Katalog Section */
        .katalog-section {
            padding: 80px 0 60px;
            background: #f8fafc;
        }

        /* Card Grid */
        .katalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .katalog-card {
            cursor: pointer;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            background: #fff;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            padding: 28px;
            display: flex;
            flex-direction: column;
        }

        .katalog-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1e3a8a, #2563eb, #3b82f6);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .katalog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(30, 58, 138, 0.12);
            border-color: #bfdbfe;
        }

        .katalog-card:hover::before {
            opacity: 1;
        }

        .katalog-card .card-icon-wrapper {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            transition: all 0.3s ease;
        }

        .katalog-card:hover .card-icon-wrapper {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            transform: scale(1.05);
        }

        .katalog-card .card-icon-wrapper i {
            color: #2563eb;
            font-size: 1.4rem;
            transition: color 0.3s ease;
        }

        .katalog-card:hover .card-icon-wrapper i {
            color: #fff;
        }

        .katalog-card .card-number {
            position: absolute;
            top: 16px;
            right: 20px;
            font-size: 2.5rem;
            font-weight: 900;
            color: #f1f5f9;
            line-height: 1;
            transition: color 0.3s ease;
        }

        .katalog-card:hover .card-number {
            color: #e0ecff;
        }

        .katalog-card .card-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .katalog-card .card-desc {
            font-size: 0.85rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 16px;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .katalog-card .card-footer-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
        }

        .katalog-card .card-link {
            font-size: 0.82rem;
            font-weight: 700;
            color: #2563eb;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: gap 0.3s ease;
        }

        .katalog-card:hover .card-link {
            gap: 10px;
        }

        .katalog-card .card-badges {
            display: flex;
            gap: 6px;
        }

        .katalog-card .card-badge {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .katalog-card .card-badge i {
            font-size: 0.65rem;
            color: #64748b;
        }

        /* No results */
        .no-results {
            display: none;
            text-align: center;
            padding: 60px 20px;
            grid-column: 1 / -1;
        }

        .no-results i {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
            display: block;
        }

        .no-results h5 {
            color: #6b7280;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .no-results p {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        /* Modal */
        .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header-custom {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            padding: 28px 30px;
            position: relative;
            overflow: hidden;
        }

        .modal-header-custom::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
        }

        .modal-header-custom .modal-title {
            color: #fff;
            font-weight: 700;
            font-size: 1.3rem;
            position: relative;
            z-index: 1;
        }

        .modal-header-custom .btn-close-custom {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s;
            position: relative;
            z-index: 1;
        }

        .modal-header-custom .btn-close-custom:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .modal-header-custom .btn-close-custom i {
            color: #fff;
            font-size: 1.1rem;
        }

        .modal-body-custom {
            padding: 30px;
            max-height: 70vh;
            overflow-y: auto;
        }

        .modal-body-custom::-webkit-scrollbar {
            width: 6px;
        }

        .modal-body-custom::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .modal-body-custom::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 3px;
        }

        .modal-body-custom::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        .modal-body-custom .ck-content {
            line-height: 1.9;
            color: #374151;
            font-size: 0.95rem;
        }

        .modal-body-custom .ck-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 12px 0;
        }

        .modal-body-custom .ck-content p {
            margin-bottom: 12px;
        }

        .modal-image-wrapper {
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .modal-image-wrapper img {
            width: 100%;
            max-height: 360px;
            object-fit: cover;
        }

        .btn-video {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-video:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.35);
            color: #fff;
        }

        .btn-website {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-website:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.35);
            color: #fff;
        }

        .modal-section-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #2563eb;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .modal-divider {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 20px 0;
        }

        /* FAQ */
        .faq-section {
            padding: 80px 0;
            background: #fff;
        }

        .faq-section .section-heading h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
        }

        .faq-section .section-subtitle {
            color: #64748b;
            font-size: 1rem;
            max-width: 500px;
            margin: 0 auto;
        }

        .accordion-item {
            border: none !important;
            border-radius: 14px !important;
            overflow: hidden;
            margin-bottom: 14px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9 !important;
            transition: box-shadow 0.3s ease;
        }

        .accordion-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .accordion-button {
            font-weight: 600;
            padding: 20px 24px;
            font-size: 0.95rem;
            color: #1e293b;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: #fff;
        }

        .accordion-button:not(.collapsed)::after {
            filter: brightness(0) invert(1);
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-body {
            padding: 24px;
            line-height: 1.8;
            color: #374151;
        }

        .accordion-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
            display: block;
        }

        .empty-state h5 {
            color: #6b7280;
            font-weight: 600;
        }

        .empty-state p {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .katalog-hero {
                padding: 60px 0 80px;
            }

            .katalog-hero h2 {
                font-size: 1.8rem;
            }

            .stats-strip {
                gap: 30px;
                padding: 20px 24px;
            }

            .stat-item .stat-number {
                font-size: 1.4rem;
            }

            .katalog-grid {
                grid-template-columns: 1fr;
            }

            .katalog-section {
                padding: 60px 0 40px;
            }
        }
    </style>
@endpush
@section('content')
    <!-- Hero Section -->
    <section class="katalog-hero">
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <span class="heading-badge"><i class="fas fa-concierge-bell"></i> Layanan Kami</span>
                <h2>Katalog Layanan</h2>
                <p>Temukan berbagai layanan yang kami sediakan untuk membantu kebutuhan Anda secara cepat dan transparan.
                </p>
                <!-- Search -->
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchKatalog" placeholder="Cari layanan..." autocomplete="off">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Strip -->
    <div class="container">
        <div class="stats-strip" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-item">
                <div class="stat-number">{{ $katalogs->count() }}</div>
                <div class="stat-label">Total Layanan</div>
            </div>
            {{-- <div class="stat-item">
            <div class="stat-number">{{ $katalogs->where('url_website', '!=', null)->count() }}</div>
            <div class="stat-label">Layanan Online</div>
        </div> --}}
            <div class="stat-item">
                <div class="stat-number">{{ $faqs->count() }}</div>
                <div class="stat-label">FAQ Tersedia</div>
            </div>
        </div>
    </div>

    <!-- Katalog Cards -->
    <section class="katalog-section">
        <div class="container">
            @if ($katalogs->count() > 0)
                <div class="katalog-grid" id="katalogGrid">
                    @foreach ($katalogs as $index => $katalog)
                        <div class="katalog-card" data-title="{{ strtolower($katalog->title) }}"
                            onclick="openModal('modalKatalog{{ $katalog->id }}')" data-aos="fade-up"
                            data-aos-delay="{{ $index * 80 }}">
                            <span class="card-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="card-icon-wrapper">
                                <i class="fas fa-concierge-bell"></i>
                            </div>
                            <h5 class="card-title">{{ $katalog->title }}</h5>
                            <p class="card-desc">{{ strip_tags($katalog->deskripsi) }}</p>
                            <div class="card-footer-custom">
                                <span class="card-link">
                                    Lihat Detail <i class="fas fa-arrow-right"></i>
                                </span>
                                <div class="card-badges">
                                    @if ($katalog->url_website)
                                        <span class="card-badge" title="Website tersedia"><i
                                                class="fas fa-globe"></i></span>
                                    @endif
                                    @if ($katalog->url_video)
                                        <span class="card-badge" title="Video tersedia"><i class="fas fa-play"></i></span>
                                    @endif
                                    @if ($katalog->image)
                                        <span class="card-badge" title="Gambar tersedia"><i class="fas fa-image"></i></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="no-results" id="noResults">
                        <i class="fas fa-search"></i>
                        <h5>Layanan tidak ditemukan</h5>
                        <p>Coba gunakan kata kunci yang berbeda.</p>
                    </div>
                </div>
            @else
                <div class="empty-state" data-aos="fade-up">
                    <i class="fas fa-box-open"></i>
                    <h5>Belum ada katalog layanan</h5>
                    <p>Saat ini belum ada layanan yang tersedia. Silakan kunjungi kembali nanti.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- FAQ Section -->
    @if ($faqs->count() > 0)
        <section class="faq-section">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <span class="heading-badge" style="background: #eff6ff; color: #1e3a8a; border-color: #bfdbfe;"><i
                            class="fas fa-question-circle"></i> FAQ</span>
                    <h2 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin-top: 14px;">Pertanyaan yang Sering
                        Diajukan</h2>
                    <p class="mt-2" style="color: #64748b; max-width: 500px; margin: 10px auto 0;">Jawaban untuk
                        pertanyaan umum seputar layanan kami</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                        <div class="accordion" id="faqAccordion">
                            @foreach ($faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqCollapse{{ $faq->id }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                            {{ $faq->title }}
                                        </button>
                                    </h2>
                                    <div id="faqCollapse{{ $faq->id }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body ck-content">
                                            {!! $faq->deskripsi !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Modals -->
    @foreach ($katalogs as $katalog)
        <div class="modal fade" id="modalKatalog{{ $katalog->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header-custom d-flex align-items-center justify-content-between">
                        <h5 class="modal-title">{{ $katalog->title }}</h5>
                        <button type="button" class="btn-close-custom"
                            onclick="closeModal('modalKatalog{{ $katalog->id }}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body-custom">
                        <div class="modal-section-label">
                            <i class="fas fa-file-alt"></i> Deskripsi Layanan
                        </div>
                        <div class="ck-content mb-3">
                            {!! $katalog->deskripsi !!}
                        </div>
                        @if ($katalog->image)
                            <hr class="modal-divider">
                            <div class="modal-section-label">
                                <i class="fas fa-image"></i> Gambar
                            </div>
                            <div class="modal-image-wrapper mb-3">
                                <img src="{{ Storage::url($katalog->image) }}" alt="{{ $katalog->title }}">
                            </div>
                        @endif
                        @if ($katalog->url_video)
                            <hr class="modal-divider">
                            <div class="modal-section-label">
                                <i class="fas fa-play-circle"></i> Video
                            </div>
                            <div class="text-center mb-3">
                                <a href="{{ $katalog->url_video }}" target="_blank" class="btn-video">
                                    <i class="fab fa-youtube"></i> Tonton Video
                                </a>
                            </div>
                        @endif
                        @if ($katalog->url_website)
                            <hr class="modal-divider">
                            <div class="text-center mt-3">
                                <a href="{{ $katalog->url_website }}" target="_blank" class="btn-website">
                                    <i class="fas fa-globe"></i> Kunjungi Website Layanan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('scripts')
    <script>
        function openModal(modalId) {
            var modalEl = document.getElementById(modalId);
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
        }

        function closeModal(modalId) {
            var modalEl = document.getElementById(modalId);
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        }

        // Live search filter
        document.getElementById('searchKatalog').addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.katalog-card');
            const noResults = document.getElementById('noResults');
            let visibleCount = 0;

            cards.forEach(card => {
                const title = card.getAttribute('data-title');
                if (title.includes(query)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (noResults) {
                noResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    </script>
@endpush
