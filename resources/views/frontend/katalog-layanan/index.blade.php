@extends('frontend.layouts.app')
@section('title', 'Katalog Layanan - DISKOMINFOPERSANTIK')
@push('css')
<style>
    .katalog-section {
        padding: 80px 0 60px;
    }
    .section-subtitle {
        color: #64748b;
        font-size: 1.05rem;
        max-width: 600px;
        margin: 0 auto;
    }
    /* Card Katalog */
    .katalog-card {
        cursor: pointer;
        border-radius: 20px;
        border: none;
        background: linear-gradient(135deg, #0a1f5c 0%, #1a3a8a 40%, #2563eb 100%);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        min-height: 180px;
        position: relative;
        overflow: hidden;
    }
    .katalog-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        transition: all 0.4s ease;
    }
    .katalog-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #60a5fa, #a78bfa, #60a5fa);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .katalog-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(10, 31, 92, 0.35) !important;
    }
    .katalog-card:hover::after {
        opacity: 1;
    }
    .katalog-card .card-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .katalog-card .card-icon i {
        color: #93c5fd;
        font-size: 1.5rem;
    }
    .katalog-card .card-title {
        color: var(--primary);
        font-size: 1.05rem;
        font-weight: 700;
        letter-spacing: 0.2px;
    }
    .katalog-card .card-arrow {
        position: absolute;
        bottom: 16px;
        right: 16px;
        width: 32px;
        height: 32px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .katalog-card:hover .card-arrow {
        background: rgba(255,255,255,0.25);
        transform: translateX(4px);
    }
    .katalog-card .card-arrow i {
        color: #fff;
        font-size: 0.8rem;
    }
    /* Modal */
    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0,0,0,0.2);
    }
    .modal-header-custom {
        background: linear-gradient(135deg, #0a1f5c 0%, #1a3a8a 40%, #2563eb 100%);
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
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
    }
    .modal-header-custom .modal-title {
        color: #fff;
        font-weight: 700;
        font-size: 1.3rem;
        position: relative;
        z-index: 1;
    }
    .modal-header-custom .btn-close-custom {
        background: rgba(255,255,255,0.15);
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
        background: rgba(255,255,255,0.3);
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
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
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
        background: linear-gradient(135deg, #0a1f5c 0%, #2563eb 100%);
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
    .faq-wrapper {
        margin-top: 70px;
        padding-top: 50px;
        border-top: 1px solid #e2e8f0;
    }
    .accordion-item {
        border: none !important;
        border-radius: 14px !important;
        overflow: hidden;
        margin-bottom: 14px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.05);
        transition: box-shadow 0.3s ease;
    }
    .accordion-item:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .accordion-button {
        font-weight: 600;
        padding: 20px 24px;
        font-size: 0.95rem;
        color: #1e293b;
    }
    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, #0a1f5c 0%, #1a3a8a 60%, #2563eb 100%);
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
    .empty-state {
        padding: 40px 20px;
    }
    .empty-state i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 16px;
    }
</style>
@endpush
@section('content')
<section class="katalog-section">
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <h2 class="title" style="font-size: 2.2rem; font-weight: 800; color: #0f172a;">Katalog Layanan</h2>
            <div class="dz-separator style-1 text-primary"></div>
            <p class="section-subtitle mt-3">Temukan berbagai layanan yang kami sediakan untuk membantu kebutuhan Anda</p>
        </div>
        <!-- Cards -->
        <div class="row">
            @forelse($katalogs as $katalog)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card katalog-card h-100 shadow" onclick="openModal('modalKatalog{{ $katalog->id }}')">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center p-4">
                            <div class="card-icon">
                                <i class="fas fa-concierge-bell"></i>
                            </div>
                            <h5 class="card-title mb-0">{{ $katalog->title }}</h5>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state text-center">
                        <i class="fas fa-box-open d-block"></i>
                        <p class="text-muted mb-0">Belum ada katalog layanan tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
        <!-- FAQ -->
        @if($faqs->count() > 0)
            <div class="faq-wrapper">
                <div class="text-center mb-4" data-aos="fade-up" data-aos-duration="800">
                    <h2 class="title" style="font-size: 2rem; font-weight: 800; color: #0f172a;">Pertanyaan yang Sering Diajukan</h2>
                    <div class="dz-separator style-1 text-primary"></div>
                    <p class="section-subtitle mt-3">Jawaban untuk pertanyaan umum seputar layanan kami</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                        <div class="accordion" id="faqAccordion">
                            @foreach($faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                            {{ $faq->title }}
                                        </button>
                                    </h2>
                                    <div id="faqCollapse{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
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
        @endif
    </div>
</section>
<!-- Modals -->
@foreach($katalogs as $katalog)
    <div class="modal fade" id="modalKatalog{{ $katalog->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-custom d-flex align-items-center justify-content-between">
                    <h5 class="modal-title">{{ $katalog->title }}</h5>
                    <button type="button" class="btn-close-custom" onclick="closeModal('modalKatalog{{ $katalog->id }}')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body-custom">
                    <!-- Deskripsi -->
                    <div class="modal-section-label">
                        <i class="fas fa-file-alt"></i> Deskripsi Layanan
                    </div>
                    <div class="ck-content mb-3">
                        {!! $katalog->deskripsi !!}
                    </div>
                    @if($katalog->image)
                        <hr class="modal-divider">
                        <div class="modal-section-label">
                            <i class="fas fa-image"></i> Gambar
                        </div>
                        <div class="modal-image-wrapper mb-3">
                            <img src="{{ Storage::url($katalog->image) }}" alt="{{ $katalog->title }}">
                        </div>
                    @endif
                    @if($katalog->url_video)
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
                    @if($katalog->url_website)
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
        if (modal) {
            modal.hide();
        }
    }
</script>
@endpush