<!-- Header -->
<header class="site-header mo-left header style-1">

    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix ">
            <div class="container-fluid clearfix">
                <!-- Website Logo -->
                <div class="logo-header mostion logo-dark">
                    <a href="{{ route('main.index') }}" class="b-brand text-decoration-none">
                        @if ($site_identity->get('logo'))
                            <img src="{{ Storage::url($site_identity->get('logo')) }}" alt="Logo" height="75px">
                        @endif
                    </a>
                </div>
                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="header-nav navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
                    <div class="logo-header logo-dark">
                        <a href="{{ route('main.index') }}" class="b-brand text-decoration-none">
                            @if ($site_identity->get('logo'))
                                <img src="{{ Storage::url($site_identity->get('logo')) }}" alt="Logo"
                                    height="75px">
                            @endif
                        </a>
                    </div>
                    <ul class="nav navbar-nav navbar navbar-left">
                        <li class="sub-menu {{ request()->routeIs('main.index') ? 'active' : '' }}">
                            <a href="{{ route('main.index') }}">Beranda</a>
                        </li>
                        <li
                            class="sub-menu-down {{ request()->routeIs('frontend.structure-organization.index', 'frontend.field.show') ? 'active' : '' }}">
                            <a href="javascript:void(0);"><span>Struktur Organisasi</span></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('frontend.structure-organization.index') }}">Daftar Pegawai</a>
                                </li>
                                <li class="{{ request()->routeIs('frontend.field.show') ? 'active' : '' }}"><a
                                        href="javascript:void(0);">Bidang Kantor <i class="fa fa-angle-right"></i></a>
                                    <ul class="sub-menu">
                                        @foreach ($fields as $field)
                                            <li
                                                class="{{ request()->routeIs('frontend.field.show') && request()->route('id') == $field->id ? 'active' : '' }}">
                                                <a href="{{ route('frontend.field.show', $field->id) }}">
                                                    {{ $field->nama_bidang }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu {{ request()->routeIs('frontend.jajak-pendapat.index') ? 'active' : '' }}">
                            <a href="{{ route('frontend.jajak-pendapat.index') }}">Jajak Pendapat</a>
                        </li>
                        <li
                            class="sub-menu {{ request()->routeIs('frontend.katalog-layanan.index') ? 'active' : '' }}">
                            <a href="{{ route('frontend.katalog-layanan.index') }}">Katalog Layanan</a>
                        </li>
                        <li class="sub-menu {{ request()->routeIs('frontend.contact.index') ? 'active' : '' }}">
                            <a href="{{ route('frontend.contact.index') }}">Hubungi Kami</a>
                        </li>
                        <li class="sub-menu {{ request()->routeIs('frontend.cctv.index') ? 'active' : '' }}">
                            <a href="{{ route('frontend.cctv.index') }}">Smart City CCTV</a>
                        </li>

                        <li
                            class="sub-menu-down {{ request()->routeIs('frontend.news.index', 'frontend.news.show', 'frontend.gallery.index', 'frontend.download.index') ? 'active' : '' }}">
                            <a href="javascript:void(0);">Publikasi</a>
                            <ul class="sub-menu">
                                <li
                                    class="{{ request()->routeIs('frontend.news.index', 'frontend.news.show') ? 'active' : '' }}">
                                    <a href="{{ route('frontend.news.index') }}">Berita</a>
                                </li>
                                <li class="{{ request()->routeIs('frontend.gallery.index') ? 'active' : '' }}">
                                    <a href="{{ route('frontend.gallery.index') }}">Galeri</a>
                                </li>
                                <li class="{{ request()->routeIs('frontend.download.index') ? 'active' : '' }}">
                                    <a href="{{ route('frontend.download.index') }}">Unduhan</a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="sub-menu-down {{ request()->routeIs('frontend.requests.index', 'frontend.cases.index') ? 'active' : '' }}">
                            <a href="javascript:void(0);">Help Desk</a>
                            <ul class="sub-menu">
                                <li class="{{ request()->routeIs('frontend.requests.index') ? 'active' : '' }}">
                                    <a href="{{ route('frontend.requests.index') }}">Pegajuan</a>
                                </li>
                                <li class="{{ request()->routeIs('frontend.cases.index') ? 'active' : '' }}">
                                    <a href="{{ route('frontend.cases.index') }}">Keluhan</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header End -->
</header>
