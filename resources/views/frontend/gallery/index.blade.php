@extends('frontend.layouts.app')

@section('title')
    Galeri - DISKOMINFOPERSANTIK
@endsection

@push('css')
    <style>
        /* ===== Header Section ===== */
        .gallery-header {
            padding: 40px 0 20px;
            border-bottom: 2px solid var(--rgba-primary-2);
        }

        .gallery-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: var(--title);
            position: relative;
            display: inline-block;
        }

        .gallery-header h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .gallery-header .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 14px;
        }

        .gallery-header .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }

        .gallery-header .breadcrumb a:hover {
            color: var(--primary-hover);
        }

        .gallery-header .breadcrumb .active {
            color: #888;
        }

        /* ===== Search Box ===== */
        .search-box .form-control {
            border-radius: 30px 0 0 30px;
            border: 1px solid #ddd;
            padding: 10px 20px;
            font-size: 14px;
        }

        .search-box .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem var(--rgba-primary-3);
        }

        .search-box .btn {
            border-radius: 0 30px 30px 0;
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            padding: 10px 20px;
        }

        .search-box .btn:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        /* ===== Gallery Grid ===== */
        .gallery-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            background: #f5f5f5;
        }

        .gallery-item img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            transition: transform 0.4s ease, filter 0.4s ease;
            display: block;
        }

        .gallery-item:hover img {
            transform: scale(1.08);
            filter: brightness(0.7);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s ease;
            padding: 20px;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay .zoom-icon {
            width: 48px;
            height: 48px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            margin-bottom: 10px;
            transition: transform 0.3s;
        }

        .gallery-overlay .zoom-icon:hover {
            transform: scale(1.1);
        }

        .gallery-overlay .gallery-name {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ===== Lightbox ===== */
        .lightbox-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .lightbox-backdrop.active {
            display: flex;
        }

        .lightbox-content {
            position: relative;
            max-width: 900px;
            width: 100%;
            animation: lightboxIn 0.3s ease;
        }

        @keyframes lightboxIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .lightbox-content img {
            width: 100%;
            max-height: 80vh;
            object-fit: contain;
            border-radius: 8px;
        }

        .lightbox-caption {
            text-align: center;
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            margin-top: 12px;
        }

        .lightbox-close {
            position: absolute;
            top: -14px;
            right: -14px;
            width: 36px;
            height: 36px;
            background: var(--primary);
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
            z-index: 10;
        }

        .lightbox-close:hover {
            background: var(--primary-hover);
        }

        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .lightbox-nav:hover {
            background: var(--primary);
        }

        .lightbox-prev {
            left: -60px;
        }

        .lightbox-next {
            right: -60px;
        }

        @media (max-width: 768px) {
            .lightbox-prev {
                left: 10px;
            }

            .lightbox-next {
                right: 10px;
            }

            .gallery-item img {
                height: 180px;
            }
        }

        /* ===== Pagination Override ===== */
        .pagination .page-link {
            color: var(--primary);
            border-color: #dee2e6;
            padding: 8px 16px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .pagination .page-link:hover {
            background-color: var(--rgba-primary-1);
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        /* ===== Empty State ===== */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state i {
            font-size: 48px;
            color: var(--rgba-primary-4);
            margin-bottom: 16px;
        }

        .empty-state h5 {
            color: var(--title);
            font-weight: 600;
        }

        .empty-state p {
            color: #888;
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="page-content bg-white">

        {{-- Header --}}
        <div class="gallery-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2>Galeri</h2>
                        <nav aria-label="breadcrumb" class="mt-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('frontend.gallery.index') }}" method="GET">
                            <div class="input-group search-box">
                                <input type="text" name="search" class="form-control" placeholder="Cari galeri..."
                                    value="{{ request('search') }}">
                                <button class="btn" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="container my-5">

            @if (request('search'))
                <div class="mb-4">
                    <span class="text-muted">Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></span>
                    <a href="{{ route('frontend.gallery.index') }}" class="ms-2 text-decoration-none"
                        style="color: var(--primary);">
                        <i class="fas fa-times-circle"></i> Reset
                    </a>
                </div>
            @endif

            {{-- Gallery Grid --}}
            <div class="row">
                @forelse ($galleries as $index => $gallery)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="gallery-item" onclick="openLightbox({{ $index }})">
                            <img src="{{ asset('storage/' . $gallery->path) }}" alt="{{ $gallery->name }}">
                            <div class="gallery-overlay">
                                <div class="zoom-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                                <div class="gallery-name">{{ $gallery->name }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-images d-block"></i>
                            <h5>Belum Ada Galeri</h5>
                            <p>Foto galeri akan ditampilkan di sini ketika sudah tersedia.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($galleries->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $galleries->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    {{-- Lightbox Modal --}}
    <div class="lightbox-backdrop" id="lightbox" onclick="closeLightboxOutside(event)">
        <div class="lightbox-content">
            <button class="lightbox-close" onclick="closeLightbox()">
                <i class="fas fa-times"></i>
            </button>
            <button class="lightbox-nav lightbox-prev" onclick="navigateLightbox(-1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="lightbox-nav lightbox-next" onclick="navigateLightbox(1)">
                <i class="fas fa-chevron-right"></i>
            </button>
            <img id="lightbox-img" src="" alt="">
            <div class="lightbox-caption" id="lightbox-caption"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const galleryData = @json(
            $galleries->getCollection()->map(function ($item) {
                    return [
                        'src' => asset('storage/' . $item->path),
                        'name' => $item->name,
                    ];
                })->values());

        let currentIndex = 0;

        function openLightbox(index) {
            currentIndex = index;
            updateLightbox();
            document.getElementById('lightbox').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
            document.body.style.overflow = '';
        }

        function closeLightboxOutside(e) {
            if (e.target === document.getElementById('lightbox')) {
                closeLightbox();
            }
        }

        function navigateLightbox(direction) {
            currentIndex += direction;
            if (currentIndex < 0) currentIndex = galleryData.length - 1;
            if (currentIndex >= galleryData.length) currentIndex = 0;
            updateLightbox();
        }

        function updateLightbox() {
            document.getElementById('lightbox-img').src = galleryData[currentIndex].src;
            document.getElementById('lightbox-caption').textContent = galleryData[currentIndex].name;
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (!lightbox.classList.contains('active')) return;

            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') navigateLightbox(-1);
            if (e.key === 'ArrowRight') navigateLightbox(1);
        });
    </script>
@endpush
