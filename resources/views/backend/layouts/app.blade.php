<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'e-SKM Kabupaten Katingan')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mantis is made using Bootstrap 5 design framework.">
    <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template">
    <meta name="author" content="CodedThemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/png"
        href="{{ $site_identity->get('favicon')
                ? Storage::url($site_identity->get('favicon'))
                : asset('favicon.ico') }}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">

    {{-- data Table --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">

    <style>
        .ck-editor__editable {
            min-height: 350px !important;
        }

        .ck-content {
            line-height: 1.6;
        }
    </style>

    @stack('css')
    @stack('styles')
</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- Pre-loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Sidebar -->
    @include('backend.layouts.sidebar')

    <!-- Header -->
    @include('backend.layouts.header')


    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            {{ Breadcrumbs::render() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">Website Profile Dinas DISKOMINFOPERSANTIK</p>
                {{-- <div class="col-sm my-1">
                    <p class="m-0">Website Profile Dinas Pendidikan Dibuat dengan ♥ oleh<a
                            href="https://diskominfopersantik.katingankab.go.id/" target="_blank"> <b>Diskominfostandi
                                Kab. Katingan</b></a> Dikelola oleh <a href=""><b>Dinas Pendidikan Kab.
                                Katingan</b></a>.</p> --}}
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Kaida Admin Core -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        const csrf_token = '{{ csrf_token() }}';
        const token = "{{ session('api_token') }}";
    </script>

    @stack('scripts')
</body>

</html>
