@extends('frontend.layouts.app')

@section('title')
    Berita - DISKOMINFOSANTIK
@endsection

@push('css')
    <style>
        /* ===== Header Section ===== */
        .news-header {
            padding: 40px 0 20px;
            border-bottom: 2px solid var(--rgba-primary-2);
        }

        .news-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: var(--title);
            position: relative;
            display: inline-block;
        }

        .news-header h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .news-header .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 14px;
        }

        .news-header .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }

        .news-header .breadcrumb a:hover {
            color: var(--primary-hover);
        }

        .news-header .breadcrumb .active {
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

        /* ===== News Card ===== */
        .news-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
        }

        .news-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
        }

        .news-card .card-img-wrapper {
            position: relative;
            overflow: hidden;
        }

        .news-card .card-img-wrapper img {
            height: 220px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .news-card:hover .card-img-wrapper img {
            transform: scale(1.05);
        }

        .news-card .card-img-wrapper .date-badge {
            position: absolute;
            bottom: 12px;
            left: 12px;
            background: var(--primary);
            color: #fff;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .news-card .card-body {
            padding: 20px;
        }

        .news-meta {
            font-size: 13px;
            color: #999;
        }

        .news-meta i {
            color: var(--primary);
            margin-right: 4px;
        }

        .news-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--title);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s;
        }

        .news-title:hover {
            color: var(--primary);
        }

        .news-excerpt {
            font-size: 14px;
            color: #666;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.6;
        }

        .btn-read-more {
            color: var(--primary);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-read-more:hover {
            color: var(--primary-hover);
            letter-spacing: 0.5px;
        }

        .btn-read-more i {
            transition: transform 0.3s;
        }

        .btn-read-more:hover i {
            transform: translateX(4px);
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

        .pagination .page-item.disabled .page-link {
            color: #aaa;
            background-color: #f8f9fa;
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
        <div class="news-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2>Berita</h2>
                        <nav aria-label="breadcrumb" class="mt-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Berita</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('frontend.news.index') }}" method="GET">
                            <div class="input-group search-box">
                                <input type="text" name="search" class="form-control" placeholder="Cari berita..."
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

            {{-- Info hasil pencarian --}}
            @if (request('search'))
                <div class="mb-4">
                    <span class="text-muted">Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></span>
                    <a href="{{ route('frontend.news.index') }}" class="ms-2 text-decoration-none"
                        style="color: var(--primary);">
                        <i class="fas fa-times-circle"></i> Reset
                    </a>
                </div>
            @endif

            {{-- News Grid --}}
            <div class="row">
                @forelse ($news as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card news-card h-100">
                            <div class="card-img-wrapper">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                                <span class="date-badge">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="news-meta mb-2">
                                    <span><i class="far fa-user"></i> {{ $item->creator->name ?? 'Admin' }}</span>
                                    <span class="ms-3"><i class="far fa-eye"></i> {{ $item->counter }}x</span>
                                </div>
                                <a href="{{ route('frontend.news.show', $item->id) }}" class="text-decoration-none">
                                    <h5 class="news-title mb-2">{{ $item->title }}</h5>
                                </a>
                                <p class="news-excerpt">
                                    {!! Str::limit(strip_tags($item->content), 120) !!}
                                </p>
                                <div class="mt-auto pt-3">
                                    <a href="{{ route('frontend.news.show', $item->id, $item->title) }}"
                                        class="btn-read-more">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-newspaper d-block"></i>
                            <h5>Belum Ada Berita</h5>
                            <p>Berita akan ditampilkan di sini ketika sudah tersedia.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($news->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>
@endsection
