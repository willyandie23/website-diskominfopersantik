@extends('frontend.layouts.app')

@section('title')
    Beranda - DISKOMINFOSANTIK
@endsection

@push('css')
    <style>
        .banner-slider .swiper-slide {
            position: relative;
            height: 85vh;
            min-height: 500px;
            overflow: hidden;
        }

        .banner-slider .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner-slider .swiper-slide .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0.5));
        }

        .banner-slider .slide-content {
            position: absolute;
            bottom: 15%;
            left: 0;
            right: 0;
            z-index: 2;
            color: #fff;
        }

        .banner-slider .slide-content h2 {
            font-family: 'Oswald', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            text-transform: uppercase;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
            text-align: center;
            color: white;
        }

        .banner-slider .slide-content p {
            font-size: 1.1rem;
            max-width: 600px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
        }

        .banner-slider .swiper-pagination-bullet {
            background: #fff;
            opacity: 0.6;
        }

        .banner-slider .swiper-pagination-bullet-active {
            opacity: 1;
            background: var(--primary);
        }

        .banner-slider .swiper-button-next,
        .banner-slider .swiper-button-prev {
            color: #fff;
        }

        .video-wrapper:hover,
        .video-thumb:hover {
            transform: translateY(-3px);
            transition: transform 0.3s ease;
        }

        .video-wrapper,
        .video-thumb {
            transition: transform 0.3s ease;
        }

        .content-inner .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .content-inner .rounded-4:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .content-inner .rounded-4.shadow-sm:hover {
            transform: translateX(8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
            border-color: var(--primary) !important;
        }

        .content-inner .rounded-4.shadow-lg {
            transition: transform 0.3s ease;
        }

        .content-inner .rounded-4.shadow-lg:hover {
            transform: scale(1.03);
        }

        .content-inner .rounded-4.shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
        }

        .content-inner .rounded-4.shadow-sm.d-flex:hover {
            transform: translateX(5px);
            border-color: var(--primary) !important;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1 !important;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2) !important;
        }

        .hover-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12) !important;
            border-color: var(--primary) !important;
        }

        .gallery-item:hover img {
            transform: scale(1.08);
        }

        .gallery-item:hover>div {
            opacity: 1;
        }

        .peg-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05), 0 8px 24px rgba(0, 0, 0, .04);
            transition: transform .3s, box-shadow .3s;
            position: relative;
            text-align: center;
            padding-bottom: 22px;
        }

        .peg-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .1);
        }

        .peg-card .dash-top {
            height: 6px;
            margin: 12px 14px 0;
            border-top: 4px dashed #3b82f6;
        }

        .peg-kepala .dash-top {
            border-color: #d4a017;
        }

        .peg-card .logo-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f8fafc;
            padding: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
            z-index: 2;
        }

        .peg-card .logo-badge img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .peg-card .photo-frame {
            width: 155px;
            height: 195px;
            margin: 14px auto 0;
            border-radius: 10px;
            overflow: hidden;
            border: 3px solid #e2e8f0;
            background: linear-gradient(135deg, #dbeafe, #c7d2fe);
        }

        .peg-kepala .photo-frame {
            border-color: #d4a017;
        }

        .peg-card .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .peg-card .no-photo {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #d4a017, #b8860b);
        }

        .peg-card .peg-nama {
            font-size: 13px;
            font-weight: 800;
            color: #1e293b;
            margin: 16px 14px 0;
            line-height: 1.4;
            text-transform: uppercase;
        }

        .peg-card .peg-jabatan {
            font-size: 12.5px;
            font-weight: 600;
            margin: 8px 14px 0;
            letter-spacing: .3px;
            color: #b8860b;
        }

        .peg-card .peg-golongan {
            display: inline-block;
            font-size: 11px;
            margin-top: 8px;
            background: #f1f5f9;
            color: #64748b;
            padding: 2px 10px;
            border-radius: 20px;
        }

        .leader-wrap {
            display: flex;
            justify-content: center;
        }

        .youtube-modal .modal-dialog {
            max-width: 95%;
            margin: 2rem auto;
        }

        .youtube-modal .modal-content {
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .youtube-modal .modal-body {
            padding: 0 !important;
            height: calc(100vh - 120px) !important;
            /* memaksa tinggi penuh */
        }

        .youtube-modal .ratio {
            height: 100% !important;
        }

        .youtube-modal iframe {
            width: 100% !important;
            height: 100% !important;
            border: none;
        }

        @media (max-width: 768px) {
            .leader-wrap .peg-card {
                width: 100%;
                max-width: 270px;
            }

            .youtube-modal .modal-dialog {
                max-width: 100%;
                margin: 1rem;
            }

            .youtube-modal .modal-body {
                height: calc(100vh - 80px) !important;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-content bg-white">

        {{-- Banner/Slider Section --}}
        @if ($banners->count())
            <section class="banner-slider">
                <div class="swiper banner-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($banners as $banner)
                            <div class="swiper-slide">
                                <img src="{{ Storage::url($banner->path) }}" alt="{{ $banner->name ?? 'Banner' }}">
                                <div class="overlay"></div>
                                @if ($banner->name)
                                    <div class="slide-content">
                                        <div class="container">
                                            @if ($banner->name)
                                                <h2 data-aos="fade-up" data-aos-delay="200">{{ $banner->name }}</h2>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </section>
        @endif

        {{-- YouTube Video Section --}}
        <section class="content-inner py-5">
            <div class="container">
                <div class="row align-items-center g-4">

                    {{-- Left: Info --}}
                    <div class="col-lg-5" data-aos="fade-right" data-aos-delay="200">
                        <div class="pe-lg-4">
                            <span class="text-uppercase fw-bold small"
                                style="color: var(--primary); letter-spacing: 2px;">Video Profil</span>
                            <h2 class="title mt-2 mb-3" style="font-family: 'Oswald', sans-serif; font-weight: 700;">
                                Profil DISKOMINFOSANTIK Kabupaten Katingan
                            </h2>
                            <p class="text-muted" style="line-height: 1.8;">
                                Mengenal lebih dekat Dinas Komunikasi, Informatika, Persandian, dan Statistik Kabupaten
                                Katingan —
                                visi, misi, tugas pokok, serta peran kami dalam mendorong transformasi digital dan pelayanan
                                publik
                                yang transparan bagi masyarakat Katingan.
                            </p>

                            <a href="{{ $site_identity->get('youtube_url') }}" target="_blank" class="btn mt-3"
                                style="background: var(--primary); color: #fff; border-radius: 30px; padding: 12px 28px; font-weight: 600;">
                                <i class="fab fa-youtube me-2"></i> Tonton di YouTube
                            </a>
                        </div>
                    </div>

                    {{-- Right: Thumbnail + Play Button --}}
                    <div class="col-lg-7" data-aos="fade-left" data-aos-delay="400">
                        @php
                            $youtubeUrl = $site_identity->get('youtube_url');
                            $videoId = null;

                            if ($youtubeUrl) {
                                if (str_contains($youtubeUrl, 'youtu.be/')) {
                                    $videoId = substr($youtubeUrl, strrpos($youtubeUrl, '/') + 1, 11);
                                } elseif (str_contains($youtubeUrl, 'v=')) {
                                    $videoId = substr($youtubeUrl, strpos($youtubeUrl, 'v=') + 2, 11);
                                }
                            }

                            $thumbnail = $videoId ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" : null;
                        @endphp

                        @if ($thumbnail)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#youtubeModal"
                                class="d-block position-relative rounded-4 overflow-hidden shadow-lg"
                                style="aspect-ratio: 16/9; cursor: pointer;">
                                <img src="{{ $thumbnail }}" alt="Video Profil DISKOMINFOSANTIK"
                                    class="w-100 h-100 object-fit-cover">
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <div class="d-flex align-items-center justify-content-center bg-danger rounded-circle shadow"
                                        style="width: 90px; height: 90px; box-shadow: 0 10px 30px rgba(220, 38, 38, 0.4);">
                                        <i class="fab fa-youtube text-white" style="font-size: 48px; margin-left: 4px;"></i>
                                    </div>
                                </div>
                                <div class="position-absolute bottom-0 start-0 w-100"
                                    style="height: 6px; background: var(--primary);"></div>
                            </a>
                        @else
                            <div
                                class="ratio ratio-16x9 bg-light rounded-4 d-flex align-items-center justify-content-center shadow-lg">
                                <div class="text-center">
                                    <i class="fab fa-youtube text-muted" style="font-size: 5rem;"></i>
                                    <p class="text-muted mt-3">Belum ada video YouTube</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- Modal YouTube --}}
        <div class="modal fade youtube-modal" id="youtubeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 p-3">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            @if ($videoId)
                                <iframe id="youtubePlayer"
                                    src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&amp;modestbranding=1&amp;playsinline=1"
                                    title="Video Profil DISKOMINFOSANTIK" allowfullscreen
                                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                                </iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik Section --}}
        <section class="content-inner py-5 position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #4facfe 0%, #1e3a8a 100%);">
            {{-- Background Pattern --}}
            <div class="position-absolute w-100 h-100 top-0 start-0" style="opacity: 0.05;">
                <div class="position-absolute"
                    style="width: 300px; height: 300px; border-radius: 50%; background: #fff; top: -100px; right: -50px;">
                </div>
                <div class="position-absolute"
                    style="width: 200px; height: 200px; border-radius: 50%; background: #fff; bottom: -80px; left: -40px;">
                </div>
            </div>
            <div class="container position-relative" style="z-index: 2;">
                <div class="section-head text-center mb-5" data-aos="fade-up">
                    <span class="text-uppercase fw-bold small text-white" style="letter-spacing: 3px; opacity: 0.8;">Data &
                        Informasi</span>
                    <h2 class="title text-white mt-2"
                        style="font-family: 'Oswald', sans-serif; font-weight: 700; font-size: 2.5rem;">DISKOMINFOSANTIK
                        dalam Angka</h2>
                </div>
                <div class="row g-4 justify-content-center">
                    {{-- Card Pegawai --}}
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-center p-4 rounded-4 h-100"
                            style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease;">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                                style="width: 70px; height: 70px; background: rgba(255,255,255,0.15);">
                                <i class="mdi mdi-account-group text-white" style="font-size: 2rem;"></i>
                            </div>
                            <h2 class="counter text-white fw-bold mb-2"
                                style="font-family: 'Oswald', sans-serif; font-size: 3.5rem;">{{ $stats['pegawai'] }}</h2>
                            <p class="text-white text-uppercase fw-bold mb-0"
                                style="letter-spacing: 2px; font-size: 0.85rem; opacity: 0.85;">Total Pegawai</p>
                        </div>
                    </div>
                    {{-- Card Bidang --}}
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="text-center p-4 rounded-4 h-100"
                            style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease;">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                                style="width: 70px; height: 70px; background: rgba(255,255,255,0.15);">
                                <i class="mdi mdi-office-building text-white" style="font-size: 2rem;"></i>
                            </div>
                            <h2 class="counter text-white fw-bold mb-2"
                                style="font-family: 'Oswald', sans-serif; font-size: 3.5rem;">{{ $stats['bidang'] }}</h2>
                            <p class="text-white text-uppercase fw-bold mb-0"
                                style="letter-spacing: 2px; font-size: 0.85rem; opacity: 0.85;">Bidang</p>
                        </div>
                    </div>
                    {{-- Card Berita --}}
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="600">
                        <div class="text-center p-4 rounded-4 h-100"
                            style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease;">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                                style="width: 70px; height: 70px; background: rgba(255,255,255,0.15);">
                                <i class="mdi mdi-newspaper-variant-multiple text-white" style="font-size: 2rem;"></i>
                            </div>
                            <h2 class="counter text-white fw-bold mb-2"
                                style="font-family: 'Oswald', sans-serif; font-size: 3.5rem;">{{ $stats['berita'] }}</h2>
                            <p class="text-white text-uppercase fw-bold mb-0"
                                style="letter-spacing: 2px; font-size: 0.85rem; opacity: 0.85;">Berita Dipublikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Agenda & Aplikasi Mobile Section --}}
        <section class="content-inner py-5">
            <div class="container">
                <div class="row g-5">
                    {{-- Left: Agenda Mendatang --}}
                    <div class="col-lg-7" data-aos="fade-right">
                        <div class="mb-4">
                            <span class="text-uppercase fw-bold small"
                                style="color: var(--primary); letter-spacing: 3px;">Jadwal Kegiatan</span>
                            <h2 class="title mt-2" style="font-family: 'Oswald', sans-serif; font-weight: 700;">Agenda
                                Mendatang</h2>
                            <div class="dz-separator style-1 text-primary"></div>
                        </div>

                        @if ($agendas->count())
                            <div class="position-relative"
                                style="padding-left: 30px; border-left: 3px solid var(--primary);">
                                @foreach ($agendas as $index => $agenda)
                                    <div class="mb-4 position-relative" data-aos="fade-up"
                                        data-aos-delay="{{ ($index + 1) * 150 }}">
                                        {{-- Timeline Dot --}}
                                        <div class="position-absolute rounded-circle"
                                            style="width: 16px; height: 16px; background: var(--primary); left: -39px; top: 5px; border: 3px solid #fff; box-shadow: 0 0 0 3px var(--primary);">
                                        </div>
                                        {{-- Card --}}
                                        <div class="p-4 rounded-4 shadow-sm"
                                            style="background: #fff; border: 1px solid #eee; transition: all 0.3s ease;">
                                            <div class="d-flex align-items-start gap-3">
                                                {{-- Date Box --}}
                                                <div class="text-center flex-shrink-0 rounded-3 p-2"
                                                    style="background: linear-gradient(135deg, #4facfe 0%, #1e3a8a 100%); min-width: 65px;">
                                                    <span class="d-block text-white fw-bold"
                                                        style="font-size: 1.5rem; line-height: 1;">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d') }}</span>
                                                    <span class="d-block text-white text-uppercase"
                                                        style="font-size: 0.7rem; letter-spacing: 1px;">{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('M Y') }}</span>
                                                </div>
                                                {{-- Content --}}
                                                <div>
                                                    <h5 class="fw-bold mb-1">{{ $agenda->title }}</h5>
                                                    @if ($agenda->keterangan)
                                                        {!! $agenda->keterangan !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5" data-aos="fade-up">
                                <i class="mdi mdi-calendar-blank-outline text-muted" style="font-size: 4rem;"></i>
                                <p class="text-muted mt-3 mb-0">Belum ada agenda mendatang saat ini.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Right: Aplikasi Mobile --}}
                    <div class="col-lg-5" data-aos="fade-left">
                        <div class="text-center">
                            <span class="text-uppercase fw-bold small"
                                style="color: var(--primary); letter-spacing: 3px;">APLIKASI MOBILE</span>
                            <h2 class="title mt-2 mb-4" style="font-family: 'Oswald', sans-serif; font-weight: 700;">
                                Pandu</h2>

                            {{-- Phone Mockup --}}
                            <div class="d-inline-block position-relative mb-4" data-aos="zoom-in" data-aos-delay="300">
                                <div class="rounded-4 overflow-hidden shadow-lg d-inline-block"
                                    style="border: 8px solid #1e3a8a; max-width: 280px;">
                                    <img src="{{ asset('apk/ss.png') }}" alt="Aplikasi Mobile DISKOMINFO Katingan"
                                        class="w-100" style="aspect-ratio: 602/1234; object-fit: cover;">
                                </div>
                            </div>

                            <p class="text-muted px-3 mb-4">Akses layanan DISKOMINFOSANTIK Kabupaten Katingan langsung dari
                                smartphone Anda. Lebih cepat, lebih mudah.</p>

                            {{-- Download Button --}}
                            <a href="{{ asset('apk/pandu_1.2.apk') }}" class="btn d-inline-flex align-items-center gap-2"
                                style="background: linear-gradient(135deg, #4facfe 0%, #1e3a8a 100%); color: #fff; border-radius: 30px; padding: 14px 30px; font-weight: 600; transition: all 0.3s ease;">
                                <i class="mdi mdi-download" style="font-size: 1.3rem;"></i>
                                Download Aplikasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Berita Terbaru Section --}}
        <section class="content-inner py-5" style="background: #f8f9fa;">
            <div class="container">
                <div class="section-head text-center mb-5" data-aos="fade-up">
                    <span class="text-uppercase fw-bold small"
                        style="color: var(--primary); letter-spacing: 3px;">Publikasi</span>
                    <h2 class="title mt-2" style="font-family: 'Oswald', sans-serif; font-weight: 700;">Berita Terbaru
                    </h2>
                    <div class="dz-separator style-1 text-primary"></div>
                </div>

                @if ($news->count())
                    <div class="row g-4">
                        {{-- Card Utama (Berita Pertama) --}}
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="rounded-4 overflow-hidden shadow h-100 position-relative"
                                style="transition: all 0.3s ease;">
                                <div class="position-relative" style="height: 100%; min-height: 400px;">
                                    <img src="{{ $news[0]->image_url }}" alt="{{ $news[0]->title }}"
                                        class="w-100 h-100" style="object-fit: cover;">
                                    <div class="position-absolute w-100 h-100 top-0 start-0"
                                        style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 60%);">
                                    </div>
                                    <div class="position-absolute bottom-0 start-0 p-4" style="z-index: 2;">
                                        <span class="badge mb-2"
                                            style="background: var(--primary);">{{ $news[0]->created_at->translatedFormat('d M Y') }}</span>
                                        <h4 class="text-white fw-bold mb-2">{{ Str::limit($news[0]->title, 60) }}</h4>
                                        <a href="{{ route('frontend.news.show', $news[0]->id) }}"
                                            class="text-white fw-bold text-decoration-none" style="opacity: 0.9;">
                                            Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card List (Berita 2-4) --}}
                        <div class="col-lg-6">
                            <div class="d-flex flex-column gap-3 h-100">
                                @foreach ($news->skip(1) as $index => $item)
                                    <div class="rounded-4 overflow-hidden shadow-sm bg-white d-flex h-100"
                                        style="transition: all 0.3s ease; border: 1px solid #eee;" data-aos="fade-up"
                                        data-aos-delay="{{ ($index + 2) * 200 }}">
                                        <div class="flex-shrink-0" style="width: 160px;">
                                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                                class="w-100 h-100" style="object-fit: cover;">
                                        </div>
                                        <div class="p-3 d-flex flex-column justify-content-center">
                                            <span class="small fw-bold mb-1"
                                                style="color: var(--primary);">{{ $item->created_at->translatedFormat('d M Y') }}</span>
                                            <h6 class="fw-bold mb-2">{{ Str::limit($item->title, 60) }}</h6>
                                            <a href="{{ route('frontend.news.show', $item->id) }}"
                                                class="text-decoration-none small fw-bold" style="color: var(--primary);">
                                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Button ke Halaman Berita --}}
                    <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="600">
                        <a href="{{ route('frontend.news.index') }}" class="btn d-inline-flex align-items-center gap-2"
                            style="background: linear-gradient(135deg, #4facfe 0%, #1e3a8a 100%); color: #fff; border-radius: 30px; padding: 14px 30px; font-weight: 600; transition: all 0.3s ease;">
                            Lihat Semua Berita <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-5" data-aos="fade-up">
                        <i class="mdi mdi-newspaper-variant-outline text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3 mb-0">Belum ada berita yang dipublikasikan.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- COMBINED GALLERY + DOWNLOAD SECTION (2 KOLOM) --}}
        <section class="content-inner py-5" style="background: #f8f9fa;">
            <div class="container">
                <div class="section-head text-center mb-5" data-aos="fade-up">
                    <span class="text-uppercase fw-bold small" style="color: var(--primary); letter-spacing: 3px;">Galeri
                        &amp; Unduhan</span>
                    <h2 class="title mt-2" style="font-family: 'Oswald', sans-serif; font-weight: 700;">Kegiatan &amp;
                        Dokumen Publik</h2>
                    <div class="dz-separator style-1 text-primary"></div>
                </div>

                <div class="row g-5">

                    {{-- KOLOM KIRI: GALLERY (Hanya Hover) --}}
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="mb-4">
                            <span class="text-uppercase fw-bold small"
                                style="color: var(--primary); letter-spacing: 3px;">Galeri Foto</span>
                            <h3 class="title mt-1 mb-3" style="font-family: 'Oswald', sans-serif; font-weight: 700;">
                                Kegiatan Terbaru</h3>
                        </div>

                        @if ($galleries->count())
                            <div class="row g-3">
                                @foreach ($galleries as $gallery)
                                    <div class="col-6 col-md-4 gallery-item" data-aos="fade-up"
                                        data-aos-delay="{{ $loop->index * 80 }}">
                                        <div class="position-relative overflow-hidden rounded-4 shadow-sm h-100"
                                            style="aspect-ratio: 1/1; transition: all 0.4s ease;">
                                            <img src="{{ $gallery->file_url }}" alt="{{ $gallery->name ?? 'Galeri' }}"
                                                class="w-100 h-100" style="object-fit: cover;" loading="lazy">

                                            {{-- Hover Overlay (tidak clickable) --}}
                                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                                style="background: rgba(30, 58, 138, 0.75); opacity: 0; transition: all 0.4s ease;">
                                                <div class="text-center">
                                                    <i class="mdi mdi-magnify-plus-outline text-white"
                                                        style="font-size: 2.8rem;"></i>
                                                    <p class="text-white small mt-2 mb-0 px-3 text-center">
                                                        {{ Str::limit($gallery->name, 45) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="600">
                                <a href="{{ route('frontend.gallery.index') }}"
                                    class="btn d-inline-flex align-items-center gap-2"
                                    style="background: linear-gradient(135deg, #4facfe 0%, #1e3a8a 100%); color: #fff; border-radius: 30px; padding: 12px 28px; font-weight: 600;">
                                    Lihat Semua Galeri <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-5 border rounded-4 bg-white">
                                <i class="mdi mdi-image-multiple text-muted" style="font-size: 4rem;"></i>
                                <p class="text-muted mt-3">Belum ada foto galeri.</p>
                            </div>
                        @endif
                    </div>

                    {{-- KOLOM KANAN: DOWNLOAD (Direct Download) --}}
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="mb-4">
                            <span class="text-uppercase fw-bold small"
                                style="color: var(--primary); letter-spacing: 3px;">File Unduhan</span>
                            <h3 class="title mt-1 mb-3" style="font-family: 'Oswald', sans-serif; font-weight: 700;">
                                Dokumen &amp; Berkas</h3>
                        </div>

                        @if ($downloads->count())
                            <div class="d-flex flex-column gap-3">
                                @foreach ($downloads as $download)
                                    <div class="d-flex align-items-center gap-3 p-4 rounded-4 shadow-sm bg-white hover-card"
                                        style="transition: all 0.3s ease; border: 1px solid #eee;">
                                        <div class="flex-shrink-0">
                                            <i class="{{ $download->file_type_icon }} text-primary"
                                                style="font-size: 2.8rem;"></i>
                                        </div>
                                        <div class="flex-grow-1 min-width-0">
                                            <h6 class="fw-bold mb-1 text-truncate">
                                                <span class="d-none d-md-inline">
                                                    {{ Str::limit(strip_tags($download->name ?? basename($download->path)), 25) }}
                                                </span>
                                                <span class="d-inline d-md-none">
                                                    {{ Str::limit(strip_tags($download->name ?? basename($download->path)), 15) }}
                                                </span>
                                            </h6>
                                            <small class="text-muted">
                                                {{ $download->created_at->translatedFormat('d M Y') }}
                                            </small>
                                        </div>
                                        <a href="{{ $download->file_url }}" download
                                            class="btn btn-outline-primary rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center"
                                            style="width: 52px; height: 52px; font-size: 1.4rem;">
                                            <i class="mdi mdi-download"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="600">
                                <a href="{{ route('frontend.download.index') }}"
                                    class="btn d-inline-flex align-items-center gap-2"
                                    style="background: linear-gradient(135deg, #4facfe 0%, #1e3a8a 100%); color: #fff; border-radius: 30px; padding: 12px 28px; font-weight: 600;">
                                    Lihat Semua Unduhan <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-5 border rounded-4 bg-white">
                                <i class="mdi mdi-file-download-outline text-muted" style="font-size: 4rem;"></i>
                                <p class="text-muted mt-3">Belum ada file unduhan.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </section>

        {{-- STRUKTUR ORGANISASI SECTION --}}
        <section class="content-inner py-5">
            <div class="container">
                <div class="section-head text-center mb-5" data-aos="fade-up">
                    <span class="text-uppercase fw-bold small"
                        style="color: var(--primary); letter-spacing: 3px;">Organisasi</span>
                    <h2 class="title mt-2" style="font-family: 'Oswald', sans-serif; font-weight: 700;">Struktur
                        Organisasi</h2>
                    <div class="dz-separator style-1 text-primary"></div>
                </div>

                <div class="row g-5 align-items-center">

                    {{-- KOLOM KIRI: PENJELASAN --}}
                    <div class="col-lg-7" data-aos="fade-right" data-aos-delay="100">
                        <div class="pe-lg-4">
                            <h3 class="fw-bold mb-4"
                                style="font-family: 'Oswald', sans-serif; font-size: 1.8rem; color: #1e3a8a;">
                                Struktur Organisasi DISKOMINFOSANTIK Kabupaten Katingan
                            </h3>
                            <p class="text-muted" style="line-height: 1.85; font-size: 1.05rem;">
                                Dinas Komunikasi, Informatika, Persandian, dan Statistik Kabupaten Katingan merupakan
                                perangkat daerah yang bertugas melaksanakan urusan pemerintahan di bidang komunikasi dan
                                informatika, persandian, serta statistik.
                                Struktur organisasi kami dirancang untuk mendukung transformasi digital, transparansi
                                pelayanan publik, dan peningkatan kualitas data statistik daerah.
                            </p>
                            <div class="d-flex align-items-center gap-3 mt-4">
                                <div class="flex-shrink-0">
                                    <i class="mdi mdi-sitemap text-primary" style="font-size: 2.8rem;"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Dipimpin oleh Kepala Dinas</strong>
                                    <span class="text-muted">dibantu Sekretaris, Kepala Bidang, Kepala Sub Bagian, dan
                                        Staff yang kompeten</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: CARD KEPALA DINAS --}}
                    <div class="col-lg-5" data-aos="fade-left" data-aos-delay="200">
                        @if ($kepalaDinas)
                            <div class="leader-wrap mx-auto" style="max-width: 280px;">
                                <div class="peg-card peg-kepala">
                                    {{-- Dash Top Gold --}}
                                    <div class="dash-top"></div>

                                    {{-- Logo Badge --}}
                                    <div class="logo-badge">
                                        <img src="{{ $site_identity->get('favicon')
                                            ? Storage::url($site_identity->get('favicon'))
                                            : asset('frontend/images/favicon.png') }}"
                                            alt="Logo">
                                    </div>

                                    {{-- Photo Frame --}}
                                    <div class="photo-frame">
                                        @if ($kepalaDinas->gambar)
                                            <img src="{{ $kepalaDinas->gambar_url }}" alt="{{ $kepalaDinas->nama }}"
                                                loading="lazy">
                                        @else
                                            <div class="no-photo">
                                                {{ strtoupper(substr($kepalaDinas->nama, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Nama & Jabatan --}}
                                    <div class="peg-nama">{{ $kepalaDinas->nama }}</div>
                                    <div class="peg-jabatan">{{ strtoupper($kepalaDinas->jabatan) }}</div>

                                    @if ($kepalaDinas->golongan)
                                        <span class="peg-golongan">{{ $kepalaDinas->golongan }}</span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5 border rounded-4 bg-white">
                                <i class="mdi mdi-account-tie text-muted" style="font-size: 4rem;"></i>
                                <p class="text-muted mt-3">Belum ada data Kepala Dinas</p>
                            </div>
                        @endif
                    </div>

                </div>

                {{-- BUTTON LIHAT SELENGKAPNYA --}}
                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('frontend.structure-organization.index') }}"
                        class="btn d-inline-flex align-items-center gap-2"
                        style="background: linear-gradient(135deg, #4facfe 0%, #1e3a8a 100%); color: #fff; border-radius: 30px; padding: 14px 34px; font-weight: 600; font-size: 1.05rem;">
                        <i class="mdi mdi-account-group"></i>
                        Lihat Selengkapnya Struktur Organisasi
                        <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection
@push('scripts')
    <script>
        new Swiper('.banner-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true,
            },
            speed: 800,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('youtubeModal');
            const iframe = document.getElementById('youtubePlayer');

            if (modal && iframe) {
                modal.addEventListener('hidden.bs.modal', function() {
                    // Reset src iframe agar video langsung berhenti
                    const currentSrc = iframe.src;
                    iframe.src = '';
                    // Kembalikan src agar siap dibuka lagi nanti
                    setTimeout(() => {
                        iframe.src = currentSrc;
                    }, 200);
                });
            }
        });

        // === COUNTER UP ===
        $(document).ready(function() {
            $('.counter').counterUp({
                delay: 10,
                time: 2000
            });
        });

        // AOS (jika belum di-init di custom.js)
        if (typeof AOS !== 'undefined') {
            AOS.init({
                once: true,
                duration: 1000,
                easing: 'ease-in-out'
            });
        }
    </script>
@endpush
