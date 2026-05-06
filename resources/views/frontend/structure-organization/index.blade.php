@extends('frontend.layouts.app')
@section('title', 'Struktur Organisasi')

@php
    $logoUrl = $site_identity->get('favicon')
        ? Storage::url($site_identity->get('favicon'))
        : asset('frontend/images/favicon.png');
@endphp

@section('content')
<style>
    /* ── Page Hero (No Header Navbar) ── */
    .org-hero {
        text-align: center;
        padding: 50px 0 10px;
    }
    .org-hero .hero-icon {
        width: 70px; height: 70px; border-radius: 50%;
        background: linear-gradient(135deg, var(--primary, #3b82f6), var(--primary-dark, #6366f1));
        display: inline-flex; align-items: center; justify-content: center;
        margin-bottom: 14px;
        box-shadow: 0 8px 28px rgba(99,102,241,.25);
    }
    .org-hero .hero-icon i { font-size: 26px; color: #fff; }
    .org-hero h1 {
        font-size: 1.8rem; font-weight: 800;
        background: linear-gradient(135deg, var(--primary, #1e40af), var(--primary-dark, #6366f1));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .org-hero p { color: #64748b; font-size: 14px; margin-top: 2px; }
    .org-hero .breadcrumb {
        background: transparent; padding: 0; margin: 10px 0 0;
        justify-content: center; font-size: 13px;
    }
    .org-hero .breadcrumb-item a { color: var(--primary, #3b82f6); text-decoration: none; }
    .org-hero .breadcrumb-item.active { color: #94a3b8; }

    /* ── Connector Lines ── */
    .org-connector { display: flex; justify-content: center; margin: 4px 0; }
    .org-connector .line {
        width: 3px; height: 36px;
        background: linear-gradient(to bottom, #a5b4fc, #c4b5fd);
        border-radius: 2px;
    }

    /* ── Section Title ── */
    .section-heading {
        display: flex; align-items: center; gap: 10px;
        margin: 40px 0 20px;
    }
    .section-heading .dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .section-heading h2 { font-size: 1.15rem; font-weight: 700; color: #334155; margin: 0; }
    .section-heading .badge-count {
        margin-left: auto; font-size: 12px; font-weight: 600;
        background: #f1f5f9; color: #64748b; padding: 4px 12px; border-radius: 20px;
    }

    /* ═══════════════════════════════════════
       PEGAWAI CARD (Reference Style)
    ═══════════════════════════════════════ */
    .peg-card {
        background: #fff; border-radius: 14px; overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,.05), 0 8px 24px rgba(0,0,0,.04);
        transition: transform .3s, box-shadow .3s;
        position: relative; text-align: center; padding-bottom: 22px;
    }
    .peg-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,.1);
    }

    /* Dashed top border */
    .peg-card .dash-top {
        height: 6px; margin: 12px 14px 0;
        border-top: 4px dashed #3b82f6;
    }
    .peg-kepala .dash-top    { border-color: #d4a017; }
    .peg-sekretaris .dash-top { border-color: #0d6e6e; }
    .peg-kabid .dash-top     { border-color: #8e44ad; }
    .peg-kasubag .dash-top   { border-color: #d97706; }
    .peg-staff .dash-top     { border-color: #6b7280; }

    /* Logo badge */
    .peg-card .logo-badge {
        position: absolute; top: 10px; right: 10px;
        width: 40px; height: 40px; border-radius: 10px;
        background: #f8fafc; padding: 4px;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
        z-index: 2;
    }
    .peg-card .logo-badge img { width: 100%; height: 100%; object-fit: contain; }

    /* Photo frame */
    .peg-card .photo-frame {
        width: 155px; height: 195px; margin: 14px auto 0;
        border-radius: 10px; overflow: hidden;
        border: 3px solid #e2e8f0;
        background: linear-gradient(135deg, #dbeafe, #c7d2fe);
    }
    .peg-kepala .photo-frame    { border-color: #d4a017; }
    .peg-sekretaris .photo-frame { border-color: #14a3a3; }
    .peg-kabid .photo-frame     { border-color: #a855f7; }
    .peg-kasubag .photo-frame   { border-color: #f59e0b; }
    .peg-staff .photo-frame     { border-color: #9ca3af; }

    .peg-card .photo-frame img {
        width: 100%; height: 100%; object-fit: cover; display: block;
    }

    /* No photo placeholder */
    .peg-card .photo-frame .no-photo {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        font-size: 42px; font-weight: 700; color: #fff;
    }
    .peg-kepala .no-photo    { background: linear-gradient(135deg, #d4a017, #b8860b); }
    .peg-sekretaris .no-photo { background: linear-gradient(135deg, #0d6e6e, #14a3a3); }
    .peg-kabid .no-photo     { background: linear-gradient(135deg, #8e44ad, #a855f7); }
    .peg-kasubag .no-photo   { background: linear-gradient(135deg, #d97706, #f59e0b); }
    .peg-staff .no-photo     { background: linear-gradient(135deg, #6b7280, #9ca3af); }

    /* Card text */
    .peg-card .peg-nama {
        font-size: 13px; font-weight: 800; color: #1e293b;
        margin: 16px 14px 0; line-height: 1.4;
        text-transform: uppercase;
    }
    .peg-card .peg-jabatan {
        font-size: 12.5px; font-weight: 600; margin: 8px 14px 0;
        letter-spacing: .3px;
    }
    .peg-kepala .peg-jabatan    { color: #b8860b; }
    .peg-sekretaris .peg-jabatan { color: #0d6e6e; }
    .peg-kabid .peg-jabatan     { color: #8e44ad; }
    .peg-kasubag .peg-jabatan   { color: #d97706; }
    .peg-staff .peg-jabatan     { color: #6b7280; }

    .peg-card .peg-nip {
        font-size: 11.5px; color: #94a3b8; margin: 12px 14px 0;
        padding-top: 10px; border-top: 1px solid #f1f5f9;
    }
    .peg-card .peg-golongan {
        display: inline-block; font-size: 11px; margin-top: 8px;
        background: #f1f5f9; color: #64748b; padding: 2px 10px; border-radius: 20px;
    }

    /* Leader center wrapper */
    .leader-wrap { display: flex; justify-content: center; }
    .leader-wrap .peg-card { width: 270px; }

    /* ── Empty State ── */
    .empty-card {
        text-align: center; padding: 44px 20px;
        background: #fff; border-radius: 14px;
        border: 2px dashed #e2e8f0;
    }
    .empty-card .empty-icon {
        width: 56px; height: 56px; border-radius: 50%;
        background: #f8fafc; display: inline-flex;
        align-items: center; justify-content: center; margin-bottom: 10px;
    }
    .empty-card .empty-icon i { font-size: 22px; color: #cbd5e1; }
    .empty-card p { color: #94a3b8; font-size: 14px; font-weight: 500; margin: 0; }
    .empty-card small { color: #cbd5e1; font-size: 12px; }

    /* Responsive */
    @media (max-width: 768px) {
        .leader-wrap .peg-card { width: 100%; max-width: 270px; }
        .org-hero h1 { font-size: 1.4rem; }
    }
</style>

<!-- ══════ HERO SECTION ══════ -->
<section class="position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #1e3a5f 0%, #0d2137 60%, #0a1628 100%); padding: 80px 0 60px;">
    {{-- Decorative Background Elements --}}
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;overflow:hidden;pointer-events:none;">
        <div style="position:absolute;top:-80px;right:-80px;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,0.03);"></div>
        <div style="position:absolute;bottom:-120px;left:-60px;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,0.02);"></div>
        <div style="position:absolute;top:40%;left:50%;width:600px;height:1px;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.06),transparent);transform:translateX(-50%) rotate(-12deg);"></div>
        <div style="position:absolute;top:55%;left:50%;width:500px;height:1px;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.04),transparent);transform:translateX(-50%) rotate(-12deg);"></div>
    </div>
    <div class="container position-relative" style="z-index:2;">
        <div class="text-center">
            {{-- Icon Badge --}}
            <div class="d-inline-flex align-items-center justify-content-center mb-4"
                 style="width:72px;height:72px;border-radius:18px;background:rgba(255,255,255,0.08);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.12);">
                <i class="fa fa-sitemap" style="font-size:28px;color:#64b5f6;"></i>
            </div>
            {{-- Title --}}
            <h1 style="font-size:2.4rem;font-weight:700;color:#ffffff;letter-spacing:-0.5px;margin-bottom:12px;">
                Struktur Organisasi
            </h1>
            {{-- Subtitle --}}
            <p style="font-size:1.05rem;color:rgba(255,255,255,0.55);font-weight:400;margin-bottom:28px;max-width:500px;margin-left:auto;margin-right:auto;">
                {{ $site_identity->get('nama_instansi') ?? 'Dinas Komunikasi dan Informatika' }}
            </p>
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0"
                    style="background:rgba(255,255,255,0.06);display:inline-flex;padding:10px 24px;border-radius:50px;border:1px solid rgba(255,255,255,0.08);">
                    <li class="breadcrumb-item">
                        <a href="{{ route('main.index') }}" style="color:rgba(255,255,255,0.6);text-decoration:none;font-size:0.88rem;transition:color .2s;">
                            <i class="fa fa-home" style="margin-right:4px;font-size:0.8rem;"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active" style="color:#64b5f6;font-size:0.88rem;font-weight:500;" aria-current="page">
                        Struktur Organisasi
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- ══════ CONTENT ══════ -->
<section class="pb-5">
    <div class="container">

        {{-- ════════ KEPALA DINAS ════════ --}}
        <div class="position-section text-center mb-0">
            @if($kepalaDinas->isNotEmpty())
                @foreach($kepalaDinas as $pegawai)
                <div class="leader-wrap">
                    <div class="peg-card peg-kepala">
                        <div class="dash-top"></div>
                        <div class="logo-badge"><img src="{{ $logoUrl }}" alt="Logo"></div>
                        <div class="photo-frame">
                            @if($pegawai->gambar)
                                <img src="{{ $pegawai->gambar_url }}" alt="{{ $pegawai->nama }}">
                            @else
                                <div class="no-photo">{{ strtoupper(substr($pegawai->nama, 0, 2)) }}</div>
                            @endif
                        </div>
                        <div class="peg-nama">{{ $pegawai->nama }}</div>
                        <div class="peg-jabatan">{{ strtoupper($pegawai->jabatan) }}</div>
                        {{-- <div class="peg-nip">NIP. {{ $pegawai->nip }}</div> --}}
                        @if($pegawai->golongan)
                            <span class="peg-golongan">{{ $pegawai->golongan }}</span>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <div class="empty-card" style="max-width:300px; margin:0 auto;">
                    <div class="empty-icon"><i class="fa fa-user-slash"></i></div>
                    <p>Tidak ada pegawai di bagian ini</p>
                </div>
            @endif
        </div>

        <div class="org-connector"><div class="line"></div></div>

        {{-- ════════ SEKRETARIS ════════ --}}
        <div class="position-section text-center mb-0">
            @if($sekretaris->isNotEmpty())
                @foreach($sekretaris as $pegawai)
                <div class="leader-wrap">
                    <div class="peg-card peg-sekretaris">
                        <div class="dash-top"></div>
                        <div class="logo-badge"><img src="{{ $logoUrl }}" alt="Logo"></div>
                        <div class="photo-frame">
                            @if($pegawai->gambar)
                                <img src="{{ $pegawai->gambar_url }}" alt="{{ $pegawai->nama }}">
                            @else
                                <div class="no-photo">{{ strtoupper(substr($pegawai->nama, 0, 2)) }}</div>
                            @endif
                        </div>
                        <div class="peg-nama">{{ $pegawai->nama }}</div>
                        <div class="peg-jabatan">{{ strtoupper($pegawai->jabatan) }}</div>
                        {{-- <div class="peg-nip">NIP. {{ $pegawai->nip }}</div> --}}
                        @if($pegawai->golongan)
                            <span class="peg-golongan">{{ $pegawai->golongan }}</span>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <div class="empty-card" style="max-width:300px; margin:0 auto;">
                    <div class="empty-icon"><i class="fa fa-user-slash"></i></div>
                    <p>Tidak ada pegawai di bagian ini</p>
                </div>
            @endif
        </div>

        <div class="org-connector"><div class="line"></div></div>

        {{-- ════════ KEPALA BIDANG ════════ --}}
        <div class="section-heading">
            <div class="dot" style="background:linear-gradient(135deg,#8e44ad,#a855f7)"></div>
            <h2>Kepala Bidang</h2>
            <span class="badge-count">{{ $kabid->count() }} orang</span>
        </div>
        @if($kabid->isNotEmpty())
        <div class="row justify-content-center">
            @foreach($kabid as $pegawai)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                <div class="peg-card peg-kabid h-100">
                    <div class="dash-top"></div>
                    <div class="logo-badge"><img src="{{ $logoUrl }}" alt="Logo"></div>
                    <div class="photo-frame">
                        @if($pegawai->gambar)
                            <img src="{{ $pegawai->gambar_url }}" alt="{{ $pegawai->nama }}">
                        @else
                            <div class="no-photo">{{ strtoupper(substr($pegawai->nama, 0, 2)) }}</div>
                        @endif
                    </div>
                    <div class="peg-nama">{{ $pegawai->nama }}</div>
                    <div class="peg-jabatan">{{ strtoupper($pegawai->jabatan) }}</div>
                    {{-- <div class="peg-nip">NIP. {{ $pegawai->nip }}</div> --}}
                    @if($pegawai->golongan)
                        <span class="peg-golongan">{{ $pegawai->golongan }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-card">
            <div class="empty-icon"><i class="fa fa-user-slash"></i></div>
            <p>Tidak ada pegawai di bagian ini</p>
            <small>Belum ada data pegawai yang terdaftar</small>
        </div>
        @endif

        {{-- ════════ KASUBAG ════════ --}}
        <div class="section-heading">
            <div class="dot" style="background:linear-gradient(135deg,#d97706,#f59e0b)"></div>
            <h2>Kepala Sub Bagian</h2>
            <span class="badge-count">{{ $kasubag->count() }} orang</span>
        </div>
        @if($kasubag->isNotEmpty())
        <div class="row justify-content-center">
            @foreach($kasubag as $pegawai)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                <div class="peg-card peg-kasubag h-100">
                    <div class="dash-top"></div>
                    <div class="logo-badge"><img src="{{ $logoUrl }}" alt="Logo"></div>
                    <div class="photo-frame">
                        @if($pegawai->gambar)
                            <img src="{{ $pegawai->gambar_url }}" alt="{{ $pegawai->nama }}">
                        @else
                            <div class="no-photo">{{ strtoupper(substr($pegawai->nama, 0, 2)) }}</div>
                        @endif
                    </div>
                    <div class="peg-nama">{{ $pegawai->nama }}</div>
                    <div class="peg-jabatan">{{ strtoupper($pegawai->jabatan) }}</div>
                    {{-- <div class="peg-nip">NIP. {{ $pegawai->nip }}</div> --}}
                    @if($pegawai->golongan)
                        <span class="peg-golongan">{{ $pegawai->golongan }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-card">
            <div class="empty-icon"><i class="fa fa-user-slash"></i></div>
            <p>Tidak ada pegawai di bagian ini</p>
            <small>Belum ada data pegawai yang terdaftar</small>
        </div>
        @endif

        {{-- ════════ STAFF ════════ --}}
        <div class="section-heading">
            <div class="dot" style="background:linear-gradient(135deg,#6b7280,#9ca3af)"></div>
            <h2>Staff</h2>
            <span class="badge-count">{{ $staff->count() }} orang</span>
        </div>
        @if($staff->isNotEmpty())
        <div class="row justify-content-center">
            @foreach($staff as $pegawai)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                <div class="peg-card peg-staff h-100">
                    <div class="dash-top"></div>
                    <div class="logo-badge"><img src="{{ $logoUrl }}" alt="Logo"></div>
                    <div class="photo-frame">
                        @if($pegawai->gambar)
                            <img src="{{ $pegawai->gambar_url }}" alt="{{ $pegawai->nama }}">
                        @else
                            <div class="no-photo">{{ strtoupper(substr($pegawai->nama, 0, 2)) }}</div>
                        @endif
                    </div>
                    <div class="peg-nama">{{ $pegawai->nama }}</div>
                    <div class="peg-jabatan">{{ strtoupper($pegawai->jabatan) }}</div>
                    {{-- <div class="peg-nip">NIP. {{ $pegawai->nip }}</div> --}}
                    @if($pegawai->golongan)
                        <span class="peg-golongan">{{ $pegawai->golongan }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-card">
            <div class="empty-icon"><i class="fa fa-user-slash"></i></div>
            <p>Tidak ada pegawai di bagian ini</p>
            <small>Belum ada data pegawai yang terdaftar</small>
        </div>
        @endif

    </div>
</section>
@endsection