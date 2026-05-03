<!-- Header -->
<header class="site-header mo-left header style-1">

    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix ">
            <div class="container-fluid clearfix">
                <!-- Website Logo -->
                <div class="logo-header mostion logo-dark">
                    <a href="#" class="b-brand text-decoration-none">
                        @if($site_identity->get('logo'))
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
                        <a href="#" class="b-brand text-decoration-none">
                            @if($site_identity->get('logo'))
                                <img src="{{ Storage::url($site_identity->get('logo')) }}" alt="Logo" height="75px">
                            @endif
                        </a>
                    </div>
                    <ul class="nav navbar-nav navbar navbar-left">
                        <li class="sub-menu">
                            <a href="#">Beranda</a>
                        </li>
                        {{-- <li class="sub-menu-down">
                            <a href="javascript:void(0);">Struktur Organisasi</a>
                            <ul class="sub-menu">
                                <li class="">
                                    <a href="">Daftar Pegawai</a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="sub-menu-down"><a href="javascript:void(0);"><span>Struktur Organisasi</span></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">Daftar Pegawai</a>
                                </li>
                                <li><a href="javascript:void(0);">Bidang Kantor <i class="fa fa-angle-right"></i></a>
                                    <ul class="sub-menu">
                                        <li class="">
                                            <a href="">Bidang 1</a>
                                        </li>
                                        <li class="">
                                            <a href="">Bidang 2</a>
                                        </li>
                                        <li class="">
                                            <a href="">Bidang 3</a>
                                        </li>
                                        <li class="">
                                            <a href="">Bidang 4</a>
                                        </li>
                                        <li class="">
                                            <a href="">Bidang 5</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>	
                        </li>
                        <li class="sub-menu">
                            <a href="#">Berita</a>
                        </li>
                        <li class="sub-menu">
                            <a href="#">Galeri</a>
                        </li>
                        <li class="sub-menu">
                            <a href="#">Unduhan</a>
                        </li>
                        <li class="sub-menu">
                            <a href="#">Hubungi Kami</a>
                        </li>
                        <li class="sub-menu">
                            <a href="#">Smart City CCTV</a>
                        </li>
                        <li class="sub-menu-down">
                            <a href="javascript:void(0);">Help Desk</a>
                            <ul class="sub-menu">
                                <li class="">
                                    <a href="">Pegajuan</a>
                                </li>
                                <li class="">
                                    <a href="">Keluhan</a>
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
