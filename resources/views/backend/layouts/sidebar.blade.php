<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand text-decoration-none">
                @if ($site_identity->get('logo'))
                    <img src="{{ Storage::url($site_identity->get('logo')) }}" alt="Logo" height="75px">
                @endif
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">

                <!-- Dashboard -->
                <li class="pc-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Beranda</span>
                    </a>
                </li>

                <!-- Master Data -->
                <li class="pc-item pc-caption">
                    <label>Master Data</label>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-world"></i></span>
                        <span class="pc-mtext">Manajemen Website</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('identity.index') }}">Identitas
                                Website</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('banner.index') }}">Banner</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('news.index') }}">Berita</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('download.index') }}">Unduhan</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('gallery.index') }}">Galeri</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('agenda.index') }}">Agenda</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">Struktur Organisasi</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link"
                                href="{{ route('structure-organization.index') }}">Daftar Anggota</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('field.index') }}">Bidang Kantor</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-rss"></i></span>
                        <span class="pc-mtext">HelpDesk</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('requests.index') }}">Pengajuan</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('cases.index') }}">Keluhan</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-receipt"></i></span>
                        <span class="pc-mtext">E-Katalog</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('katalog-layanan.index') }}">Layanan</a>
                        </li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('katalog-faq.index') }}">FAQ</a></li>
                    </ul>
                </li>

                <li class="pc-item">
                    <a href="{{ route('pertanyaan.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-rocket"></i></span>
                        <span class="pc-mtext">Jajak Pendapat</span>
                    </a>
                </li>

                <!-- Hanya Superadmin -->
                @hasrole('superadmin')
                    <li class="pc-item pc-caption">
                        <label>Manajemen Aplikasi</label>
                    </li>
                    <li class="pc-item {{ request()->is('app-log.index') ? 'active' : '' }}">
                        <a href="{{ route('app-log.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-receipt"></i></span>
                            <span class="pc-mtext">Log Aktivitas</span>
                        </a>
                    </li>
                @endhasrole

            </ul>
        </div>
    </div>
</nav>
