@extends('frontend.layouts.app')

@section('title')
    {{ $newsItem->title }} - DISKOMINFOSANTIK
@endsection

@push('css')
    <style>
        /* ===== Header Section ===== */
        .news-detail-header {
            padding: 40px 0 20px;
            border-bottom: 2px solid var(--rgba-primary-2);
        }

        .news-detail-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: var(--title);
            position: relative;
            display: inline-block;
        }

        .news-detail-header h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .news-detail-header .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 14px;
        }

        .news-detail-header .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }

        .news-detail-header .breadcrumb a:hover {
            color: var(--primary-hover);
        }

        .news-detail-header .breadcrumb .active {
            color: #888;
        }

        /* ===== Article ===== */
        .news-detail-img {
            width: 100%;
            max-height: 50%;
            object-fit: cover;
            border-radius: 10px;
        }

        .news-detail-meta {
            font-size: 14px;
            color: #999;
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
        }

        .news-detail-meta i {
            color: var(--primary);
            margin-right: 5px;
        }

        .news-detail-title {
            font-size: 26px;
            font-weight: 700;
            color: var(--title);
            line-height: 1.4;
        }

        .news-detail-content {
            font-size: 16px;
            line-height: 1.9;
            color: #444;
        }

        .news-detail-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 16px 0;
        }

        .news-detail-content p {
            margin-bottom: 16px;
        }

        /* ===== Share Buttons ===== */
        .share-section {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .share-section span {
            font-weight: 600;
            color: var(--title);
            font-size: 15px;
        }

        .share-btn {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #fff;
            font-size: 15px;
            transition: transform 0.3s, opacity 0.3s;
        }

        .share-btn:hover {
            opacity: 0.85;
            color: #fff;
            transform: translateY(-2px);
        }

        .share-btn.facebook {
            background: #3b5998;
        }

        .share-btn.twitter {
            background: #1da1f2;
        }

        .share-btn.whatsapp {
            background: #25d366;
        }

        /* ===== Back Button ===== */
        .btn-back {
            color: var(--primary);
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-back:hover {
            color: var(--primary-hover);
        }

        .btn-back i {
            transition: transform 0.3s;
        }

        .btn-back:hover i {
            transform: translateX(-4px);
        }

        /* ===== Sidebar ===== */
        .sidebar-card {
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
        }

        .sidebar-card .card-header-custom {
            background: var(--primary);
            color: #fff;
            padding: 14px 20px;
            font-size: 16px;
            font-weight: 700;
        }

        .sidebar-news-item {
            display: flex;
            gap: 12px;
            padding: 14px 20px;
            border-bottom: 1px solid #f2f2f2;
            transition: background 0.3s;
        }

        .sidebar-news-item:last-child {
            border-bottom: none;
        }

        .sidebar-news-item:hover {
            background: var(--rgba-primary-1);
        }

        .sidebar-news-item img {
            width: 75px;
            height: 56px;
            object-fit: cover;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .sidebar-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--title);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s;
        }

        .sidebar-title:hover {
            color: var(--primary);
        }

        .sidebar-date {
            font-size: 11px;
            color: #aaa;
            margin-top: 4px;
        }

        .sidebar-date i {
            color: var(--primary);
            margin-right: 3px;
        }
    </style>
@endpush

@section('content')
    <div class="page-content bg-white">

        {{-- Header --}}
        <div class="news-detail-header">
            <div class="container">
                <h2>Detail Berita</h2>
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend.news.index') }}">Berita</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Content --}}
        <div class="container my-5">
            <div class="row">

                {{-- Main Article --}}
                <div class="col-lg-8 mb-4">
                    <article>
                        {{-- Back --}}
                        <div>
                            <a href="{{ route('frontend.news.index') }}" class="btn-back d-inline-block mb-3">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Berita
                            </a>
                        </div>

                        {{-- Image --}}
                        <img src="{{ $newsItem->image_url }}" alt="{{ $newsItem->title }}" class="news-detail-img mb-4">

                        {{-- Meta --}}
                        <div class="news-detail-meta mb-3">
                            <span><i class="far fa-calendar-alt"></i>
                                {{ $newsItem->created_at->format('d M Y, H:i') }}</span>
                            <span><i class="far fa-user"></i> {{ $newsItem->creator->name ?? 'Admin' }}</span>
                            <span><i class="far fa-eye"></i> {{ $newsItem->counter }}x dilihat</span>
                        </div>

                        {{-- Title --}}
                        <h3 class="news-detail-title mb-4">{{ $newsItem->title }}</h3>

                        {{-- Content --}}
                        <div class="news-detail-content">
                            {!! $newsItem->content !!}
                        </div>

                        {{-- Share --}}
                        <div class="share-section mt-4 d-flex align-items-center gap-3">
                            <span>Bagikan:</span>
                            @php
                                $shareUrl = urlencode(request()->url());
                                $shareTitle = urlencode($newsItem->title);
                            @endphp
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                                class="share-btn facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            {{-- <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" class="share-btn twitter">
                            <i class="fab fa-twitter"></i>
                        </a> --}}
                            <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank"
                                class="share-btn whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </article>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="sidebar-card">
                        <div class="card-header-custom">
                            <i class="far fa-newspaper me-2"></i> Berita Terbaru
                        </div>
                        @forelse ($latestNews as $latest)
                            <a href="{{ route('frontend.news.show', $latest->id) }}" class="text-decoration-none">
                                <div class="sidebar-news-item">
                                    <img src="{{ $latest->image_url }}" alt="{{ $latest->title }}">
                                    <div>
                                        <div class="sidebar-title">{{ $latest->title }}</div>
                                        <div class="sidebar-date">
                                            <i class="far fa-calendar-alt"></i> {{ $latest->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-center">
                                <p class="text-muted small mb-0">Belum ada berita lainnya.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
