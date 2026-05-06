@extends('frontend.layouts.app')
@section('title', $field->nama_bidang)
@section('content')
<style>
    .field-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 60px 0 40px;
        color: #fff;
        margin-bottom: 40px;
    }
    .field-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .field-header .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
    }
    .field-header .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.2s;
    }
    .field-header .breadcrumb-item a:hover {
        color: #fff;
    }
    .field-header .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.6);
    }
    .field-header .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.5);
    }
    /* ── Info Card ── */
    .field-info-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
        padding: 30px;
        margin-bottom: 30px;
        border-left: 5px solid var(--primary);
    }
    .field-info-card h4 {
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 10px;
    }
    /* CKEditor Content */
    .field-info-card .ck-content {
        color: #6c757d;
        line-height: 1.7;
    }
    .field-info-card .ck-content p { margin-bottom: 10px; }
    .field-info-card .ck-content p:last-child { margin-bottom: 0; }
    .field-info-card .ck-content h2,
    .field-info-card .ck-content h3 { color: var(--primary-dark); margin-top: 20px; }
    .field-info-card .ck-content ul,
    .field-info-card .ck-content ol { padding-left: 24px; }
    .field-info-card .ck-content img { max-width: 100%; height: auto; border-radius: 8px; margin: 12px 0; }
    .stats-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(var(--primary-rgb, 13, 110, 253), 0.08);
        color: var(--primary);
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        margin-top: 15px;
    }
    /* ── Pegawai Section ── */
    .pegawai-section {
        margin-bottom: 60px;
    }
    .pegawai-section .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 25px;
        padding-bottom: 12px;
        border-bottom: 3px solid var(--primary);
        display: inline-block;
    }
    /* ── Pegawai Card (Portrait) ── */
    .pegawai-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        border: 1px solid #f0f0f0;
    }
    .pegawai-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-color: var(--primary);
    }
    .pegawai-card .card-img {
        width: 100%;
        aspect-ratio: 3 / 4;
        object-fit: cover;
        display: block;
    }
    .pegawai-card .card-body {
        padding: 18px 20px 22px;
        text-align: center;
    }
    .pegawai-card .card-body h5 {
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 6px;
        font-size: 1.05rem;
    }
    .pegawai-card .card-body .jabatan {
        color: var(--primary);
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }
    .pegawai-card .card-body .golongan {
        color: #999;
        font-size: 0.85rem;
        margin-bottom: 0;
    }
    .pegawai-card .card-body .golongan span {
        background: #f0f0f0;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
    }
    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }
    .empty-state i {
        font-size: 3rem;
        color: #ddd;
        margin-bottom: 15px;
    }
    .empty-state h5 {
        color: #999;
        font-weight: 600;
    }
    .empty-state p {
        color: #bbb;
        font-size: 0.95rem;
    }
    @media (max-width: 768px) {
        .field-header {
            padding: 40px 0 25px;
        }
        .field-header h1 {
            font-size: 1.5rem;
        }
    }
</style>
<!-- Header -->
<section class="field-header">
    <div class="container">
        <h1 class="text-white"><i class="fa fa-building me-2"></i>{{ $field->nama_bidang }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.structure-organization.index') }}">Struktur Organisasi</a></li>
                <li class="breadcrumb-item active">{{ $field->nama_bidang }}</li>
            </ol>
        </nav>
    </div>
</section>
<!-- Content -->
<section class="pegawai-section">
    <div class="container">
        <!-- Info Bidang -->
        <div class="field-info-card">
            <h4><i class="fa fa-info-circle me-2"></i>Tentang Bidang</h4>
            <div class="ck-content">
                {!! $field->deskripsi_bidang ?? '<p>Informasi mengenai ' . e($field->nama_bidang) . ' pada struktur organisasi.</p>' !!}
            </div>
            <div class="stats-badge">
                <i class="fa fa-users"></i>
                {{ $field->structures->count() }} Pegawai
            </div>
        </div>
        <!-- Daftar Pegawai -->
        <h3 class="section-title"><i class="fa fa-users me-2"></i>Daftar Pegawai</h3>
        @if($field->structures->count() > 0)
            <div class="row">
                @foreach($field->structures as $pegawai)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="pegawai-card">
                            <img src="{{ $pegawai->gambar_url }}"
                                 alt="{{ $pegawai->nama }}"
                                 class="card-img"
                                 loading="lazy">
                            <div class="card-body">
                                <h5>{{ $pegawai->nama }}</h5>
                                <p class="jabatan">{{ $pegawai->jabatan }}</p>
                                @if($pegawai->golongan)
                                    <p class="golongan">
                                        <span>{{ $pegawai->golongan }}</span>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fa fa-user-slash d-block"></i>
                <h5>Belum Ada Data Pegawai</h5>
                <p>Data pegawai untuk bidang ini belum tersedia.</p>
            </div>
        @endif
    </div>
</section>
@endsection