@extends('frontend.layouts.app')

@section('title')
    Unduhan - DISKOMINFOPERSANTIK
@endsection

@push('css')
<style>
    /* ===== Header Section ===== */
    .download-header {
        padding: 40px 0 20px;
        border-bottom: 2px solid var(--rgba-primary-2);
    }
    .download-header h2 {
        font-size: 32px;
        font-weight: 700;
        color: var(--title);
        position: relative;
        display: inline-block;
    }
    .download-header h2::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary);
        border-radius: 2px;
    }
    .download-header .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
        font-size: 14px;
    }
    .download-header .breadcrumb a {
        color: var(--primary);
        text-decoration: none;
    }
    .download-header .breadcrumb a:hover {
        color: var(--primary-hover);
    }
    .download-header .breadcrumb .active {
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

    /* ===== Download List ===== */
    .download-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 20px;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 10px;
        transition: all 0.3s ease;
        margin-bottom: 12px;
    }
    .download-item:hover {
        border-color: var(--rgba-primary-4);
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transform: translateY(-2px);
    }
    .download-icon {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #fff;
        flex-shrink: 0;
    }
    .download-icon.pdf { background: #e74c3c; }
    .download-icon.doc { background: #2b579a; }
    .download-icon.xls { background: #217346; }
    .download-icon.ppt { background: #d24726; }
    .download-icon.zip { background: #f39c12; }
    .download-icon.default { background: #95a5a6; }

    .download-info {
        flex: 1;
        min-width: 0;
    }
    .download-name {
        font-size: 15px;
        font-weight: 600;
        color: var(--title);
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .download-meta {
        font-size: 12px;
        color: #999;
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }
    .download-meta i {
        color: var(--primary);
        margin-right: 4px;
    }
    .download-action .btn-download {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 20px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        white-space: nowrap;
    }
    .download-action .btn-download:hover {
        background: var(--primary-hover);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px var(--rgba-primary-4);
    }
    .download-action .btn-download i {
        font-size: 14px;
    }

    /* ===== Counter Badge ===== */
    .hits-badge {
        background: var(--rgba-primary-1);
        color: var(--primary);
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    /* ===== Pagination ===== */
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

    /* ===== Responsive ===== */
    @media (max-width: 576px) {
        .download-item {
            flex-wrap: wrap;
        }
        .download-action {
            width: 100%;
        }
        .download-action .btn-download {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="page-content bg-white">

    {{-- Header --}}
    <div class="download-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>Unduhan</h2>
                    <nav aria-label="breadcrumb" class="mt-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Unduhan</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('frontend.download.index') }}" method="GET">
                        <div class="input-group search-box">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari file..." value="{{ request('search') }}">
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

        @if(request('search'))
            <div class="mb-4">
                <span class="text-muted">Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></span>
                <a href="{{ route('frontend.download.index') }}" class="ms-2 text-decoration-none" style="color: var(--primary);">
                    <i class="fas fa-times-circle"></i> Reset
                </a>
            </div>
        @endif

        {{-- Download List --}}
        @forelse ($downloads as $item)
            @php
                $ext = strtolower(pathinfo($item->path, PATHINFO_EXTENSION));
                $iconClass = match(true) {
                    $ext === 'pdf' => 'pdf',
                    in_array($ext, ['doc', 'docx']) => 'doc',
                    in_array($ext, ['xls', 'xlsx']) => 'xls',
                    in_array($ext, ['ppt', 'pptx']) => 'ppt',
                    in_array($ext, ['zip', 'rar']) => 'zip',
                    default => 'default',
                };
                $iconSymbol = match($iconClass) {
                    'pdf' => 'fas fa-file-pdf',
                    'doc' => 'fas fa-file-word',
                    'xls' => 'fas fa-file-excel',
                    'ppt' => 'fas fa-file-powerpoint',
                    'zip' => 'fas fa-file-archive',
                    default => 'fas fa-file-alt',
                };
            @endphp
            <div class="download-item">
                <div class="download-icon {{ $iconClass }}">
                    <i class="{{ $iconSymbol }}"></i>
                </div>
                <div class="download-info">
                    <div class="download-name" title="{{ $item->name }}">{{ $item->name }}</div>
                    <div class="download-meta">
                        <span><i class="far fa-calendar-alt"></i> {{ $item->created_at->format('d M Y') }}</span>
                        <span><i class="fas fa-file"></i> {{ strtoupper($ext) }}</span>
                        <span class="hits-badge"><i class="fas fa-download"></i> {{ $item->hits }}x diunduh</span>
                    </div>
                </div>
                <div class="download-action">
                    <a href="{{ route('download.file', $item->id) }}" class="btn-download">
                        <i class="fas fa-download"></i> Unduh
                    </a>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-folder-open d-block"></i>
                <h5>Belum Ada File Unduhan</h5>
                <p>File unduhan akan ditampilkan di sini ketika sudah tersedia.</p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if ($downloads->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $downloads->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection